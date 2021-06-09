<?php

namespace VCComponent\Laravel\Notification\Services\Api;

use Exception;
use Illuminate\Support\Facades\Http;

class WebpressNotificationApi
{
    private $baseUrl;
    private $version;

    public function __construct()
    {
        $this->baseUrl = config('webpress-notification.base_url');
        $this->version = config('webpress-notification.version') ?: 'v1';
        if (!$this->baseUrl) {
            throw new Exception('Webpress base URL is missing');
        }
    }

    private function urlBuilder($path)
    {
        return "{$this->baseUrl}/{$this->version}/{$path}";
    }

    public function send($data)
    {
        $response = Http::post("{$this->urlBuilder('messages/send')}", $data);

        if ($response->failed()) {
            throw new Exception($response->body());
        }

        // $response->throw();
    }
}
