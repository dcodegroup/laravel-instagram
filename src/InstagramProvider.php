<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Support\ServiceProvider;

class InstagramProvider extends ServiceProvider {

	public function boot()
	{
		require __DIR__ . '/routes/web.php';

		$this->publishes([
			__DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
		], 'migrations');

	}
}