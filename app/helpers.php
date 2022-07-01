<?php

use Gloudemans\Shoppingcart\Facades\Cart;

if (!function_exists('invalid_class')) {
    /**
     * Check for the existence of an error message and return a class name
     *
     * @param  string  $key
     * @return string
     */
    function invalid_class($key, $preset = null)
    {
        $errors = session()->get('errors') ?: new \Illuminate\Support\ViewErrorBag;
        $invalidClass = $preset ? 'border-red-500' : 'is-invalid';
        return $errors->has($key) ? $invalidClass : '';
    }
}


if (!function_exists('invalid_feedback')) {
    /**
     * Check if the route is active or not
     *
     * @param  string  $key
     * @return string
     */
    function invalid_feedback($key)
    {
        $key = str_replace(['\'', '"'], '', $key);
        $errors = session()->get('errors') ?: new \Illuminate\Support\ViewErrorBag;
        if ($message = $errors->first($key)) {
            return '<?= <div class="invalid-feedback">' . $message . '</div>; ?';
        }
    }
}

if (!function_exists('setActive')) {
    /**
     * Check if the route is active or not
     *
     * @param  string  $key
     * @return string
     */
    function setActive($path, $active = 'active')
    {
        return Request::routeIs($path) ? $active : '';
    }
}

if (!function_exists('siteName')) {
    function siteName()
    {
        return settings('site_name', config('app.name'));
    }
}

if (!function_exists('tagline')) {
    function tagline()
    {
        return settings('tagline');
    }
}

if (!function_exists('siteLogoUrl')) {
    function siteLogoUrl()
    {
        if (settings()->get('site_logo')) {
            return asset('storage/' . settings()->get('site_logo'));
        }
        return asset(config('constants.site_logo'));
    }
}

if (!function_exists('priceUnit')) {
    function priceUnit()
    {
        return settings()->get('price_unit', config('constants.price_unit'));
    }
}

if (!function_exists('formatted_price')) {
    function formatted_price($price)
    {
        return settings()->get('price_unit', config('constants.price_unit')) . number_format($price);
    }
}

if (!function_exists('limitedStockThreshold')) {
    function limitedStockThreshold()
    {
        return (int)settings()->get('limited_stock_threshold', 10);
    }
}

if (!function_exists('shippingCharge')) {
    function shippingCharge()
    {
        return (int)settings()->get('shipping_charge', 100);
    }
}


// Sync the current price for the items in cart
if (!function_exists('synCartPrice')) {
    function synCartPrice()
    {
        foreach (Cart::content() as $cartItem) {
            $cartItem->price = $cartItem->model->current_price;
        }
    }
}

if (!function_exists('is_mobile')) {
    function is_mobile()
    {
        return session()->get('mobile') == true;
    }
}

if (!function_exists('is_desktop')) {
    function is_desktop()
    {
        return session()->get('mobile') == false;
    }
}
