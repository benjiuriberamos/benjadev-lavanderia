<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Input;
use App\Models\Product;
use App\Admin\Controllers\Subcore\CompletePageController;

class InputController extends CompletePageController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Entradas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Input);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('date_input', __('Fecha de entrada'));

        //Settings
        $grid->perPages([10, 20, 30, 40, 50]);
        $grid->actions(function ($actions) {
            $actions->disableView();
        });

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
        $show = new Show(Input::findOrFail($id));

        $show->field('id', __('ID'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Input);
        $form->date('date_input', __('Date'))->format('YYYY-MM-DD');
        $form->hasMany('inputDetails', 'Productos', function ($form) {
            $form->select('product_id', __('Producto'))->options(Product::all()->pluck('title', 'id'));
            $form->number('quantity', 'Cantidad');
            $form->number('price', 'Precio');
        })->mode('table');

        $form->saving(function (Form $form) {
			$form->model()->user_id = auth()->user()->id;
		});

        return $form;
    }
}
