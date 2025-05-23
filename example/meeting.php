<?php
use tinymeng\wemeet\Factory;

$config = [
    'secret_id' => 'xxx',
    'secret_key' => 'xxx',
    'app_id' => 'xxx',
    'sdk_id' => 'xxx',
    'region' => 'xxx',
];

$meeting = Factory::meeting($config);

// 创建会议
$result = $meeting->create([
    'subject' => '测试会议',
    // 其他参数
]);

// 查询会议
$info = $meeting->get('meeting_id');