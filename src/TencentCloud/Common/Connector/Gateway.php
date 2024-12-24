<?php
namespace tinymeng\wemeet\TencentCloud\Common\Connector;

use tinymeng\wemeet\TencentCloud\Common\AbstractClient;

abstract class Gateway implements GatewayInterface
{
    /**
     * @var string
     */
    protected $baseClient = null;
    protected $type = null;

    /**
     * @var array
     */
    public $config;
    /**
     * @var AbstractClient
     */
    public $client;


    /**
     * @return AbstractClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * setConfig
     * @param $config
     * @return $this
     * @author: Tinymeng <666@majiameng.com>
     * @time: 2022/3/17 12:08
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }
}
