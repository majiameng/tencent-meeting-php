<?php

/*
 * Copyright (c) 2017-2018 THL A29 Limited, a Tencent company. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace tinymeng\wemeet\TencentCloud\Meeting\v1;

use tinymeng\wemeet\TencentCloud\Common\AbstractClient;
use tinymeng\wemeet\TencentCloud\Common\Profile\ClientProfile;
use tinymeng\wemeet\TencentCloud\Common\Credential;
use tinymeng\wemeet\TencentCloud\Meeting\v1\Models as Models;

/**
 * @method Models\GetMeetingResponse GetMeeting(Models\GetMeetingRequest $req) 针对大型活动直播，通过对直播流设置延时来控制现场与观众播放画面的时间间隔，避免突发状况造成影响。
 *
 */
class MeetingClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $endpoint = "live.tencentcloudapi.com";

    /**
     * @var string
     */
    protected $service = "live";

    /**
     * @var string
     */
    protected $version = "2018-08-01";

    /**
     * @param Credential $credential
     * @param string $region
     * @param ClientProfile|null $profile
     * @throws TencentCloudSDKException
     */
    function __construct($credential, $region, $profile = null)
    {
        parent::__construct($this->endpoint, $this->version, $credential, $region, $profile);
    }

    public function returnResponse($action, $response)
    {
        $respClass = "TencentCloud" . "\\" . ucfirst("live") . "\\" . "V20180801\\Models" . "\\" . ucfirst($action) . "Response";
        $obj = new $respClass();
        $obj->deserialize($response);
        return $obj;
    }
}
