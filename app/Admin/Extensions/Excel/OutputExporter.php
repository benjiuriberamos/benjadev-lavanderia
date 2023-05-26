<?php

namespace App\Admin\Extensions\Excel;

use Encore\Admin\Grid\Exporters\ExcelExporter;

class OutputExporter extends ExcelExporter
{
    protected $fileName = 'Article list.xlsx';

    protected $columns = [
        'id' => 'ID',
        'title' => 'title',
        'content' => 'content',
    ];
}