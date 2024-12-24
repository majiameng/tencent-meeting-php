<?php

namespace tinymeng\wemeet\TencentCloud\RestApi;

class MeetingRestApi
{

    private $apiList = [
        'host' => 'https://api.meeting.qq.com',
        'meeting' => [// 会议
            'create' => ['method' => 'POST', 'uri' => '/v1/meetings'],// 创建会议
            'list' => ['method' => 'GET', 'uri' => '/v1/meetings'],// 会议列表
        ],
        'records' => [// 会议录制
            'list' => ['method' => 'GET', 'uri' => '/v1/records'],// 查询会议录制列表
        ],
    ];

    public function getHost()
    {
        return $this->apiList['host'];
    }

    public function getApi($model,$action)
    {
        return $this->apiList[$model][$action]??null;
    }
}
