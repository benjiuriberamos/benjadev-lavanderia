<?php

namespace App\Admin\Controllers;

use App\User;
use App\Models\Local;
use App\Models\Product;
use Encore\Admin\Layout\Row;
use App\Exports\InputsExport;
use App\Exports\OutputsExport;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Admin\Controllers\MyDashboard;
use Illuminate\Database\Query\Builder;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Auth\Database\Administrator;

class ReportController extends Controller
{
    public function index(Content $content)
    {
        $vars = [];
        $vars['users'] = Administrator::whereDoesntHave('roles', function ($query) {
            $query->where('slug', 'administrator')
            ;
        })->get();

        $vars['products'] = Product::all();
        $vars['locals'] = Local::all();

        //Contenido del dashboard
        return $content
            ->row(function (Row $row) use ($vars) {
                $row->column(12, function (Column $column) use ($vars) {
                    $column->append(view('admin.reports.reports', $vars));
                });
            });
    }

    public function exportOutputs()
    {
        return Excel::download(new OutputsExport, 'salidas.xlsx');
    }

    public function exportInputs()
    {
        return Excel::download(new InputsExport, 'entradas.xlsx');
    }
}
