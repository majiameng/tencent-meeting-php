<?php
namespace tinymeng\wemeet;

use tinymeng\wemeet\Helper\Str;

/**
 * @method static \tinymeng\wemeet\Service\Department department($config)
 * @method static \tinymeng\wemeet\Service\Layout layout($config)
 * @method static \tinymeng\wemeet\Service\Meeting meeting($config)
 * @method static \tinymeng\wemeet\Service\Member member($config)
 * @method static \tinymeng\wemeet\Service\Mra mra($config)
 * @method static \tinymeng\wemeet\Service\Record record($config)
 * @method static \tinymeng\wemeet\Service\Resource resource($config)
 * @method static \tinymeng\wemeet\Service\Room room($config)
 * @method static \tinymeng\wemeet\Service\User user($config)
 */
abstract class Factory
{

    /**
     * Description:  init
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @param $gateway
     * @param array $config
     * @return mixed
     * @throws \Exception
     */
    protected static function init($gateway, array $config)
    {
        $gateway = Str::uFirst($gateway);
        $class = __NAMESPACE__ . '\\' .'Service'.'\\'.$gateway;
        if (class_exists($class)) {
            $client = new Client($config);
            $app = new $class($client);
            return $app;
        }
        throw new \Exception("wemeet [$gateway] 不存在");
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
