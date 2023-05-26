<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Subuser;
use App\Admin\Controllers\Subcore\CompletePageController;

class SubuserController extends CompletePageController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Subuser';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Subuser);

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
        $show = new Show(Subuser::findOrFail($id));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Subuser);

        $form->text('user.name', __('Name'));
        $form->email('user.email', __('Email'));
        $form->datetime('user.email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('user.password', __('Password'));
        $form->text('user.remember_token', __('Remember token'));

        return $form;
    }
}
