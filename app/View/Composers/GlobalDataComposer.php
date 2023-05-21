<?php

namespace App\View\Composers;
 
use Illuminate\View\View;
use App\Models\PageSettings;
use App\Models\Category;
 
class GlobalDataComposer
{
    public function compose(View $view)
    {
        $info = PageSettings::find(1);
        $header_categories = Category::where('header_show', '=', '1')->get();
        $footer_categories = Category::where('footer_show', '=', '1')->get();
        // dd($footer_categories);
        $view->with('header_categories', $header_categories);
        $view->with('footer_categories', $footer_categories);
        $view->with('info', $info);
    }
}