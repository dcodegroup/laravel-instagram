<?php

Route::get($instagram->redirect_uri, function (\Illuminate\Http\Request $request) {
	$instagram = \DcodeGroup\InstagramFeed\Models\Instagram::all()->first();
	if ($instagram)
	{
		if ($request->has('code'))
		{
			$instagram->code = $request->get('code');
			$instagram->save();

			try {
				$instagram->access_token = \DcodeGroup\InstagramFeed\Provider::getInstagramAccessToken($instagram->client_id,
					$instagram->client_secret,
					$instagram->redirect_uri,
					$instagram->code);
				$instagram->save();
			} catch (\Exception $exception)
			{

			}
		}
	}
	return redirect('/');
});