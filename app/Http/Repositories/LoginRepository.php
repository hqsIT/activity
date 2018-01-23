<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/22
 * Time: 22:41
 */

namespace App\Http\Repositories;


use Illuminate\Http\Request;

class LoginRepository
{
    /**
     * 微信登录专用session id
     * @author klinson <klinson@163.com>
     * @return string
     */
    public function get3rdSession() : string
    {
        $result = shell_exec('head -n 80 /dev/urandom | tr -dc A-Za-z0-9 | head -c 168');
        return $result;
    }

    /**
     * 设置用户登录信息
     * @param $uid
     * @author klinson <klinson@163.com>
     */
    public function setLoginSession($uid)
    {
        session(['login_info' => $uid]);
    }
}