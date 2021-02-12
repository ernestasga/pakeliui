<?php
return [
    'free' => [
        'name' => 'Free',
        'price' => config('variables.regular_price'),
        'attributes' => [
            config('limits.regular_user_max_active_listings').' active '.trans_choice('text.listing', 1),
            'Unlimited hotline messages',
        ]
    ],
    'vip' => [
        'name' => 'VIP',
        'price' => config('variables.vip_price'),
        'attributes' => [
            config('limits.vip_user_max_active_listings').' active '.trans_choice('text.listing', 2),
            'Unlimited hotline messages',
            'Colorized listings and hotline messages',
            'Custom profile and listing image',
            'Satisfaction of supporting this project',
        ]
    ],
    'supporter' => [
        'name' => 'Supporter',
        'price' => config('variables.supporter_price'),
        'attributes' => [
            config('limits.supporter_user_max_active_listings').' active '.trans_choice('text.listing', 2),
            'Unlimited hotline messages',
            'Colorized listings and hotline messages',
            'Custom profile and listing image',
            'Satisfaction of supporting this project',
        ]
    ]

];
