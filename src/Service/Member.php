<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class Member
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 创建成员
    public function create($params)
    {
        return $this->client->request('POST', 'members', $params);
    }

    // 更新成员
    public function update($member_id, $params)
    {
        return $this->client->request('PUT', "members/{$member_id}", $params);
    }

    // 删除成员
    public function delete($member_id)
    {
        return $this->client->request('DELETE', "members/{$member_id}");
    }

    // 获取成员详情
    public function get($member_id)
    {
        return $this->client->request('GET', "members/{$member_id}");
    }

    // 获取成员列表
    public function list($params = [])
    {
        return $this->client->request('GET', 'members', $params);
    }
}
