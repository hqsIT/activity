<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/23
 * Time: 16:33
 */

namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

//        $request->session()->setId('xguRxnjZc3RrJsMQUseddsAMJAAxBsjez31JYVEl');
//        dump($request->session());
//        $content = '<a href="/tools/webdebugger.css">代码调试</a>
//<a href="/tools/webdebugger.">代码调试</a>
//<h4 class="HeadH4 YaHei fz16 col-blue02 fwnone fl">工具简介</h4>
//<a href="/htmlfilter.js">HTML/JS/CSS过滤</a>
//<a href="/htmlfilter.mp4">HTML/JS/CSS过滤</a>
//<a href="/htmlfilter.mp3">HTML/JS/CSS过滤</a>';
//        $fileSuffix = [
//            'gif', 'jpg', 'jpeg', 'bmp', 'png', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'wps', 'txt', 'rar', 'zip', 'gz', 'bz2', '7z', 'txt', 'avi', 'dat', 'mpg', 'wmv', 'asf', 'rm', 'rmvb', 'mov', 'flv', 'mp4', '3gp', 'dv', 'divx', 'qt', 'asx', 'mkv', 'vob', 'mp3', 'wma', 'wav', 'asp', 'aac', 'mp3pro', 'vqf', 'flac', 'ape', 'mid', 'ogg'
//        ];
//        $res = preg_match_all("/href=.+?['|\"]/i", $content, $match);
//        if ($res) {
//            foreach ($match[0] as $item) {
//                $tmp = explode('.', $item);
//                if (count($tmp) > 1 && ! empty($suffixTmp = $tmp[count($tmp) - 1])) {
//                    $suffix = strtolower(substr($suffixTmp, 0, strlen($suffixTmp) - 1));
//                    if (! in_array($suffix, $fileSuffix)) {
//                        $content = str_replace($item, '', $content);
//                    }
//                }
//
//            }
//        }
//
//        dump($content);
//        dump($match);

        echo DB::update('update `a_activity` set `enroll_number`=`enroll_number`+1 where `id` = ?;' , [1]);

    }
}