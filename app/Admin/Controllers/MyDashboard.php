<?php

namespace App\Admin\Controllers;

use Encore\Admin\Admin;
use Illuminate\Support\Arr;

class MyDashboard
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function title()
    {
        return view('dashboard.title');
    }

}
