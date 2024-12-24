<?php

declare(strict_types=1);

namespace tinymeng\wemeet\TencentCloud\Meeting\v1;


// 腾讯会议
use GuzzleHttp\Client;
use tinymeng\wemeet\TencentCloud\Common\Credential;
use tinymeng\wemeet\TencentCloud\Common\Exception\TencentCloudSDKException;
use tinymeng\wemeet\TencentCloud\Common\HttpClient;
use tinymeng\wemeet\TencentCloud\RestApi\MeetingRestApi;

class Meeting
{
    private $appId = '';

    private $sdkId = 'v1';

    private $secretId = '';

    private $secretKey = '';

    private $config;

    /* @var HttpClient $client */
    private $client;

    public function __construct(Credential $credential,Client $client)
    {
        $this->appId = $credential->getAppId();
        $this->secretId = $credential->getSecretId();
        $this->secretKey = $credential->getSecretKey();
        $this->client = new HttpClient($client);
    }

    // 分发接口请求
    public function send($model, $action, array $params = [], array $header = [])
    {
        $restApi = new MeetingRestApi();
        $api = $restApi->getApi($model,$action);
        if(!$api){
            throw new TencentCloudSDKException("MeetingRestApi ERROR", "MeetingRestApi not model and action!");
        }
        $header = array_merge($header, $this->getHeader($api['method'], $api['uri'], $params));
        return $this->client->send($restApi->getHost(), $api['method'], $api['uri'], $params, $header);
    }

    // 获取签名
    protected function sign($method, $timestamp = '', $nonce = '', $params = [], $uri = '/v1/meetings')
    {
        $body = '';
        if (in_array($method, ['GET', 'DELETE'])) {
            $path = '';
            foreach ($params as $k => $v) {
                $path .= $k . '=' . $v . '&';
            }
            if (count($params) > 0) {
                $path = substr($path, 0, strlen($path) - 1);
                $uri .= '?' . $path;
            }

        } else {
            if ($params) {
                $body = json_encode($params);
            }
        }
        $headerString = "X-TC-Key={$this->secretId}&X-TC-Nonce={$nonce}&X-TC-Timestamp={$timestamp}";
        $strToSign = "{$method}\n{$headerString}\n{$uri}\n{$body}";
        $hash = hash_hmac('sha256', $strToSign, $this->secretKey);
        return base64_encode($hash);
    }

    // 公共设置参数
    protected function getHeader($method, $uri, array $params = [])
    {
        $time = (string) time();
        $nonce = (string) rand(1, 999999999);
        $signature = $this->sign(strtoupper($method), $time, $nonce, $params, $uri);

        return [
            'X-TC-Key' => $this->secretId,
            'X-TC-Timestamp' => $time,
            'X-TC-Nonce' => $nonce,
            'X-TC-Signature' => $signature,
            'AppId' => $this->appId,
            'SdkId' => $this->sdkId,
            'URI' => $uri,
            'Content-Type' => 'application/json',
        ];
    }
}
