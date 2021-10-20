<?php

return [
    'oauth' => [
        'client_id' => env('INSTAGRAM_CLIENT_ID'),
        'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),
        'scopes' => [
            'user_profile', 'user_media',
            'instagram_graph_user_profile'
        ],
        'state_session_key' => 'instagram_oauth2_state',
    ],

    'redirect_route' => 'instagram.redirect',

    'auth_redirect_route' => 'admin.home',

];
