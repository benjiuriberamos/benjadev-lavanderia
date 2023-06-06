<?php

namespace App\Traits;

use App\User;
use App\Models\Local;
use App\Models\Product;
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
}