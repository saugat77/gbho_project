<?php
return [
    /*
    * The roles required by the application
    */
    'roles' => [
        'super-admin',
        'admin',
        'customer',
    ],

    /*
    *  Default users which will be seeded
    */
    'users' => [
        [
            'name' => 'James Bhatta',
            'email' => 'jmsbhatta@gmail.com',
            'password' => 'password',
            'roles' => ['super-admin']
        ],
        [
            'name' => 'Admin',
            'email' => 'admin@makalu.com',
            'password' => 'password',
            'roles' => ['admin']
        ],
        [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'roles' => ['customer']
        ]
    ],

    /*
    * List of permissions to be register
    */
    'permissions' => [
        'view user',
        'create user',
        'update user',
        'destroy user',
    ]
];
