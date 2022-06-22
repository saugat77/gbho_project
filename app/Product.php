<?php

namespace App;

use App\Traits\HasWishlist;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Product extends Model implements Buyable
{
    use HasSlug,
        SoftDeletes,
        HasUserStamps,
        HasWishlist,
        CanBeBought;

    public const EXCERPT_LENGTH = 150;
    public const SEO_DESCRIPTION_LENGTH = 200;

    protected $guarded = [];

    protected $with = ['featuredImage'];

    protected $dates = [
        'sale_price_from', 'sale_price_to'
    ];

    protected $casts = [
        'is_top' => 'boolean',
        'is_active' => 'boolean',
        'manage_stock' => 'boolean',
        'limited_stock' => 'boolean',
    ];

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

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->current_price;
    }

    public function getBuyableWeight($options = null)
    {
        return 0;
    }

    public function scopeActive($query, $status = true)

    {
        return $query->where('is_active', $status);
    }

    public function getFeaturedImageUrlAttribute()
    {
        return asset('storage/' . $this->featuredImage->image_path);
    }

    public function getSmallFeaturedImageUrlAttribute()
    {
        return asset('storage/' . $this->featuredImage->small_thumbnail_path);
    }

    public function getMediumFeaturedImageUrlAttribute()
    {
        return asset('storage/' . $this->featuredImage->medium_thumbnail_path);
    }

    public function hasDiscount()
    {
        return $this->sale_price
            ? Carbon::now()->between($this->sale_price_from, $this->sale_price_to)
            : false;
    }

    public function discountPercentage($withSign = true)
    {
        $discountAmount = (int)$this->regular_price - (int)$this->sale_price;
        $discountPercent = round(($discountAmount / $this->regular_price) * 100);
        if ($withSign) {
            $discountPercent = $discountPercent . '%';
        }
        return $this->hasDiscount() ? $discountPercent : null;
    }

    public function getCurrentPriceAttribute()
    {
        return $this->hasDiscount() ? $this->sale_price : $this->regular_price;
    }

    public function hasLimitedStock()
    {
        return $this->limited_stock || $this->stock_quantity <= limitedStockThreshold()
            ? true
            : false;
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }

    public function seoTitle()
    {
        return $this->seo_title ?? $this->name;
    }

    public function seoDescription()
    {
        return $this->seo_description ?? Str::substr(strip_tags($this->description), 0, self::SEO_DESCRIPTION_LENGTH);
    }

    public function seoImage()
    {
        if (!$this->featuredImage) {
            return null;
        }

        return $this->featuredImage->imageUrl;
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function productImages()
    {
        return $this->hasMany('App\ProductImage')->where('is_featured', false);
    }

    public function featuredImage()
    {
        return $this->hasOne('App\ProductImage')->withDefault();
    }

    public function ratings()
    {
        return $this->hasMany('App\ProductRating');
    }

    public function purchasedProducts()
    {
        return $this->hasMany('App\PurchasedProduct');
    }
}
