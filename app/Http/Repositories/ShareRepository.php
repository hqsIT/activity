<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/31
 * Time: 0:01
 */

namespace App\Http\Repositories;


use App\Models\Share;
use App\Models\ShareComment;
use App\Models\ShareFavour;
use App\Models\User;

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

    public function info($share_id)
    {
        $map = [
            'id' => $share_id
        ];
        $info = Share::with(['publisher', 'favourers'])
            ->where($map)
            ->orderBy('create_time', 'desc')
            ->first(['*', 'uid as publisher']);
        if (! empty($info)) {
            $info = $info->toArray();
            foreach ($info['favourers'] as &$item) {
                $item['user_info'] = User::find($item['uid']);
            }
            return $info;
        } else {
            return [];
        }
    }

    /**是否已经喜欢
     * @param $share_id
     * @author klinson <klinson@163.com>
     * @return int
     */
    public function isFavoured($share_id)
    {
        $map = [
            'share_id' => $share_id,
            'uid' => session('login_info')
        ];
        $info = ShareFavour::where($map)->first();
        return empty($info) ? 0 : 1;
    }

    /**
     * 点赞
     * @param $share_id
     * @author klinson <klinson@163.com>
     */
    public function favour($share_id)
    {
        $data = [
            'share_id' => $share_id,
            'uid' => session('login_info')
        ];
        ShareFavour::firstOrCreate($data);
    }

    /**
     * 取消赞
     * @param $share_id
     * @author klinson <klinson@163.com>
     */
    public function unFavour($share_id)
    {
        $data = [
            'share_id' => $share_id,
            'uid' => session('login_info')
        ];
        $favour = ShareFavour::where($data)->first();
        $favour->delete();
    }

    /**
     * 评论
     * @param $share_id
     * @param $content
     * @param int $to_uid
     * @author klinson <klinson@163.com>
     */
    public function commentTo($share_id, $content, $to_uid = 0)
    {
        $data = [
            'share_id' => $share_id,
            'uid' => session('login_info'),
            'content' => $content,
            'to_uid' => $to_uid
        ];
        ShareComment::create($data);
    }
}