<?php
use PHPUnit\Framework\TestCase;
use tinymeng\wemeet\TencentCloud\Common\Credential;
use tinymeng\wemeet\TencentCloud\Common\Profile\ClientProfile;
use tinymeng\wemeet\TencentCloud\Common\Profile\HttpProfile;
use tinymeng\wemeet\TencentCloud\Meeting\v1\MeetingClient;
use tinymeng\wemeet\TencentCloud\Meeting\v1\Models\GetMeetingRequest;

/**
 * IntelligentParseTest
 */
class MainTest extends TestCase
{

    public function testGetMeeting()
    {
        $config = [
            'secretId'=>'4m6jupGg5ayBzCWW1zxYGCDDnQpDTtz9',
            'secretKey'=>'y6tc7o5dZiWoMPFspgnbLtzwLT0FXxRlzBQ1wlQ5523CZ4ye',
            'appId'=>'27350153460',//应用ID
        ];
        $cred = new Credential($config['secretId'], $config['secretKey'],$config['appId']);

        $client = new \GuzzleHttp\Client();
        $meeting = new \tinymeng\wemeet\TencentCloud\Meeting\v1\Meeting($cred,$client);

        $model = 'records';
        $action = 'list';
        $params = [

        ];
        $res = $meeting->send($model,$action,$params);
        var_dump($res);
    }

    public function testMeeting()
    {
//        $data = \tinymeng\wemeet\Factory::meeting();
//        var_dump($data);

        $config = [
            'SecretId'=>'4m6jupGg5ayBzCWW1zxYGCDDnQpDTtz9',
            'SecretKey'=>'y6tc7o5dZiWoMPFspgnbLtzwLT0FXxRlzBQ1wlQ5523CZ4ye',
            'endpoint'=>'api.meeting.qq.com',//设置请求接入点域名
            'region'=>'',//地域参数
        ];
        $cred = new Credential($config['SecretId'], $config['SecretKey']);

        $httpProfile = new HttpProfile();
        $httpProfile->setEndpoint($config['endpoint']);

        $clientProfile = new ClientProfile(ClientProfile::$SIGN_HMAC_SHA256);
        $clientProfile->setHttpProfile($httpProfile);

        $client = new MeetingClient($cred, $config['region'], $clientProfile);

        $params = [
            'meeting_id'=>'111'
        ];
        $req = new GetMeetingRequest();
        $req->fromJsonString(json_encode($params));
        $resp = $client->GetMeeting($req);
        var_dump($resp);


    }

}