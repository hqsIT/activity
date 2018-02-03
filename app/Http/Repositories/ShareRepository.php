<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/31
 * Time: 0:01
 */

namespace App\Http\Repositories;


use App\Models\Share;

class ShareRepository
{
    /**
     * 创建分享
     * @param string $share_pic
     * @param string $content
     * @author klinson <klinson@163.com>
     */
    public function createShare($share_pic = '', $content = '')
    {
        $Share = new Share();
        $Share->share_pic = $share_pic;
        $Share->content = $content;
        $Share->uid = session('login_info');
        $Share->save();
    }

    public function getList($map, $page = 1, $pageRows = 10)
    {
        $list = Share::with('publisher')
            ->where($map)
            ->limit($page * $pageRows, ($page + 1) * $pageRows)
            ->orderBy('create_time', 'desc')
            ->get(['*', 'uid as publisher']);
//        dump($list[0]->publisher);
        return $list;
    }

}