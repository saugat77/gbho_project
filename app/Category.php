<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Category extends Model
{
    use HasSlug,
        SoftDeletes,
        HasUserStamps;

    protected $guarded = [];

    protected static function booted()
    {
        // static::addGlobalScope(new ActiveScope);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query, $active = true)
    {
        return $query->where('active', $active);
    }

    public function parentCategory()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function childCategories()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function productGrids()
    {
        return $this->hasMany('App\ProductGrid');
    }
}
