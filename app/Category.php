<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * date attributes to be used by Carbon
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * setting the slug of the category
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if (!$this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }

    /**
     * getting all the posts for the category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * getting the sub categories for the category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_categories()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    /**
     * getting the parent category of the category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_category()
    {
        return $this->belongsTo('App\Category', 'parent_id', 'id');
    }

}
