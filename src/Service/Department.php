<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class Department
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 创建部门
    public function create($params)
    {
        return $this->client->request('POST', 'departments', $params);
    }

    // 更新部门
    public function update($department_id, $params)
    {
        return $this->client->request('PUT', "departments/{$department_id}", $params);
    }

    // 删除部门
    public function delete($department_id)
    {
        return $this->client->request('DELETE', "departments/{$department_id}");
    }

    // 获取部门详情
    public function get($department_id)
    {
        return $this->client->request('GET', "departments/{$department_id}");
    }

    // 获取部门列表
    public function list($params = [])
    {
        return $this->client->request('GET', 'departments', $params);
    }
}
