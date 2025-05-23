<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class Resource
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 查询账号资源统计
    public function getAccountResourceStats($params = [])
    {
        return $this->client->request('GET', 'resources/account_stats', $params);
    }

    // 查询账号类型资源使用统计
    public function getResourceUsageStats($params = [])
    {
        return $this->client->request('GET', 'resources/usage_stats', $params);
    }

    // 查询账户下 Rooms 资源
    public function getAccountRooms($account_id, $params = [])
    {
        return $this->client->request('GET', "accounts/{$account_id}/rooms", $params);
    }
}
