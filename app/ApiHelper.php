<?php

namespace App;

use Illuminate\Support\Facades\Http;

class ApiHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function get($targetUrl)
    {
        $data = Http::get(config('app.website_api_url') . $targetUrl);
        return json_decode($data->body());
    }

    public static function post($targetUrl, $payload)
    {
        $data = Http::post(config('app.website_api_url') . $targetUrl, $payload);
        return json_decode($data->body());
    }

    public static function delete($targetUrl, $payload = [])
    {
        $data = Http::delete(config('app.website_api_url') . $targetUrl, $payload);
        return json_decode($data->body());
    }

    public static function patch($targetUrl, $payload)
    {
        $data = Http::patch(config('app.website_api_url') . $targetUrl, $payload);
        return json_decode($data->body());
    }
}
