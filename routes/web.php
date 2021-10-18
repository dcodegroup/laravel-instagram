<?php

use DcodeGroup\InstagramFeed\Controller\AuthorizationController;
use DcodeGroup\InstagramFeed\Controller\RedirectController;

Route::group(['name' => 'instagram.'], function () {
    Route::post('/authorize', AuthorizationController::class)->name('authorize');
    Route::get('/redirect', RedirectController::class)->name('redirect');
    // Handle datadeletion route and failure route
});
