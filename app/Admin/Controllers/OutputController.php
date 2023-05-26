<?php

namespace App\Admin\Controllers;

use App\Models\Output;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Product;
use App\Admin\Extensions\Excel\OutputExporter;
use Illuminate\Database\Eloquent\Builder;
use Encore\Admin\Auth\Database\Administrator;
use App\Admin\Controllers\Subcore\CompletePageController;

class OutputController extends CompletePageController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Salidas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Output);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('date_output', __('Fecha'));

        //Settings

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Output::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', 'Nombre');
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Output);
        $form->date('date_output', __('Date'))->format('YYYY-MM-DD');

        if (auth()->user()->isRole('administrator') || auth()->user()->isRole('usuario-administrador')) {
            $form->select('user_id', __('Usuario'))->options(Administrator::whereDoesntHave('roles', function (Builder $query) {
                $query->where('slug', 'administrator')
                    ->orWhere('slug', 'usuario-administrador');
            })->get()->pluck('name', 'id'));
        }

        $form->hasMany('outputDetails', 'Productos', function ($form) {
            $form->select('product_id', __('Producto'))->options(Product::all()->pluck('title', 'id'));
            $form->number('quantity', 'Cantidad');
            //$form->number('price', 'Precio');
        })->mode('table');

        if (!auth()->user()->isRole('administrator') || !auth()->user()->isRole('usuario-administrador')) {
            $form->saving(function (Form $form) {
                $form->model()->user_id = auth()->user()->id;
            });
        }

        return $form;
    }
}