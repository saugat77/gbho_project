<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Site Logo Path
    |--------------------------------------------------------------------------
    |
    | The default site logo. This path should be relative from the public
    | directory. More priority is given to the logo set in the general
    | section of settings.
    |
    */
    'site_logo' => 'images/logo.png',

    'image_directory' => 'uploads',


    'price_unit' => 'Rs.',


    'store' => [
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'suspended' => 'Suspended'
        ]
    ],

    'order' => [
        'status' => [
            'pending' => 'Pending',
            // 'confirmed' => 'Confirmed',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'refunded' => 'Refunded',
        ],

        'payment_status' => [
            'pending' => 'Pending',
            'paid' => 'Paid',
            'refunded' => 'Refunded',
        ]
    ],

    'discount_card' => [
        'status' => [
            'pending',
            'active',
            'expired',
            'disabled'
        ]
    ],

    'image_slider' => [
        'groups' => ['primary', 'secondary']
    ],

    'cache' => [
        'multilevel-category-menu' => [
            'key' => 'multilevel-category-menu',
            'expiration_time' => 60 * 60 * 24
        ]
    ],

    'product_image' => [
        'size' => [
            'small' => [
                'name' => 'small',
                'width' => null,
                'height' => 300
            ],
            'medium' => [
                'name' => 'medium',
                'width' => null,
                'height' => 800
            ]
        ]
    ]
];
