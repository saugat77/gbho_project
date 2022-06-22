<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

BreadCrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('products', function ($trail) {
    $trail->parent('home');
    $trail->push('Products', route('frontend.products.index'));
});

Breadcrumbs::for('products-category', function ($trail, $category) {
    if ($category->parent_id) {
        $trail->parent('products-category', $category->parentCategory);
    } else {
        $trail->parent('products');
    }
    $trail->push($category->name, route('frontend.products.index', ['category' => $category->slug]));
});

Breadcrumbs::for('single-product', function ($trail, $product) {
    $trail->parent('products-category', $product->category);
    $trail->push($product->name, route('frontend.products.index'));
});

// Home > Discount card
Breadcrumbs::for('discount-card', function ($trail) {
    $trail->parent('home');
    $trail->push('Application for discount card', route('frontend.discount-card.index'));
});

// Home > Contact us
Breadcrumbs::for('contact-us', function ($trail) {
    $trail->parent('home');
    $trail->push('Contact Us', route('frontend.contact-form.index'));
});

Breadcrumbs::for('page', function ($trail, $title) {
    $trail->parent('home');
    $trail->push($title);
});

Breadcrumbs::for('blogs', function ($trail) {
    $trail->parent('home');
    $trail->push('Blogs', route('frontend.blogs.index'));
});

Breadcrumbs::for('single-blog', function ($trail, $post) {
    $trail->parent('blogs');
    $trail->push($post->title, route('frontend.blogs.index'));
});
