<?php

Route::get('instagram/callback', function (\Illuminate\Http\Request $request) {
	$instagram = \DcodeGroup\InstagramFeed\Models\Instagram::all()->first();
	if ($instagram)
	{
		$instagram->code = $request->get('code');
		$instagram->save();
	}
	return redirect('/');
});