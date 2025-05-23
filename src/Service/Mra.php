<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class Mra
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 查询 MRA 状态信息
    public function getStatus($mra_id)
    {
        return $this->client->request('GET', "mra/{$mra_id}/status");
    }

    // 切换 MRA 默认布局
    public function switchLayout($mra_id, $params)
    {
        return $this->client->request('POST', "mra/{$mra_id}/switch_layout", $params);
    }

    // 举手/手放下
    public function handAction($mra_id, $params)
    {
        return $this->client->request('POST', "mra/{$mra_id}/hand_action", $params);
    }

    // 呼叫挂断
    public function hangup($mra_id)
    {
        return $this->client->request('POST', "mra/{$mra_id}/hangup");
    }
}
