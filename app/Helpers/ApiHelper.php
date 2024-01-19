<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiHelper
{
    protected string $baseUrl;
    protected Client $client;
    protected array $auth;

    public function __construct($baseUrl, $username = null, $password = null)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->client = new Client();

        $this->auth = [];

        if ($username && $password) {
            $this->auth = [$username, $password];
        }
    }

    public function get($endpoint, $queryParams = [])
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        try{
            return $this->client->get($url, [
                'query' => $queryParams,
                'auth' => $this->auth,
            ]);
        } catch (GuzzleException $e){
            return $e;
        }

    }

    public function post($endpoint, $data = [])
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        try {
            return $this->client->post($url, [
                'json' => $data,
                'auth' => $this->auth,
            ]);
        } catch (GuzzleException $e){
            return $e;
        }
    }
}
