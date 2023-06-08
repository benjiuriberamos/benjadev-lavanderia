<?php

namespace App\Admin\Controllers;

use App\User;
use App\Models\Local;
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
use App\Admin\Controllers\Subcore\CompletePageController;

class LocalController extends CompletePageController
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
        $grid = new Grid(new Local);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Nombre'));
        $grid->column('not_column', __('Stock productos'))->display(function () {
            return '<a href="' . route('admin.locals.products', ['id' => $this->id]) . '" target="_blank">Ver stock de productos</a>';
        });
        $grid->column('not_column2', __('Ver salidas'))->display(function () {
            return '<a href="' . route('admin.stocklocals.index', ['local' => $this->id]) . '" target="_blank">Ver salidas</a>';
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

    /**
     * Make a grid builder for locals/{id}/products/.
     *
     * @return Grid
     */
    public function products(Content $content, $id)
    {

        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->liststock($id));
    }

    /**
     * Make a grid builder for /admin/stock.
     *
     * @return Grid
     */
    public function stockUser(Content $content)
    {
        $local_id =  $this->getLocal() ? $this->getLocal()->id : 0;
        $grid = $this->liststock($local_id);
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($grid);
    }

    private function liststock($id) {
        $grid = new Grid(new LocalProducts);

        if (!$id || !$this->getUser()->isRole('usuario-subalmacen') ) {
            $grid->column('local.title', __('Local'));
        }

        $grid->model()->where('local_id', $id);
        $grid->column('product.title', __('Producto'));
        $grid->column('stock', __('Stock'));

		$grid->disableCreateButton();
        $grid->disableActions();
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
        });

        return $grid;
    }

}