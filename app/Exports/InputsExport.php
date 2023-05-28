<?php

namespace App\Exports;

use App\Models\Input;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class InputsExport implements FromCollection
{
    public function collection()
    {
        $product_id = request()->request->getInt('product_id', 0);
        $user_id = request()->request->getInt('user_id', 0);
        $local_id = request()->request->getInt('local_id', 0);
        $date_start = request()->request->get('date_start', '');
        $date_end = request()->request->get('date_end', '');
        $factory = request()->request->get('factory', '');

        $query = new Input();
        //$query = $query->with(['inputDetails', 'user']);

        if ($factory) {
            $query = $query->where('factory', 'LIKE', $factory);
        }

        if ($product_id) {
            $query = $query->whereHas('inputDetails', function (Builder $query) use ($product_id) {
                $query->where('product_id', $product_id);
            });
            $query = $query->with(['inputDetails' => function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            }]);
        }

        if ($user_id) {
            $query = $query->where('user_id', '=', $user_id);
        }

        if ($local_id) {
            $query = $query->whereHas('user', function (Builder $query) use ($local_id) {
                $query->whereHas('subuser', function (Builder $query) use ($local_id) {
                    $query->where('local_id', $local_id);
                });
            });
            $query = $query->with(['inputDetails' => function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            }]);
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
            'Id de entrada',
            'Fecha',
            'Empresa',
            'Producto',
            'Usuario',
            'Local',
        ];

        foreach ($inputs as $row) {
            foreach ($row['inputDetails'] as $detail) {
                $local = isset($row['user']['subuser']['local']->title) ? $row['user']['subuser']['local']->title : '';
                $result[] = [
                    $row->id, //id de pedido
                    $row->date_input, //fecha de pedido
                    $row->factory, //Empresa
                    $detail['product']->title, //Nombre del producto
                    $row['user']->name, //Nombre del usuario
                    $local , //Nombre del usuario
                ];
            }
        }

        return new Collection($result);
    }
}
