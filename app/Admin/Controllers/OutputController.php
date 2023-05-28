<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\Subcore\CompletePageController;
use App\Models\Output;
use App\Models\Product;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OutputController extends CompletePageController {
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
		$show->field('title', 'Nombre');

		return $show;
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form() {
		$productos = DB::table('products')->select('id', 'title', 'stock')->get();
		$productos = $productos->map(function ($e) {
			return array(
				'id' => $e->id,
				'title' => $e->title . ' | STOCK[' . $e->stock . ']',
			);
		})->toArray();
		$productos = array_column($productos, 'title', 'id');

		$form = new Form(new Output());
		$form->date('date_output', __('Date'))->format('YYYY-MM-DD');

		if (auth()->user()->isRole('administrator') || auth()->user()->isRole('usuario-administrador')) {
			$form->select('user_id', __('Usuario'))->options(Administrator::whereDoesntHave('roles', function (Builder $query) {
				$query->where('slug', 'administrator')
					->orWhere('slug', 'usuario-administrador');
			})->get()->pluck('name', 'id'));
		}

		$form->hasMany('outputDetails', 'Productos', function ($form) use ($productos) {
			$form->select('product_id', __('Producto'))->options($productos);
			$form->number('quantity', 'Cantidad');
			// $form->number('price', 'Precio');
		})->mode('table');

		// dd(Product::all()->pluck('title', 'id'));

		// dd($productos);
		// exit;

		if (!auth()->user()->isRole('administrator') || !auth()->user()->isRole('usuario-administrador')) {
			$form->saving(function (Form $form) {
				$form->model()->user_id = auth()->user()->id;
			});
		}

		return $form;
	}
}