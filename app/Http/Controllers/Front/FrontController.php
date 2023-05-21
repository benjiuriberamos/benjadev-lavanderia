<?php
 
namespace App\Http\Controllers\Front;
 
use App\Models\PageContact;
use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\{Category, Brand, Sector, Color, Size, Product};
use App\Models\PageSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
 
class FrontController extends Controller
{

    /**
     * The vars to send.
     *
     * @var array
     */
    protected $locals = [];

    /**
     * Construc method
     *
     */
    public function __constructor() {
        //Some code
    }

    /**
     * Show home front page.
     *
     * @return View
     */
    public function home()
    {
        $this->locals['home'] = PageHome::find(1);
        $this->locals['sectors'] = Sector::where(['home_show' => 1])->get();
        $this->locals['products'] = Product::where(['home_show' => 1, 'active' => 1])->get();
        $this->locals['categories'] = Category::where(['home_show' => 1])->get();
        $this->locals['brands'] = Brand::where(['home_show' => 1]);
        
        return view('front.home', $this->locals);
    }

    /**
     * Show about front page.
     *
     * @return View
     */
    public function about()
    {
        $this->locals['home'] = PageAbout::find(1);
        return view('front.about', $this->locals);
    }

    /**
     * Show contact front page.
     *
     * @return View
     */
    public function contact()
    {
        $this->locals['home'] = PageContact::find(1);
        return view('front.contact', $this->locals);
    }

}