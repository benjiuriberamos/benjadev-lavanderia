<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

trait ProductFilterTrait 
{

    private function getFilterProducts(Request $request)
    {
        $search = $request->query->get('search', '');
        $page = $request->query->getInt('page', 1);
        $order = $request->query->get('order', 'az');
        $categories = $request->query->get('categories', []);
        $brands = $request->query->get('brands', []);
        $sectors = $request->query->get('sectors', []);
        $colors = $request->query->get('colors', []);
        $sizes = $request->query->get('sizes', []);
        $pricemin = $request->query->getInt('price_min', 0);
        $pricemax = $request->query->getInt('price_max', 0);
        $pricemax = $request->query->getInt('price_max', 0);

        $product = new Product();
        $product->where('active', '=', '1');
        if (is_array($categories) && $categories) {
            $product = $product->whereHas('categories', function($query) use ($categories) {
                $query->whereIn('slug', $categories);
            });
        }

        if (is_array($brands) && $brands) {
            $product = $product->whereHas('brand', function($query) use ($brands){
                $query->whereIn('slug', $brands);
            });
        }

        if (is_array($sectors) && $sectors) {
            $product = $product->whereHas('sectors', function($query) use ($sectors){
                $query->whereIn('slug', $sectors);
            });
        }

        if (is_array($colors) && $colors) {
            $product = $product->whereHas('colors', function($query) use ($colors){
                $query->whereIn('slug', $colors);
            });
        }

        if (is_array($sizes) && $sizes) {
            $product = $product->whereHas('sizes', function($query) use ($sizes){
                $query->whereIn('slug', $sizes);
            });
        }

        if ($pricemin) {
            $product = $product->where('price', '>=', $pricemin);
        }

        if ($pricemax) {
            $product = $product->where('price', '<=', $pricemax);
        }

        if ($search) {
            $product = $product->where('title', 'like', '%' . $search . '%');
        }

        if ($order) {
            switch ($order) {
                case 'za':
                    $product->orderBy('prictitlee', 'DESC');
                    break;
                case '09':
                    $product->orderBy('price', 'ASC');
                    break;
                case '90':
                    $product->orderBy('price', 'DESC');
                    break;
                
                default:
                    # code...
                    $product->orderBy('title', 'ASC');
                    break;
            }
        }

        $product = $product->paginate(12, '*', 'page', $page);
        return $product;
    }
}