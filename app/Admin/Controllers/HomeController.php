<?php

namespace App\Admin\Controllers;

use Encore\Admin\Layout\Row;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use App\Admin\Controllers\MyDashboard;
use Encore\Admin\Controllers\Dashboard;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        //pedido del cliente
        if (Admin::user()->isRole('usuario')) {
            return redirect()->route('admin.settings.edit', ['setting' => 1]);
        }

        //Contenido del dashboard
        return $content
            ->header('D\' God J Vibes')
            ->title('D\' God J Vibes')
            ->description('Corporación')
            ->breadcrumb(
                ['text' => 'Dashboard', 'url' => '/admin'],
                // ['text' => 'User management', 'url' => '/admin/users'],
                // ['text' => 'Edit user'],
            )
            ->body('El administrador contiene una serie de módulos que permitiran ayudar
            a agregar, modificar contenido a las webs. A continuación podra identificar una serie de caracteristicas
            requeridas para el funcionamiento de este gestor de contenido.')
            ->row(MyDashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }

    // public function index()
    // {
    //     return Admin::content(function (Content $content) {

    //         // optional
    //         $content->header('page header');

    //         // optional
    //         $content->description('page description');

    //         // add breadcrumb since v1.5.7
    //         $content->breadcrumb(
    //             ['text' => 'Dashboard', 'url' => '/admin'],
    //             ['text' => 'User management', 'url' => '/admin/users'],
    //             ['text' => 'Edit user']
    //         );

    //         // Fill the page body part, you can put any renderable objects here
    //         $content->body('hello world');

    //         // Add another contents into body
    //         $content->body('foo bar');

    //         // method `row` is alias for `body`
    //         $content->row('hello world');

    //         // Direct rendering view, Since v1.6.12
    //         $content->view('dashboard', ['data' => 'foo']);
    //     });
    // }
}
