<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class Layout
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 添加会议布局
    public function addLayout($params)
    {
        return $this->client->request('POST', 'layouts', $params);
    }

    // 添加自定义布局
    public function addCustomLayout($params)
    {
        return $this->client->request('POST', 'layouts/custom', $params);
    }

    // 应用布局
    public function applyLayout($params)
    {
        return $this->client->request('POST', 'layouts/apply', $params);
    }
}
