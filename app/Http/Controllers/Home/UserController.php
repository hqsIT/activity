<?php

namespace App\Http\Controllers\Home;

use App\Http\Repositories\LoginRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use JiaweiXS\WeApp\WeApp;

class UserController extends BaseController
{
    protected $Response;
    protected $UserRepository;
    public function __construct()
    {
        parent::__construct();
        $this->Response = new ApiResponse();
        $this->UserRepository = new UserRepository();
    }

    /**
     * 微信登录
     * @param Request $Request
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function wxLogin(Request $Request)
    {
        $code = $Request->post('code', '');
        $nickname = $Request->input('userInfo.nickName', '');
        $avatar = $Request->input('userInfo.avatarUrl', '');
        $sex = $Request->input('userInfo.gender', 1);

        $openid = $this->UserRepository->getWechatOpenid($code);
        $info = $this->UserRepository->wechatLogin($openid, $nickname, $avatar, $sex);

        //做登录操作
        $Login = new LoginRepository();
//        $session_id = $Login->get3rdSession();
//        $Request->session()->setId($session_id);
        $session_id = $Request->session()->getId();

        $Login->setLoginSession($info['id']);

        $response = [
            'session_id' => $session_id,
            'openid' => $openid
        ];

        return $this->Response->successWithData($response);
    }

}
