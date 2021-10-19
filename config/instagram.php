<?php

return [
    'client_id' => env('INSTAGRAM_CLIENT_ID'),
    'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),

    'scopes' => [
        'user_profile', 'user_media',
        'instagram_graph_user_profile'
        // Add your scopes here
    ],

    'redirect_route' => 'instagram.redirect',

    'auth_redirect_route' => 'admin.home',
];
