<?php

namespace frontend\services;

const USER_AGENT = 'getoutof/testC2M';

class CurlService
{
    public function __construct(
        private string $url
    ) {}

    public function execute()
    {
        $ch = curl_init($this->url);
        $headers = [
            sprintf("User-Agent: %s", USER_AGENT)
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}