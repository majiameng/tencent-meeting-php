<?php
/**
 * 腾讯
 * @author: JiaMeng <666@majiameng.com>
 */
namespace Tinymeng\Tencent\Meeting;

use Tinymeng\Tencent\Meeting\Connector\GatewayInterface;
/**
 * @method static \Tinymeng\Tencent\Meeting\Gateways\Meeting Meeting(array $config) 腾讯会议
 */
abstract class Meeting
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
    protected static function init($gateway, $config)
    {
        if(empty($config)){
            throw new \Exception("Tencent [$gateway] config配置不能为空");
        }
        $baseConfig = [
            'app_id'    => '',
            'app_secret'=> '',
            'callback'  => '',
            'scope'     => '',
            'type'      => '',
        ];
        $gateway = Str::uFirst($gateway);
        $class = __NAMESPACE__ . '\\Gateways\\' . $gateway;
        if (class_exists($class)) {
            $app = new $class(array_replace_recursive($baseConfig,$config));
            if ($app instanceof GatewayInterface) {
                return $app;
            }
            throw new \Exception("Tencent [$gateway] 必须继承抽象类 [GatewayInterface]");
        }
        throw new \Exception("Tencent [$gateway] 不存在");
    }

    /**
     * Description:  __callStatic
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @param $gateway
     * @param $config
     * @return mixed
     */
    public static function __callStatic($gateway, $config)
    {
        return self::init($gateway, ...$config);
    }

}
