<?php
return [
    'free' => [
        'name' => 'Nemokamas',
        'price' => config('variables.regular_price'),
        'attributes' => [
            config('limits.regular_user_max_active_listings').' Aktyvus '.trans_choice('text.listing', 1),
            'Neribotos karštosios linijos žinutės',
        ]
    ],
    'vip' => [
        'name' => 'VIP',
        'price' => config('variables.vip_price'),
        'attributes' => [
            config('limits.vip_user_max_active_listings').' Aktyvūs '.trans_choice('text.listing', 2),
            'Neribotos karštosios linijos žinutės',
            'Spalvoti skelbimai ir karštosios linijos žinutės',
            'Profilio uždangos ir skelbimų nuotraukos',
            'Pasitenkinimas parėmus šį projektą',
        ]
    ],
    'supporter' => [
        'name' => 'Rėmėjas',
        'price' => config('variables.supporter_price'),
        'attributes' => [
            config('limits.supporter_user_max_active_listings').' Aktyvūs '.trans_choice('text.listing', 2),
            'Neribotos karštosios linijos žinutės',
            'Spalvoti skelbimai ir karštosios linijos žinutės',
            'Profilio uždangos ir skelbimų nuotraukos',
            'Pasitenkinimas parėmus šį projektą',
        ]
    ]

];
