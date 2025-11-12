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
}
