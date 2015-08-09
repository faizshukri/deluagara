<?php

return [
    'emails' => [
        'admin'   => [
            'name' => 'Administrator Katsitu.com',
            'address' => 'admin@katsitu.com',
        ],
        'technician' => [
            'name' => 'Support Katsitu.Com',
            'address' => env('KATSITU_SUPPORT_EMAIL', 'support@katsitu.com')
        ],
        'noreply' => [
            'name' => 'No-Reply Katsitu.com',
            'address' => 'no-reply@katsitu.com'
        ]
    ]
];