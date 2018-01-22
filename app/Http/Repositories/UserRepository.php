<?php

/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/18
 * Time: 14:07
 */
namespace App\Http\Repositories;
use App\Models\Activity;
use App\Models\User;
use JiaweiXS\WeApp\WeApp;

class UserRepository
{
    public function __construct()
    {
    }

    /**
     * code换微信openid
     * @param $code
     * @author klinson <klinson@163.com>
     * @return string
     * @throws \Exception
     */
    public function getWechatOpenid($code) : string
    {
        $WechatApp = new WeApp(config('wechat.app_id'), config('wechat.app_secret'), '/tmp/');
        $result = $WechatApp->getSessionKey($code);//返回的是字符串

        $result = json_decode($result, true);
        if (isset($result['errcode']) && $result['errcode']) {

            throw new \Exception('请求微信接口失败: ' . $result['errmsg'] . '(' . $result['errcode'] . ')');
        }

        return $result['openid'];
    }

    /**
     * 微信登录更新信息
     * @param $openid
     * @param $nickname
     * @param $avatar
     * @param $sex
     * @author klinson <klinson@163.com>
     * @return mixed
     */
    public function wechatLogin($openid, $nickname, $avatar, $sex)
    {
        $info = User::where('openid', $openid)->first();
        if (empty($info)) {
            $User = new User();
            $User->openid = $openid;
            $User->nickname = $nickname;
            $User->avatar = $avatar;
            $User->sex = $sex;

            $User->save();
            $info = User::where('openid', $openid)->first();
        } else {
            $info->nickname = $nickname;
            $info->avatar = $avatar;
            $info->sex = $sex;
            $info->save();
        }
        return $info;
    }
}