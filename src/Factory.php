<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: Tinymeng <666@majiameng.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------
namespace tinymeng\wemeet;

use tinymeng\wemeet\TencentCloud\Common\Connector\GatewayInterface;

/**
 * @method static \tinymeng\wemeet\TencentCloud\meeting meeting()
 */
abstract class Factory
{

    /**
     * Description:  init
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @param $gateway
     * @param null $config
     * @return mixed
     * @throws \Exception
     */
    protected static function init($gateway, $config = null)
    {
        $class = __NAMESPACE__ . '\\' .'TencentCloud'.'\\'.$gateway;
        if (class_exists($class)) {
            $app = new $class($config);
            if ($app instanceof GatewayInterface) {
                return $app;
            }
            throw new \Exception("第三方直播基类 [$gateway]");
        }
        throw new \Exception("第三方直播类 [$gateway] 不存在");
    }


    /**
     * Description:  __callStatic
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @param $gateway
     * @param $config
     * @return mixed
     */
    public static function __callStatic($gateway, $config=[])
    {
        return self::init($gateway, ...$config);
    }

}
