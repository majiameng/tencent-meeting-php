<?php
namespace tinymeng\wemeet\TencentCloud;

use tinymeng\wemeet\TencentCloud\Common\AbstractClient;
use tinymeng\wemeet\TencentCloud\Common\Connector\Gateway;

class meeting extends Gateway
{
    protected $baseClient = '\tinymeng\wemeet\TencentCloud\Meeting\V1\MeetingClient';
    protected $type = 'meeting';

    public function __construct()
    {
        return new $this->baseClient();
    }
    /**
     * @return AbstractClient
     */
    public function getClient(){}

    /**
     * setConfig
     * @param $config
     * @return $this
     * @author: Tinymeng <666@majiameng.com>
     * @time: 2022/3/17 12:08
     */
    public function setConfig($config){}

}