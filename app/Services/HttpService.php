<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpService
{
    public function get($url, $params = [])
    {
        return Http::get($url, $params);
    }
}
