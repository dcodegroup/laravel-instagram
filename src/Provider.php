<?php

namespace DcodeGroup\InstagramFeed;

use DcodeGroup\InstagramFeed\Models\Instagram;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use MetzWeb\Instagram\Instagram as MetInstagram;

class Provider {

	public static function setCode($cliendId = null, $redirectUri = null) {
		if (isset($cliendId) && isset($redirectUri))
		{
			$url = "https://api.instagram.com/oauth/authorize/?client_id=$cliendId&redirect_uri=$redirectUri&response_type=code";
			header("Location: " . $url);
			die();
		}
		return null;
	}

	public static function getInstagramAccessToken($cliendId = null, $clientSecret = null, $redirectUri = null, $code = null)
	{
		if (isset($cliendId) && isset($clientSecret) && isset($redirectUri))
		{
			$fields = array(
				'client_id'     => $cliendId,
				'client_secret' => $clientSecret,
				'grant_type'    => 'authorization_code',
				'redirect_uri'  => $redirectUri,
				'code'          => $code
			);
			$url = 'https://api.instagram.com/oauth/access_token';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 20);
			curl_setopt($ch,CURLOPT_POST,true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			$result = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($result);
			return $result->access_token; //your token
		}
		return null;
	}

	public static function saveToken($cliendId = null, $clientSecret = null, $redirectUri = null)
	{
		$instagram = Instagram::where('client_id', $cliendId)->first();

		if (is_null($instagram)) {
			$instagram = new Instagram();

		$instagram->client_id = $cliendId;
		$instagram->client_secret = $clientSecret;
		$instagram->redirect_uri = $redirectUri;
		$instagram->user_id = auth()->id();
		$instagram->save();

		$cliendId = $instagram->client_id;
		$redirectUri = $instagram->redirect_uri;

		try {
			Provider::setCode($cliendId, $redirectUri);
		} catch (\Exception $exception) {
			dd($exception->getMessage());
		}

		return back();
	}

	public static function getFeed($token = null)
	{
		$res = [];
		if (isset($token))
		{
			try
			{
				$client   = new Client();
				$url      = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $token;
				$response = $client->get($url);
				$body = json_decode((string)$response->getBody());
				return  $body->data;
			}
			catch (\Exception $e)
			{
				$res = [];
			}
		}

		return $res;
	}
}