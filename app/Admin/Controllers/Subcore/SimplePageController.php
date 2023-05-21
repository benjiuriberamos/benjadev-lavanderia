<?php

namespace App\Admin\Controllers\Subcore;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Encore\Admin\Controllers\HasResourceActions;

abstract class SimplePageController extends Controller
{
    // use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Title';

    /**
     * Routes to redirect .
     *
     * @var array
     */
    protected $routes = [
        // 'edit' => 'admin.example.edit',
        // 'update' => 'admin.example.update',
        // //param name for crud see with comand "php artisan route:list"
        // 'param' => 'param_name',
    ];

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
        //        'index'  => 'Index',
        //        'show'   => 'Show',
        //        'edit'   => 'Edit',
        //        'create' => 'Create',
    ];

    /**
     * Get content title.
     *
     * @return string
     */
    protected function title()
    {
        return $this->title;
    }

    /**
     * Index interface.
     *
     */
    public function index()
    {
        return redirect()->route($this->routes['edit'], [$this->routes['param'] => 1]);
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        // return $content
        //     ->title($this->title())
        //     ->description($this->description['show'] ?? trans('admin.show'))
        //     ->body($this->detail(1));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        $form = $this->form();

		//settings form
		$form->tools(function ($tools) {
			$tools->disableList();
			$tools->disableDelete();
			$tools->disableView();
		});
		$form->footer(function ($footer) {
			$footer->disableReset();
			// $footer->disableSubmit();
			$footer->disableViewCheck();
			$footer->disableEditingCheck();
			$footer->disableCreatingCheck();
		});
		

        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($form->edit(1));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id = 0)
    {
        $data = request()->all();

        if (array_key_exists( '_file_del_', $data)) {
            return $this->form()->update(1);
        }
        $this->form()->update(1);
        return redirect()->route($this->routes['edit'], [$this->routes['param'] => 1]);
        // redirect(request()->url());
        //back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        return $this->form()->store();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->form()->destroy($id);
    }
}
