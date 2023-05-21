<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageAbout extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'about';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_show',
        'main_title',
        'history_title',
        'history_description',
        'history_mark',
        'history_image',
        'history_video_show',
        'history_video_url',
        'about_show',
        'about_title',
        'about_items',
        'team_show',
        'team_title',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'about_items' => [],
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'about_items' => 'array',
    ];

    /**
     * Get the products for the brand post.
     */
    public function members()
    {
        return $this->hasMany('App\Models\Member', 'about_id');
    }

    public function getAboutItemsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setAboutItemsAttribute($value)
    {
        $this->attributes['about_items'] = json_encode(array_values($value));
    }
}
