<?php

use DcodeGroup\InstagramFeed\Controller\AuthorizationController;
use DcodeGroup\InstagramFeed\Controller\DeauthorizeController;
use DcodeGroup\InstagramFeed\Controller\RedirectController;
use DcodeGroup\InstagramFeed\StateValidationMiddleware;

Route::group(['name' => 'instagram.'], function () {
    Route::post('/authorize', AuthorizationController::class)->name('authorize');

    Route::get('/redirect', RedirectController::class)
        ->name('redirect')
        ->middleware(StateValidationMiddleware::class);

    Route::post('/deauthorize', DeauthorizeController::class)->name('deauthorize');
});
