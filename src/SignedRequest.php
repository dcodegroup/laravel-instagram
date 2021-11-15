<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SignedRequest extends Request
{
    protected array $payload = [];

    public function validateSignature()
    {
        if (!$this->has('signed_request')) {
            abort(403);
        }

        [$signature, $rawPayload] = explode('.', $this->input('signed_request'));
        $signature = $this->decodeB64String($signature);
        $payload = json_decode($this->decodeB64String($rawPayload), true);

        $expectedSignature = $this->generateSignature($rawPayload);

        if ($signature !== $expectedSignature) {
            abort(403, __('Signature mismatch.'));
        }

        $this->payload = $payload;
    }

    public function payload(?string $key = null)
    {
        if ($key) {
            return Arr::get($this->payload, $key);
        }

        return $this->payload;
    }

    protected function decodeB64String(string $string)
    {
        return base64_decode(strtr($string, '-_', '+/'));
    }

    protected function generateSignature(string $payload): string
    {
        return hash_hmac('sha256', $payload, config('instagram.oauth.client_secret'), true);
    }
}
