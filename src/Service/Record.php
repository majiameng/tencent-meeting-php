<?php
namespace tinymeng\wemeet\Service;

use tinymeng\wemeet\Client;

class Record
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // 查询会议录制文件列表
    public function list($meeting_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/records", $params);
    }

    // 查询录制文件详情
    public function get($meeting_id, $record_id)
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/records/{$record_id}");
    }

    // 删除录制文件
    public function delete($meeting_id, $record_id)
    {
        return $this->client->request('DELETE', "meetings/{$meeting_id}/records/{$record_id}");
    }

    // 下载录制文件
    public function download($meeting_id, $record_id, $params = [])
    {
        return $this->client->request('GET', "meetings/{$meeting_id}/records/{$record_id}/download", $params);
    }
} 