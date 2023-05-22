<?php

namespace App\Admin\Controllers;

use App\Models\Provider;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Admin\Controllers\Subcore\CompletePageController;

class ProviderController extends CompletePageController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Proveedores de productos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Provider);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Nombre'));
        $grid->column('image', __('Imagen'))->display(function ($name) {
                $url = $name ? Storage::url($name) : '/assets/img/default_product.png';
                return "<img src=' $url' width='50'></img>";
        });
        $grid->perPages([10, 20, 30, 40, 50]);

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
        $show = new Show(Provider::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', 'Nombre');
        $show->field('slug', 'Slug');
        $show->image('image', 'Imagen');
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Provider);

        $form->text('title', __('Nombre'));
        $form->text('slug', __('Slug'))
            ->help('Se autogenera con el título.');
        $form->image('image', __('Imagen principal'))
            ->removable()
            ->help('Seleccione las imagen.');

        $form->saving(function (Form $form) {
			$form->slug = Str::slug($form->title, '-');
		});

        return $form;
    }
}
