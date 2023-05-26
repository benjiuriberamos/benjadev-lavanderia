<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Subuser;
use App\Models\Local;
use App\User as Administrator;
// use Encore\Admin\Auth\Database\Administrator;
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
        $grid = new Grid(new Administrator);

        $grid->model()->whereDoesntHave('roles', function ($query) {
            $query->where('slug', 'administrator')
                ->orWhere('slug', 'usuario-administrador')
                ;
        });
        $grid->model()->with('subuser.local');

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Nombre'));
        $grid->column('username', __('Username'));
        $grid->column('subuser.local', __('Local'))->display(function ($array) {
            return isset($array["title"]) ? $array["title"] : '';
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
        $show = new Show(Administrator::findOrFail($id));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Administrator);

        $form->text('username', __('Username'));
        $form->text('name', __('Nombre'));
        $form->password('password', __('Password'));
        $form->select('subuser.local_id', __('Local'))->options(Local::all()->pluck('title', 'id'))
            ->rules('required');

        $form->saving(function (Form $form) {
			$form->model()->subuser()->user_id = $form->model()->user_id;
		});

        return $form;
    }
}
