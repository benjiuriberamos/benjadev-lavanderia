<?php

namespace App\Admin\Controllers;

use App\Models\Input;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Product;
use Encore\Admin\Facades\Admin;
use App\Admin\Extensions\Excel\InputExporter;
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
        $grid->column('date_input', __('Fecha de entrada'))->filter('range', 'date');
        $grid->column('factory', __('Empresa'))->filter('like');

        if (Admin::user()->isRole('usuario-almacen') || Admin::user()->isRole('usuario-subalmacen')) {
            $grid->actions(function ($actions) {
                $actions->disableView(false);
                $actions->disableEdit();
                $actions->disableDelete();
            });
        }

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
		$show->field('date_input', 'Fecha');

		$show->inputDetails('Detalle salida', function ($output) {

			$output->column('product.title', __('Producto'));
			$output->quantity(__('Cantidad'));

			$output->disableActions();
			$output->disableCreateButton();
			$output->disableFilter();
			$output->disableRowSelector();
			$output->disablePagination();
			$output->actions(function ($actions) {
                $actions->disableView();
                $actions->disableEdit();
                $actions->disableDelete();
            });
		});

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableList();
                $tools->disableDelete();
        });

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
        $form->text('factory', __('Empresa'))->rules('required');
        $form->hasMany('inputDetails', 'Productos', function ($form) {
            $form->select('product_id', __('Producto'))->options(Product::all()->pluck('title', 'id'));
            $form->number('quantity', 'Cantidad');
            //$form->number('price', 'Precio');
        })->mode('table');

        $form->saving(function (Form $form) {
			$form->model()->user_id = auth()->user()->id;
		});

        return $form;
    }
}
