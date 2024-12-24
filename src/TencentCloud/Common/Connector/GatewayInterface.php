<?php
namespace tinymeng\wemeet\TencentCloud\Common\Connector;


use tinymeng\wemeet\TencentCloud\Common\AbstractClient;

interface GatewayInterface
{

    /**
     *
     */
    public function __construct();


    /**
     * @return AbstractClient
     */
    public function getClient();

    /**
     * setConfig
     * @param $config
     * @return $this
     * @author: Tinymeng <666@majiameng.com>
     * @time: 2022/3/17 12:08
     */
    public function setConfig($config);
}
