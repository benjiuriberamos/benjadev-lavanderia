<?php

namespace App\Traits;

use App\User;
use App\Models\Local;
use App\Models\Product;
use App\Models\LocalProducts;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Encore\Admin\Auth\Database\Administrator;
use Symfony\Component\HttpFoundation\Request;

trait UtilsTrait
{

    private function getUser() 
    {

        return User::where('username', auth()->user()->username)->first();
    }

    private function getLocal() 
    {
        $local = Local::whereHas('subusers', function (Builder $query) {
            $query->whereHas('user', function (Builder $query) {
                $query->where('username', auth()->user()->username);
            });
        })
        ->first();
        return $local;
    }

    private function getLocalByUser(Administrator $user) 
    {
        $local = Local::whereHas('subusers', function (Builder $query) use ($user) {
            $query->whereHas('user', function (Builder $query) use ($user) {
                $query->where('username', $user->username);
            });
        })
        ->first();
        return $local;
    }

    private function productsForUser() {

		if (Admin::user()->isRole('usuario-subalmacen')) {
			$productos = LocalProducts::with('product')
				->where('local_id', $this->getLocal()->id)
				->get();
			$productos = $productos->map(function ($e) {
				$product = $e->product()->first();
				return array(
					'id' => $product->id,
					'title' => $product->title . ' | STOCK[' . $e->stock . ']',
				);
			})->toArray();

		} else {
			$productos = DB::table('products')
				->select('id', 'title', 'stock')
				->get();
			$productos = $productos->map(function ($e) {
				return array(
					'id' => $e->id,
					'title' => $e->title . ' | STOCK[' . $e->stock . ']',
				);
			})->toArray();

		}
		
		$productos = array_column($productos, 'title', 'id');
		return $productos;
	}
}