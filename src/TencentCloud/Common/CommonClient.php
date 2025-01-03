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

namespace tinymeng\wemeet\TencentCloud\Common;

use tinymeng\wemeet\TencentCloud\Common\AbstractClient;
use tinymeng\wemeet\TencentCloud\Common\Profile\ClientProfile;
use tinymeng\wemeet\TencentCloud\Common\Credential;

class CommonClient extends AbstractClient
{
    protected $endpoint;
    protected $service;
    protected $version;

    /**
     * @param string $service
     * @param string $version
     * @param Credential $credential
     * @param string $region
     * @param ClientProfile|null $profile
     * @throws TencentCloudSDKException
     */
    function __construct($service, $version, $credential, $region, $profile=null)
    {
        $this->service = $service;
        $this->version = $version;
		$this->endpoint = $service.".tencentcloudapi.com";
        parent::__construct($this->endpoint, $version, $credential, $region, $profile);
    }
}
