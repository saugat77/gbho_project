<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    public const EXCERPT_LENGTH = 150;
    public const SEO_DESCRIPTION_LENGTH = 120;

    protected $guarded = ['id'];

    protected $casts = [
        'is_draft' => 'boolean',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
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

    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }

    public function isDraft()
    {
        return $this->is_draft;
    }

    public function scopePublished($query)
    {
        return $query->where('is_draft', false);
    }

    public function isPublished()
    {
        return $this->is_draft ? false : true;
    }

    public function imageUrl()
    {
        return Storage::url($this->cover_image);
    }
}
