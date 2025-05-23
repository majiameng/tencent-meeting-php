<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class User
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 创建用户
    public function create($params)
    {
        return $this->client->request('POST', 'users', $params);
    }

    // 发送用户激活邀请
    public function sendActivationInvite($user_id, $params = [])
    {
        return $this->client->request('POST', "users/{$user_id}/activation_invite", $params);
    }

    // 获取账号激活链接
    public function getActivationLink($user_id)
    {
        return $this->client->request('GET', "users/{$user_id}/activation_link");
    }

    // 更新用户
    public function update($user_id, $params)
    {
        return $this->client->request('PUT', "users/{$user_id}", $params);
    }

    // 获取用户基本信息
    public function getBasicInfo($user_id)
    {
        return $this->client->request('GET', "users/{$user_id}/basic_info");
    }

    // 获取用户详情
    public function getDetail($user_id)
    {
        return $this->client->request('GET', "users/{$user_id}/detail");
    }

    // 获取用户列表
    public function list($params = [])
    {
        return $this->client->request('GET', 'users', $params);
    }

    // 查询 ms_open_id
    public function queryMsOpenId($params)
    {
        return $this->client->request('POST', 'users/ms_open_id', $params);
    }

    // 启用用户
    public function enable($user_id)
    {
        return $this->client->request('POST', "users/{$user_id}/enable");
    }

    // 禁用用户
    public function disable($user_id)
    {
        return $this->client->request('POST', "users/{$user_id}/disable");
    }

    // 删除用户
    public function delete($user_id)
    {
        return $this->client->request('DELETE', "users/{$user_id}");
    }

    // 查询个人会议号配置信息
    public function getPersonalMeetingConfig($user_id)
    {
        return $this->client->request('GET', "users/{$user_id}/personal_meeting_config");
    }

    // 修改个人会议号配置信息
    public function updatePersonalMeetingConfig($user_id, $params)
    {
        return $this->client->request('PUT', "users/{$user_id}/personal_meeting_config", $params);
    }

    // 取消用户授权
    public function cancelAuth($user_id)
    {
        return $this->client->request('POST', "users/{$user_id}/cancel_auth");
    }

    // 自建应用与三方应用ID转换接口
    public function convertAppId($params)
    {
        return $this->client->request('POST', 'users/convert_app_id', $params);
    }

    // 用户资产转移
    public function transferAssets($user_id, $params)
    {
        return $this->client->request('POST', "users/{$user_id}/transfer_assets", $params);
    }

    // 设置AI账号能力
    public function setAiAbility($user_id, $params)
    {
        return $this->client->request('POST', "users/{$user_id}/set_ai_ability", $params);
    }

    // 移除AI账号能力
    public function removeAiAbility($user_id, $params)
    {
        return $this->client->request('POST', "users/{$user_id}/remove_ai_ability", $params);
    }

    // 获取账号资源统计
    public function getResourceStats($user_id)
    {
        return $this->client->request('GET', "users/{$user_id}/resource_stats");
    }

    // 发送用户验证短信
    public function sendVerificationSms($user_id, $params)
    {
        return $this->client->request('POST', "users/{$user_id}/send_verification_sms", $params);
    }

    // 获取用户验证链接
    public function getVerificationLink($user_id)
    {
        return $this->client->request('GET', "users/{$user_id}/verification_link");
    }
} 