<?php
namespace tinymeng\wemeet;

use GuzzleHttp\Client as GuzzleClient;
use tinymeng\wemeet\Exception\ApiException;
use tinymeng\wemeet\Helper\Sign;

class Client
{
    protected $config;
    protected $http;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->http = new GuzzleClient([
            'base_uri' => 'https://api.meeting.qq.com/v1/',
            'timeout'  => 10.0,
        ]);
    }

    public function request($method, $uri, $params = [], $headers = [])
    {
        $secretId = $this->config['secret_id'];
        $secretKey = $this->config['secret_key'];
        $appId = $this->config['app_id'];
        $sdkId = $this->config['sdk_id'] ?? '';
        $region = $this->config['region'] ?? '';
        $nonce = mt_rand(100000, 999999);
        $timestamp = time();

        $body = ($method === 'GET') ? '' : json_encode($params, JSON_UNESCAPED_UNICODE);
        $uriPath = '/v1/' . ltrim($uri, '/');

        $signature = Sign::make($secretId, $secretKey, $method, $nonce, $timestamp, $uriPath, $body);

        $defaultHeaders = [
            'Content-Type'      => 'application/json',
            'X-TC-Key'          => $secretId,
            'X-TC-Timestamp'    => $timestamp,
            'X-TC-Nonce'        => $nonce,
            'X-TC-Signature'    => $signature,
            'AppId'             => $appId,
            'X-TC-Registered'   => '1',
        ];
        if ($sdkId) $defaultHeaders['SdkId'] = $sdkId;
        if ($region) $defaultHeaders['X-TC-Region'] = $region;

        $headers = array_merge($defaultHeaders, $headers);

        try {
            $options = [
                'headers' => $headers,
            ];
            if ($method !== 'GET') {
                $options['body'] = $body;
            } else {
                $options['query'] = $params;
            }
            $response = $this->http->request($method, $uri, $options);
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }
    }

}