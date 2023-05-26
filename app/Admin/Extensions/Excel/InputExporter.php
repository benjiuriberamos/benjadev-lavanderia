<?php

namespace App\Admin\Extensions\Excel;

use App\Models\InputDetail;
use Encore\Admin\Grid\Exporters\ExcelExporter;

class InputExporter extends ExcelExporter
{
    protected $fileName = 'Listado-de-entradas.xlsx';

    // protected $headings = [
    //     'Fecha',
    //     'Empresa',
    //     'Producto',
    //     'Cantidad',
    // ];

    protected $columns = [
        'product.title' => 'Producto',
        'product_id' => 'title',
    ];

    public function query()
    {
        $result = InputDetail::query();
        $params = request()->query->all();

        if (array_key_exists('date_input', $params)) {
            $result->where('created_at', '>=', $params['date_input']['start'] . ' 00:00:00')
                    ->where('created_at', '<=', $params['date_input']['end'] . ' 23:59:59');
        }

        if (array_key_exists('factory', $params)) {
            $result->where('created_at', 'like', '%' . $params['factory'] . '%');
        }

        return $result;
    }
}