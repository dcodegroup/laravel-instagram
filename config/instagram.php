<?php

return [
    'client_id' => env('INSTAGRAM_CLIENT_ID'),
    'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),

    'scopes' => [
        'user_profile', 'user_media',
        // Add your scopes here
    ],
];
