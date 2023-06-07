<?php

namespace App\Admin\Controllers;

use App\User;
use App\Models\Local;
use App\Models\Output;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Product;
use App\Traits\UtilsTrait;
use Illuminate\Support\Str;
use App\Models\LocalProducts;
use Illuminate\Http\Response;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\Builder;
use Encore\Admin\Auth\Database\Administrator;
use App\Admin\Controllers\Subcore\CompletePageController;

class StockLocalController extends CompletePageController
{
    use UtilsTrait;
    
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Locales';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Output);
        $grid->model()->where('local_id', request()->query->get('local', 1));
        $grid->model()->where('is_subalmacen', true);
        $grid->model()->with(['user', 'user.subuser.local']);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('user.name', __('Responsable'));
        $grid->column('user->subuser->local->title', __('Local'));

        //Settings
        $grid->disableCreateButton();
        $grid->perPages([10, 20, 30, 40, 50]);
        $grid->actions(function ($actions) {
            $actions->disableView(false);
            $actions->disableEdit();
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
        $show = new Show(Output::findOrFail($id));

		$show->field('id', __('ID'));
		$show->field('date_output', 'Fecha');

		
        $show->outputDetails('Productos de la salida', function ($output) {

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

        $productos = $this->productsForUser();

		$form = new Form(new Output());
		$form->date('date_output', __('Fecha'))
			->format('YYYY-MM-DD')
			->rules('required');
		$form->select('user_id', __('Usuario'))->options(Administrator::whereHas('roles', function (Builder $query) {
                $query->where('slug', 'usuario-subalmacen');
            })->get()->pluck('name', 'id'))
                ->rules('required');
		$form->hidden('is_subalmacen')->value(1);
        
		$form->hasMany('outputDetails', 'Productos', function ($form) use ($productos) {
                $form->select('product_id', __('Producto'))->options($productos);
                $form->number('quantity', 'Cantidad');
		        $form->hidden('is_subalmacen')->value(1);

            })->mode('table');

		$form->submitted(function (Form $form) {
			$output = $form->model();

			//Resta de subalmacen
			$output->outputDetails()->get()->map(function ($model) use ($output) {
				$stock = LocalProducts::firstOrCreate([
					'product_id' => $model->product_id,
					'local_id' => $output->local_id,
				]);
				$stock->stock = $stock->stock - $model->quantity;
				$stock->save();
			});
		});

		$form->saved(function (Form $form) {
			$output = $form->model();
			$user = Administrator::find($output->user_id);
			$output->local_id = $this->getLocalByUser($user)->id;
			$output->save();

			//Suma a subalmacen
			$output->outputDetails()->get()->map(function ($outputDetail) use ($output) {
				$stock = LocalProducts::firstOrCreate([
					'product_id' => $outputDetail->product_id,
					'local_id' => $output->local_id,
				]);
				$stock->stock = $stock->stock + $outputDetail->quantity;
				$stock->save();
			});
		});

		return $form;
    }

}