<?php

declare(strict_types=1);

namespace tinymeng\wemeet\TencentCloud\Common;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 发送http请求

    /**
     * @throws GuzzleException
     */
    public function send($host, $method, $uri, array $data = [], array $header = [])
    {
        $url = $host . $uri;
        $options = [];
        if (! empty($header)) {
            $options['headers'] = $header;
        }
        switch (strtolower($method)) {
            case 'get':
                if (! empty($data)) {
                    $options['query'] = $data;
                }
                var_dump($url);
                var_dump($options);
                try {
                    $result = $this->client->get($url, $options)->getBody()->getContents();
                }catch (\Exception $exception){
                    var_dump($exception->getFile());
                    var_dump($exception->getLine());
                    var_dump($exception->getCode());
                    var_dump($exception->getMessage());
                }
                var_dump($result);die;
                break;
            case 'post':
                if (! empty($data)) {
                    $options['json'] = $data;
                }
                $result = $this->client->post($url, $options)->getBody()->getContents();
                break;
            case 'delete':
                if (! empty($data)) {
                    $options['query'] = $data;
                }
                $result = $this->client->delete($url, $options)->getBody()->getContents();
                break;
            case 'put':
                if (! empty($data)) {
                    $options['json'] = $data;
                }
                $result = $this->client->put($url, $options)->getBody()->getContents();
                break;
            case 'patch':
                if (! empty($data)) {
                    $options['json'] = $data;
                }
                $result = $this->client->patch($url, $options)->getBody()->getContents();
                break;
            default:
                throw new \Exception('method error!');
        }

        return json_decode($result, true);
    }
}
