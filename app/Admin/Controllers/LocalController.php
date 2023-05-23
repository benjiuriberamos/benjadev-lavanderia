<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Local;
use Illuminate\Support\Str;
use App\Admin\Controllers\Subcore\CompletePageController;

class LocalController extends CompletePageController
{
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
        $grid = new Grid(new Local);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Nombre'));

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
        $show = new Show(Local::findOrFail($id));

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
        $form = new Form(new Local);

        $form->text('title', __('Nombre'));
        $form->text('slug', __('Slug'));

        $form->saving(function (Form $form) {
			$form->slug = Str::slug($form->title, '-');
		});

        return $form;
    }
}
