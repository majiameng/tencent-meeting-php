<?php

use tinymeng\Tencent\Meeting\Meeting;

require_once "../vendor/autoload.php";
use TencentCloud\Cvm\V20170312\CvmClient;
use TencentCloud\Cvm\V20170312\Models\DescribeInstancesRequest;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Common\Credential;

try {
    $cred = new Credential("secretId", "secretKey");
    $client = new CvmClient($cred, "ap-guangzhou");
    $req = new DescribeInstancesRequest();
    $resp = $client->DescribeInstances($req);
    print_r($resp->toJsonString());
}
catch(TencentCloudSDKException $e) {
    echo $e;
}