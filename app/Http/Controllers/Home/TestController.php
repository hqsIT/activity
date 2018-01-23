<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/23
 * Time: 16:33
 */

namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;

class TestController extends BaseController
{
    public function test(Request $request)
    {
//        dump($request->session()->getId());
//        $request->session()->put(['a' => 2]);
//        dump($request->session()->get('a'));
//        dump($request->session());
//
//        $request->session()->setId('2222222222222222222222222222222222');
//        dump($request->session()->getId());
//        dump($request->session()->get('a'));
//        $request->session()->put(['b' => 2]);
//        dump($request->session());

        $request->session()->setId('xguRxnjZc3RrJsMQUseddsAMJAAxBsjez31JYVEl');
        dump($request->session());

    }
}