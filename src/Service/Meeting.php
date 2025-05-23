<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class Meeting
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 创建会议
    public function create($params)
    {
        return $this->client->request('POST', 'meetings', $params);
    }

    // 查询会议
    public function get($meeting_id)
    {
        return $this->client->request('GET', "meetings/{$meeting_id}");
    }

    // 通过会议Code查询会议
    public function getByCode($code)
    {
        return $this->client->request('GET', "meetings/code/{$code}");
    }

    // 取消会议
    public function cancel($meeting_id, $params = [])
    {
        return $this->client->request('POST', "meetings/{$meeting_id}/cancel", $params);
    }

    // 修改会议
    public function update($meeting_id, $params)
    {
        return $this->client->request('PUT', "meetings/{$meeting_id}", $params);
    }

    // 获取参会成员列表
    public function members($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/members", $params);
    }

    // 查询实时会中成员列表
    public function realTimeMembers($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/real_time_members", $params);
    }

    // 查询用户的会议列表
    public function userMeetings($user_id, $params = [])
    {
        return $this->client->request('GET', "users/{$user_id}/meetings", $params);
    }

    // 查询用户已结束会议列表
    public function userEndedMeetings($user_id, $params = [])
    {
        return $this->client->request('GET', "users/{$user_id}/ended_meetings", $params);
    }

    // 查询会议报名配置
    public function registrationConfig($meeting_id)
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/registration_config");
    }

    // 获取实时等候室成员列表
    public function waitingRoomMembers($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/waiting_room_members", $params);
    }

    // 查询等候室成员记录
    public function waitingRoomRecords($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/waiting_room_records", $params);
    }

    // 设置等候室欢迎语
    public function setWaitingRoomWelcome($meeting_id, $params)
    {
        return $this->client->request('POST', "meetings/{$meeting_id}/waiting_room_welcome", $params);
    }

    // 获取会议受邀成员列表
    public function invitedMembers($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/invited_members", $params);
    }

    // 设置会议邀请成员
    public function setInvitedMembers($meeting_id, $params)
    {
        return $this->client->request('POST', "meetings/{$meeting_id}/invited_members", $params);
    }

    // 查询会议成员报名ID
    public function registrationId($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/registration_id", $params);
    }

    // 修改会议报名配置
    public function updateRegistrationConfig($meeting_id, $params)
    {
        return $this->client->request('PUT', "meetings/{$meeting_id}/registration_config", $params);
    }

    // 审批会议报名信息
    public function approveRegistration($meeting_id, $params)
    {
        return $this->client->request('POST', "meetings/{$meeting_id}/approve_registration", $params);
    }

    // 查询会议报名信息
    public function registrationInfo($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/registration_info", $params);
    }

    // 导入会议报名信息
    public function importRegistration($meeting_id, $params)
    {
        return $this->client->request('POST', "meetings/{$meeting_id}/import_registration", $params);
    }

    // 删除会议报名信息
    public function deleteRegistration($meeting_id, $params)
    {
        return $this->client->request('DELETE', "meetings/{$meeting_id}/registration", $params);
    }

    // 创建用户专属参会链接
    public function createUserJoinLink($meeting_id, $params)
    {
        return $this->client->request('POST', "meetings/{$meeting_id}/user_join_link", $params);
    }

    // 获取用户专属参会链接
    public function getUserJoinLink($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/user_join_link", $params);
    }

    // 查询个人会议号会议列表
    public function personalMeetingList($user_id, $params = [])
    {
        return $this->client->request('GET', "users/{$user_id}/personal_meetings", $params);
    }

    // 查询用户设备是否入会
    public function deviceJoinStatus($meeting_id, $params)
    {
        return $this->client->request('POST', "meetings/{$meeting_id}/device_join_status", $params);
    }

    // 查询会议健康度
    public function meetingHealth($meeting_id)
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/health");
    }

    // 获取等候室欢迎语
    public function getWaitingRoomWelcome($meeting_id)
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/waiting_room_welcome");
    }
}
