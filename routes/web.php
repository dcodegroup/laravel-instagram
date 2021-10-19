<?php

use DcodeGroup\InstagramFeed\Controller\AuthorizationController;
use DcodeGroup\InstagramFeed\Controller\DeauthorizeController;
use DcodeGroup\InstagramFeed\Controller\RedirectController;
use DcodeGroup\InstagramFeed\StateValidationMiddleware;

Route::as('instagram.')
    ->prefix('instagram-oauth')
    ->middleware('web')
    ->group(function () {
        Route::get('/authorize', [AuthorizationController::class, 'form'])->name('authorize.form');
        Route::post('/authorize', [AuthorizationController::class, 'action'])->name('authorize');

        Route::get('/redirect', RedirectController::class)
            ->name('redirect')
            ->middleware(StateValidationMiddleware::class);

        Route::post('/deauthorize', DeauthorizeController::class)->name('deauthorize');
    });
