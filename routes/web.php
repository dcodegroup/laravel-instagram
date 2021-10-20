<?php

use DcodeGroup\InstagramFeed\Controller\AuthorizationController;
use DcodeGroup\InstagramFeed\Controller\DeauthorizeController;
use DcodeGroup\InstagramFeed\Controller\RedirectController;
use DcodeGroup\InstagramFeed\Profile;
use DcodeGroup\InstagramFeed\ProfileService;
use DcodeGroup\InstagramFeed\StateValidationMiddleware;

Route::as('instagram.')
    ->prefix(config('instagram.routing.prefix'))
    ->middleware(config('instagram.routing.middlewares'))
    ->group(function () {
        Route::get('/authorize', [AuthorizationController::class, 'form'])->name('authorize.form');
        Route::post('/authorize', [AuthorizationController::class, 'action'])->name('authorize');

        Route::get('/redirect', RedirectController::class)
            ->name('redirect')
            ->middleware(StateValidationMiddleware::class);

        Route::post('/deauthorize', DeauthorizeController::class)->name('deauthorize');

        if (app()->environment('local')) {
            Route::get('/media-test', function (ProfileService $service) {
                return view('instagram::media-test', [
                    'media' => $service->getMedias(Profile::latest()->first(), 15)
                ]);
            });
        }
    });
