<?php

namespace App\Exports;

use App\Models\Output;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class OutputsExport implements FromCollection
{
    public function collection()
    {
        $product_id = request()->request->getInt('product_id', 0);
        $user_id = request()->request->getInt('user_id', 0);
        $local_id = request()->request->getInt('local_id', 0);
        $date_start = request()->request->get('date_start', '');
        $date_end = request()->request->get('date_end', '');
        $factory = request()->request->get('factory', '');

        $query = new Output();
        $query = $query->with([
            'outputDetails',
            'outputDetails.product',
            'user',
            'user.subuser',
            'user.subuser.local',
        ]);

        if ($product_id) {
            $query = $query->whereHas('outputDetails', function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            });
            $query = $query->with(['outputDetails' => function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            }]);
        }

        if ($user_id) {
            $query = $query->where('user_id', '=', $user_id);
        }

        if ($local_id) {
            $query = $query->whereHas('user', function ($query) use ($local_id) {
                $query->whereHas('subuser', function ($query) use ($local_id) {
                    $query->where('local_id', $local_id)->with(['local']);
                });
            });
        }
        if ($date_start) {
            $query = $query->where('date_input', '>=', $date_start);
        }

        if ($date_end) {
            $query = $query->where('date_input', '<=', $date_end);
        }

        $inputs = $query->get();

        $result = [];

        //Headers
        $result[] = [
            'Id de salida',
            'Fecha',
            'Producto',
            'Usuario',
            'Local',
        ];

        foreach ($inputs as $row) {
            foreach ($row['outputDetails'] as $detail) {
                $local = isset($row['user']['subuser']['local']->title) ? $row['user']['subuser']['local']->title : '';
                $result[] = [
                    $row->id, //id de pedido
                    $row->date_output, //fecha de pedido
                    $detail['product']->title, //Nombre del producto
                    $row['user']->name, //Nombre del usuario
                    $local, //Nombre del usuario
                ];
            }
        }

        return new Collection($result);
    }
}
