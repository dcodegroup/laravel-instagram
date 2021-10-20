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

    /*
     * Here you may set the routing configuration for the oauth routes.
     * You may change which middlewares will be applied to the routes.
     *
     * `web` middleware must be available to access session storage
     * for storing state data to improve authorization security.
     */
    'routing' => [
        'name' => 'instagram.',
        'prefix' => 'instagram-oauth',
        'middlewares' => ['web']
    ],

    /*
     * Here you may change the default redirect after successful OAuth authorization.
     */
    'redirects' => [
        'success' => 'admin.home',
    ],
];
