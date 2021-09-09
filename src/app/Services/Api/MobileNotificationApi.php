<?php

namespace VCComponent\Laravel\Notification\Services\Api;

use Exception;
use Illuminate\Support\Facades\Http;

class MobileNotificationApi
{
    private $baseUrl;
    private $version;

    public function __construct()
    {
        $this->baseUrl = config('webpress-notification.mobile-notification.base_url');
        $this->version = config('webpress-notification.mobile-notification.version') ?: 'v1.0';
        if (!$this->baseUrl) {
            throw new Exception('Base URL is missing');
        }
    }

    private function urlBuilder($path)
    {
        return "{$this->baseUrl}/{$this->version}/{$path}";
    }

    public function send($data)
    {
        $response = Http::post("{$this->urlBuilder('notification')}", $data);

        if ($response->failed()) {
            throw new Exception($response->body());
        }
    }
}
