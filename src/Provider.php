<?php

namespace DcodeGroup\Instagramfeed;
use GuzzleHttp\Client;

class Provider {
	public static function getFeed($token = null)
	{
		$res = [];
		if (isset($token))
		{
			try
			{
				$client   = new Client\();
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

	}
}