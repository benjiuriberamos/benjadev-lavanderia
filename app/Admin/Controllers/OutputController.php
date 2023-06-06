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
		}

		$grid->model()->with('user');
		$grid->model()->with('user.subuser.local');

		$grid->column('id', __('ID'))->sortable();
		$grid->column('date_output', __('Fecha'));
		$grid->column('user.name', __('Usuario'));
		$grid->column('user.subuser', __('Local'))->display(function ($array) {
			return isset($array['local']['title']) ? $array['local']['title'] : '';
		});

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
			$form->select('product_id', __('Producto'))->options($productos);
			$form->number('quantity', 'Cantidad');
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

		$form = new Form(new Output());
		$form->date('date_output', __('Fecha'))
			->format('YYYY-MM-DD')
			->rules('required');
		$form->hidden('is_subalmacen')->value(true);

		$form->hasMany('outputDetails', 'Productos', function ($form) use ($productos) {
			$form->select('product_id', __('Producto'))->options($productos);
			$form->number('quantity', 'Cantidad');
			$form->hidden('is_subalmacen')->value(true);

		})->mode('table');

		$form->submitted(function (Form $form) {
			$output = $form->model();
			
			//Resta de subalmacen
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
			$output->user_id = auth()->user()->id;
			$output->local_id = $this->getLocal()->id;
			$output->is_subalmacen = true;
			$output->save();

			//Suma a subalmacen
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

	private function productsForUser() {

		if (Admin::user()->isRole('usuario-subalmacen')) {
			$productos = LocalProducts::with('product')
				->where('local_id', $this->getLocal()->id)
				->get();
			$productos = $productos->map(function ($e) {
				$product = $e->product()->first();
				return array(
					'id' => $product->id,
					'title' => $product->title . ' | STOCK[' . $e->stock . ']',
				);
			})->toArray();

		} else {
			$productos = DB::table('products')
				->select('id', 'title', 'stock')
				->get();
			$productos = $productos->map(function ($e) {
				return array(
					'id' => $e->id,
					'title' => $e->title . ' | STOCK[' . $e->stock . ']',
				);
			})->toArray();

		}
		
		$productos = array_column($productos, 'title', 'id');
		return $productos;
	}
}