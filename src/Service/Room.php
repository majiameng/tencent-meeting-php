<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class Room
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 创建会议室
    public function create($params)
    {
        return $this->client->request('POST', 'rooms', $params);
    }

    // 查询会议室
    public function get($room_id)
    {
        return $this->client->request('GET', "rooms/{$room_id}");
    }

    // 修改会议室信息
    public function update($room_id, $params)
    {
        return $this->client->request('PUT', "rooms/{$room_id}", $params);
    }

    // 查询会议室列表
    public function list($params = [])
    {
        return $this->client->request('GET', 'rooms', $params);
    }

    // 查询会议室配置项
    public function config($room_id)
    {
        return $this->client->request('GET', "rooms/{$room_id}/config");
    }

    // 修改会议室配置项
    public function updateConfig($room_id, $params)
    {
        return $this->client->request('PUT', "rooms/{$room_id}/config", $params);
    }

    // 呼叫会议室
    public function call($room_id, $params)
    {
        return $this->client->request('POST', "rooms/{$room_id}/call", $params);
    }

    // 取消呼叫会议室
    public function cancelCall($room_id, $params)
    {
        return $this->client->request('POST', "rooms/{$room_id}/cancel_call", $params);
    }

    // 查询会议室应答状态
    public function answerStatus($room_id)
    {
        return $this->client->request('GET', "rooms/{$room_id}/answer_status");
    }

    // 生成设备激活码
    public function generateActivationCode($room_id, $params)
    {
        return $this->client->request('POST', "rooms/{$room_id}/activation_code", $params);
    }

    // 查询账号类型资源使用统计
    public function resourceStats($room_id)
    {
        return $this->client->request('GET', "rooms/{$room_id}/resource_stats");
    }

    // 查询账户下Rooms资源
    public function accountRooms($account_id, $params = [])
    {
        return $this->client->request('GET', "accounts/{$account_id}/rooms", $params);
    }

    // 设置会议室背景
    public function setBackground($room_id, $params)
    {
        return $this->client->request('POST', "rooms/{$room_id}/background", $params);
    }

    // 查询会议室背景
    public function getBackground($room_id)
    {
        return $this->client->request('GET', "rooms/{$room_id}/background");
    }

    // 通过投屏码查询会议室信息
    public function getByScreenCode($screen_code)
    {
        return $this->client->request('GET', "rooms/screen_code/{$screen_code}");
    }
} 