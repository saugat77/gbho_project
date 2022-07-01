<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function getUrl()
    {
        return asset('storage/' . $this->image_path);
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function getSmallThumbnailUrlAttribute()
    {
        return Storage::url($this->small_thumbnail_path);
    }

    public function getMediumThumbnailUrlAttribute()
    {
        return Storage::url($this->medium_thumbnail_path);
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
