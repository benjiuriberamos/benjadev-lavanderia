<?php

namespace App\Admin\Controllers;

use App\Models\Local;
use App\Models\Output;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Product;
use App\Traits\UtilsTrait;
use App\Models\OutputDetail;
use App\Models\LocalProducts;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Encore\Admin\Auth\Database\Administrator;
use App\Admin\Controllers\Subcore\CompletePageController;

class OutputController extends CompletePageController
{
    use UtilsTrait;

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
	protected function grid() {
		$grid = new Grid(new Output());

		if (Admin::user()->isRole('usuario-subalmacen')) {
			$user_id = Admin::user()->id;
			$grid->model()->where('user_id', $user_id);
			$grid->model()->where('is_subalmacen', 1);

		} else {
			$grid->model()->where('is_subalmacen', 0);

			$grid->column('user.subuser', __('Hacia el local'))->display(function ($array) {
				return isset($array['local']['title']) ? $array['local']['title'] : '';
			});
		}

		$grid->model()->with('user');
		$grid->model()->with('user.subuser.local');

		$grid->column('id', __('ID'))->sortable();
		$grid->column('date_output', __('Fecha'));
		$grid->column('user.name', __('Usuario'));
		$grid->column('is_subalmacen', __('Retiro de'))->display(function ($value) {
			return $value ? 'Subalmacen' : 'Principal' ;
		});

		if (Admin::user()->isRole('usuario-subalmacen')) {
            $grid->actions(function ($actions) {
                $actions->disableView(false);
                $actions->disableEdit();
            });
        }

		return $grid;
	}

	/**
	 * Make a show builder.
	 *
	 * @param mixed $id
	 *
	 * @return Show
	 */
	protected function detail($id) {
		$show = new Show(Output::findOrFail($id));

		$show->field('id', __('ID'));
		$show->field('date_output', 'Fecha');

		$show->outputDetails('Detalle salida', function ($output) {

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
	protected function form() {

		if (Admin::user()->isRole('usuario-subalmacen')) {
			return $this->formSubalmacen();
		}

		$productos = $this->productsForUser();

		$form = new Form(new Output());
		$form->date('date_output', __('Fecha'))
			->format('YYYY-MM-DD')
			->rules('required');
		$form->select('user_id', __('Usuario'))->options(Administrator::whereHas('roles', function (Builder $query) {
			$query->where('slug', 'usuario-subalmacen');
		})->get()->pluck('name', 'id'))
			->rules('required');
		$form->hasMany('outputDetails', 'Productos', function ($form) use ($productos) {
			$form->select('product_id', __('Producto'))
				->options($productos)
				->rules('required');
			$form->number('quantity', 'Cantidad')
				->rules('required');
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

	protected function formSubalmacen() {

		$productos = $this->productsForUser();
		$user_id = auth()->user()->id;
		$local_id = $this->getLocal()->id;

		$form = new Form(new Output());
		$form->date('date_output', __('Fecha'))
			->format('YYYY-MM-DD')
			->rules('required');
		$form->hidden('is_subalmacen')->value(1);
		$form->hidden('user_id')->value($user_id);
		$form->hidden('local_id')->value($local_id);

		// dd($params);exit;
		$form->hasMany('outputDetails', 'Productos', function ($form) use ($productos) {
			$form->select('product_id', __('Producto'))
				->options($productos)
				->rules('required');
			$form->number('quantity', 'Cantidad')
				->rules('required');
			$form->hidden('is_subalmacen')->value(1);

		})->mode('table');
		
		$form->submitted(function (Form $form) {
			$output = $form->model();
			
			
			//Suma de subalmacen
			$output->outputDetails()->get()->map(function ($outputDetail) use ($output) {
				$stock = LocalProducts::firstOrCreate([
					'product_id' => $outputDetail->product_id,
					'local_id' => $output->local_id,
				]);
				$stock->stock = $stock->stock + $outputDetail->quantity;
				$stock->save();
			});


		});

		$form->saved(function (Form $form) {
			$output = $form->model();

			//Resta a subalmacen
			$output->outputDetails()->get()->map(function ($outputDetail) use ($output) {
				$stock = LocalProducts::firstOrCreate([
					'product_id' => $outputDetail->product_id,
					'local_id' => $output->local_id,
				]);
				$stock->stock = $stock->stock - $outputDetail->quantity;
				$stock->save();
			});
		});

		return $form;
	}

	
}