<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalTrait;

class PageSettings extends Model
{
    use GlobalTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url_facebook',
        'url_twiter',
        'url_instagram',
        'url_pinterest',
        'url_youtube',
        'url_skype',

        'currency',

        'email',
        'address',
        'phone_items',
        'logo',
        'logomenu',
        'descriplogo',

        'credit_card_title',
        'credit_card_items',
        'delivery_items',
        'phone_whatsapp',
    ];

     /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'credit_card_items' => [],
        'phone_items' => [],
        'delivery_items' => [],
    ];

    protected $casts = [
        'credit_card_items' => 'array',
        'phone_items' => 'array',
        'delivery_items' => 'array',
    ];

    public function getPhoneItemsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setPhoneItemsAttribute($value)
    {
        $this->attributes['phone_items'] = json_encode(array_values($value));
    }

    public function getCreditCardItemsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setCreditCardItemsAttribute($value)
    {
        $this->attributes['credit_card_items'] = json_encode(array_values($value));
    }

    public function getDeliveryItemsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setDeliveryItemsAttribute($value)
    {
        $this->attributes['delivery_items'] = json_encode(array_values($value));
    }

}
