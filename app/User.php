<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Administrator
{

    /**
     * Get the subuser that owns the phone.
     */
    public function subuser()
    {
        return $this->hasOne('App\Models\Subuser');
    }
    
}
