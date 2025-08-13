<?php
use tinymeng\wemeet\Factory;
require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'secret_id' => 'xxx',// SecretID
    'secret_key' => 'xxx',// SecretKey
    'app_id' => 'xxx',// 企业ID
    'sdk_id' => 'xxx',// 应用ID
];

$meeting = Factory::meeting($config);


$data = '{
  "userid": "string required",
  "instanceid": "integer required",
  "subject": "string required",
  "type": "integer required",
  "hosts": [
    {
      "userid": "string required",
      "is_anonymous": "boolean",
      "nick_name": "string"
    }
  ],
  "guests": [
    {
      "area": "string required",
      "guest_name": "string",
      "phone_number": "string required"
    }
  ],
  "invitees": [
    {
      "userid": "string required",
      "is_anonymous": "boolean",
      "nick_name": "string"
    }
  ],
  "start_time": "string required",
  "end_time": "string required",
  "password": "string",
  "settings": {
    "mute_enable_type_join": "integer",
    "mute_enable_join": "boolean",
    "allow_unmute_self": "boolean",
    "play_ivr_on_leave": "boolean",
    "play_ivr_on_join": "boolean",
    "allow_in_before_host": "boolean",
    "auto_in_waiting_room": "boolean",
    "allow_screen_shared_watermark": "boolean",
    "water_mark_type": "integer",
    "only_enterprise_user_allowed": "boolean",
    "auto_record_type": "string",
    "participant_join_auto_record": "boolean",
    "enable_host_pause_auto_record": "boolean",
    "allow_multi_device": "boolean"
  },
  "meeting_type": "integer",
  "recurring_rule": {
    "recurring_type": "integer",
    "until_type": "integer",
    "until_date": "integer",
    "until_count": "integer",
    "customized_recurring_type": "integer",
    "customized_recurring_step": "integer",
    "customized_recurring_days": "integer"
  },
  "enable_live": "boolean",
  "live_config": {
    "live_subject": "string",
    "live_password": "string",
    "live_summary": "string",
    "enable_live_password": "boolean",
    "enable_live_im": "boolean",
    "enable_live_replay": "boolean",
    "live_watermark": {
      "watermark_opt": "integer"
    }
  },
  "enable_doc_upload_permission": "boolean",
  "media_set_type": "integer",
  "enable_interpreter": "boolean",
  "enable_enroll": "boolean",
  "enable_host_key": "boolean",
  "host_key": "string",
  "sync_to_wework": "boolean",
  "time_zone": "string",
  "location": "string",
  "allow_enterprise_intranet_only": "boolean"
}';
$data = json_decode($data, true);
// 创建会议
$result = $meeting->create($data);
var_dump($result);

// 查询会议
$result = $meeting->get('meeting_id');
var_dump($result);
