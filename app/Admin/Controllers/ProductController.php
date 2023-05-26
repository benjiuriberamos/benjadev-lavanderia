<?php

namespace App\Admin\Controllers;

use App\Models\Provider;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Controllers\AdminController;
use App\Admin\Controllers\Subcore\CompletePageController;

class ProductController extends CompletePageController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Productos de ropa';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Nombre'));
        $grid->column('image', __('Imagen'))->display(function ($name) {
                $url = $name ? Storage::url($name) : '/assets/img/default_product.png';
                return "<img src=' $url' width='50'></img>";
            });
        $grid->column('stock', __('Stock'));
        $grid->column('provider.title', __('Proveedor'));

        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

        //Settings
        $grid->filter(function ($filter) {
            $filter->between('created_at', 'Created Time')->datetime();
        });
        
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('ID'));
        $show->active('¿Activo?')->as(function ($content) {
            $content = $content ? 'Sí' : 'No';
            return $content;
        });
        $show->field('title', 'Nombre');
        $show->field('descripcion', 'Descripción');
        $show->image('image', 'Imagen');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->text('title', __('Nombre'));
        $form->text('slug', __('Slug'))->help('Se autogenera con el título.');
        $form->textarea('description', __('Descripción'));
        $form->image('image', __('Imagen principal'))
            ->removable()
            ->help('Seleccione las imagenes. Tamaño recomendado 740x900.');
        $form->select('provider_id', __('Proveedor'))->options(Provider::all()->pluck('title', 'id'));

        $form->saving(function (Form $form) {
			$form->slug = Str::slug($form->title, '-');
		});

        return $form;
    }
}
