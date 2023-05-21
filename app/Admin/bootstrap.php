<?php
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Navbar;
use App\Admin\Extensions\Text;
use App\Admin\Extensions\HasMany;
use App\Admin\Extensions\PHPEditor;
use App\Admin\Extensions\Collection;
use App\Admin\Extensions\SimpleEditor;
use App\Admin\Extensions\StefanyTool;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

// Form::forget(['map', 'editor']);
Form::forget(['map']);
Form::extend('hasManyPro', HasMany::class);
Form::extend('php', PHPEditor::class);
Form::extend('collection', Collection::class);
Form::extend('simpleeditor', SimpleEditor::class);
Form::extend('filemanager', FileManager::class);

Admin::navbar(function (Navbar $navbar) {

    //$navbar->left(view('search-bar'));

    //$navbar->right(new \App\Admin\Extensions\Nav\Links());

    // $html = '
    // <li class="dropdown notifications-menu">
    //     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    //     <i class="fa fa-bell-o"></i>
    //     <span class="label label-warning">10</span>
    //     </a>
    //     <ul class="dropdown-menu">
    //     <li class="header">You have 10 notifications</li>
    //     <li>
    //         <!-- inner menu: contains the actual data -->
    //         <ul class="menu">
    //         <li>
    //             <a href="#">
    //             <i class="fa fa-users text-aqua"></i> 5 new members joined today
    //             </a>
    //         </li>
    //         <li>
    //             <a href="#">
    //             <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
    //             page and may cause design problems
    //             </a>
    //         </li>
    //         <li>
    //             <a href="#">
    //             <i class="fa fa-users text-red"></i> 5 new members joined
    //             </a>
    //         </li>
        
    //         <li>
    //             <a href="#">
    //             <i class="fa fa-shopping-cart text-green"></i> 25 sales made
    //             </a>
    //         </li>
    //         <li>
    //             <a href="#">
    //             <i class="fa fa-user text-red"></i> You changed your username
    //             </a>
    //         </li>
    //         </ul>
    //     </li>
    //     <li class="footer"><a href="#">View all</a></li>
    //     </ul>
    // </li>';

    // $navbar->right($html);

});
