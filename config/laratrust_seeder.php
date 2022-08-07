<?php

return [
    'role_structure' => [
        'super_administrator' => [
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'companies' => 'c,r,u,d',
            'complaint_products' => 'c,r,u,d',
            'complaints' => 'c,r,u,d',
            'depts' => 'c,r,u,d',
            'examinations' => 'c,r,u,d',
            'infos' => 'c,r,u,d',
            'mandobs' => 'c,r,u,d',
            'mandob_stages' => 'c,r,u,d',
            'mandob_rates' => 'c,r,u,d',
            'user_rates' => 'c,r,u,d',
            'most_products' => 'c,r,u,d',
            'notifies' => 'c,r,u,d',
            'notify_users' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'order_stages' => 'c,r,u,d',
            'places' => 'c,r,u,d',
            'products' => 'c,r,u,d,p',
            'receipt_status' => 'c,r,u,d',
            'return_reasons' => 'c,r,u,d',
            'sliders' => 'c,r,u,d',
            'stores' => 'c,r,u,d',
            'subcategories' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
            'statistics' => 'c,r,u,d'
        ],
        'supervisor' => [
            'orders' => 'r',
            'mandob_rates' => 'r',
            'user_rates' => 'r',
            'stores' => 'r',
            'statistics' => 'r',
            'depts' => 'r'
        ],
        'accountant' => [
            'clients' => 'c',
            'store' => 'r',
            'products' => 'p',
            'notifies' => 'c,r,u,d',
            'notify_users' => 'c,r,u,d',
            'statistics' => 'r'
        ],
        'store_keeper' => [
            'examinations' => 'c,r',
            'clients' => 'c',
            'store' => 'r'
        ],

//        'user' => [
//            'profile' => 'r,u'
//        ],
    ],
//    'permission_structure' => [
//        'cru_user' => [
//            'profile' => 'c,r,u'
//        ],
//    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'a' => 'assign',
        'p' => 'price',
    ]
];
