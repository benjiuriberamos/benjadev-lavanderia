<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalProducts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'local_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock',
        'product_id',
        'local_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setAttribute('stock', 0);
    }

    /**
     * Get the product associated with the detail.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Get the local associated with the detail.
     */
    public function local()
    {
        return $this->belongsTo('App\Models\Local');
    }
}
