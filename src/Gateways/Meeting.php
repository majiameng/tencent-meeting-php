<?php
/**
 * https://cloud.tencent.com/document/product/1095/42417
 */
namespace Tinymeng\Tencent\Meeting\Gateways;

use Tinymeng\Tencent\Meeting\Connector\Gateway;
use Tinymeng\Tencent\Meeting\Helper\ConstCode;

/**
 * Class Meeting
 * @package Tinymeng\Tencent\Meeting\Gateways
 * @Author: TinyMeng <666@majiameng.com>
 * @Created: 2018/11/9
 */
class Meeting extends Gateway
{
    const API_BASE            = 'https://api.weixin.qq.com/sns/';
    protected $AuthorizeURL   = 'https://open.weixin.qq.com/connect/qrconnect';
    protected $AccessTokenURL = 'https://api.weixin.qq.com/sns/oauth2/access_token';
    protected $jsCode2Session = 'https://api.weixin.qq.com/sns/jscode2session';

    /**
     * Description:  得到跳转地址
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @return string
     */
    public function getRedirectUrl()
    {
        //存储state
        $this->saveState();

        //获取代理链接
        if(isset($this->config['proxy_url'])){
            return $this->getProxyURL();
        }

        //登录参数
        $this->switchAccessTokenURL();
        $params = [
            'appid'         => $this->config['app_id'],
            'redirect_uri'  => $this->config['callback'],
            'response_type' => $this->config['response_type'],
            'scope'         => $this->config['scope'],
            'state'         => $this->config['state'],
        ];
        return $this->AuthorizeURL . '?' . http_build_query($params) . '#wechat_redirect';
    }

    /**
     * Description:  获取中转代理地址
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @return string
     */
    public function getProxyURL()
    {
        $params = [
            'appid'         => $this->config['app_id'],
            'response_type' => $this->config['response_type'],
            'scope'         => $this->config['scope'],
            'state'         => $this->config['state'],
            'redirect_uri'    => $this->config['callback'],
        ];
        return $this->config['proxy_url'] . '?' . http_build_query($params);
    }

    /**
     * Description:  获取当前授权用户的openid标识
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @return mixed
     * @throws \Exception
     */
    public function openid()
    {
        $this->getToken();

        if (isset($this->token['openid'])) {
            return $this->token['openid'];
        } else {
            throw new \Exception('没有获取到微信用户ID！');
        }
    }

    /**
     * Description:  获取格式化后的用户信息
     * @return array
     * @throws \Exception
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     */
    public function userInfo()
    {
        $result = $this->getUserInfo();

        $userInfo = [
            'open_id' => $this->openid(),
            'union_id'=> $this->token['unionid'] ?? '',
            'access_token'=> $this->token['access_token'] ?? '',
            'channel' => ConstCode::TYPE_WECHAT,
            'nickname'=> $result['nickname']??'',
            'gender'  => $result['sex'] ?? ConstCode::GENDER,
            'avatar'  => $result['headimgurl']??'',
            'session_key'  => $result['session_key']??'',
        ];
        $userInfo['type'] = ConstCode::getTypeConst($userInfo['channel'],$this->type);
        return $userInfo;
    }

    /**
     * Description:  获取原始接口返回的用户信息
     * @return array
     * @throws \Exception
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     */
    public function getUserInfo()
    {
        if($this->type == 'app'){//App登录
            if(!isset($_REQUEST['access_token']) ){
                throw new \Exception("Meeting APP登录 需要传输access_token参数! ");
            }
            $this->token['access_token'] = $_REQUEST['access_token'];
        }elseif ($this->type == 'applets'){
            //小程序
            return $this->applets();
        }else {
            /** 获取token信息 */
            $this->getToken();
        }

        /** 获取用户信息 */
        $params = [
            'access_token'=>$this->token['access_token'],
            'openid'=>$this->openid(),
            'lang'=>'zh_CN',
        ];
        $data = $this->get(self::API_BASE . 'userinfo', $params);
        return json_decode($data, true);
    }

    /**
     * @return array|mixed|null
     * @throws \Exception
     */
    public function applets(){
        /** 获取参数 */
        $params = $this->accessTokenParams();
        $params['js_code'] = $params['code'];

        /** 获取access_token */
        $token =  $this->get($this->jsCode2Session, $params);
        /** 解析token值(子类实现此方法) */
        $this->token = $this->parseToken($token);
        return $this->token;
    }

    /**
     * Description:  根据第三方授权页面样式切换跳转地址
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     */
    private function switchAccessTokenURL()
    {
        /**
         *  第三方使用网站应用授权登录前请注意已获取相应网页授权作用域
         *  Pc网站应用 https://open.weixin.qq.com/connect/qrconnect?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
         *  微信内网站应用: https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URL&response_type=code&scope=SCOPE&state=1#wechat_redirect
         */
        if ($this->display == 'mobile') {
            $this->AuthorizeURL = 'https://open.weixin.qq.com/connect/oauth2/authorize';
        } else {
            //微信扫码网页登录，只支持此scope
            $this->config['scope'] = 'snsapi_login';
        }
    }

    /**
     * Description:  重写 获取的AccessToken请求参数
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @return array
     */
    protected function accessTokenParams()
    {
        $params = [
            'appid'      => $this->config['app_id'],
            'secret'     => $this->config['app_secret'],
            'grant_type' => $this->config['grant_type'],
            'code'       => isset($_REQUEST['code']) ? $_REQUEST['code'] : '',
        ];
        return $params;
    }

    /**
     * Description:  解析access_token方法请求后的返回值
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @param string $token 获取access_token的方法的返回值
     * @return mixed
     * @throws \Exception
     */
    protected function parseToken($token)
    {
        $data = json_decode($token, true);
        if (isset($data['access_token'])) {
            return $data;
        }elseif (isset($data['session_key'])){
            //小程序登录
            return $data;
        } else {
            throw new \Exception("获取微信 ACCESS_TOKEN 出错：{$token}");
        }
    }

}