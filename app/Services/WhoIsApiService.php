<?php

namespace App\Services;

use App\Contracts\DomainInterface;
use Illuminate\Support\Facades\Log;

class WhoIsApiService implements DomainInterface
{
    protected $httpService;
    protected $url;
    protected $apiKey;

    public function __construct(HttpService $httpService, $url, $apiKey)
    {
        $this->httpService = $httpService;
        $this->url = $url;
        $this->apiKey = $apiKey;
    }

    public function check($domain)
    {
        try {
            $response = $this->httpService->get($this->url,[
                'domainName' => $domain,
                'apiKey' => $this->apiKey,
                'outputFormat' => 'json'
            ]);
            $data = $response->json();
            if (isset($data['WhoisRecord'])) {
                $isAvailable = false;
                $expirationDate = $data['WhoisRecord']['expiresDate'] ?? null;
            } else {
                $isAvailable = true;
                $expirationDate = null;
            }

            return [
                'domain' => $domain,
                'isAvailable' => $isAvailable,
                'expirationDate' => $expirationDate
            ];
        } catch (\Exception $e) {
            Log::error("Exception during Whois API request", ['exception' => $e->getMessage()]);
            return [
                'domain' => $domain,
                'isAvailable' => null,
                'expirationDate' => null,
                'error' => 'Произошла ошибка: ' . $e->getMessage()
            ];
        }
    }
}
