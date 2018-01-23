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

class ActivityRepository
{
    public function __construct()
    {
    }

    /**
     * 获取列表
     * @param $map
     * @param int $page
     * @param int $pageRows
     * @author klinson <klinson@163.com>
     * @return mixed
     */
    public function getList($map, $page = 1, $pageRows = 10)
    {
        $list = Activity::with('publisher')
            ->where($map)
            ->limit($page * $pageRows, ($page + 1) * $pageRows)
            ->orderBy('create_time', 'desc')
            ->get(['*', 'uid as publisher']);
//        dump($list[0]->publisher);
        return $list;
    }

    /**
     * 获取单个详情
     * @param $id
     * @author klinson <klinson@163.com>
     * @return array
     */
    public function getInfo($id) : array
    {
        $info = Activity::with('joiners')->where('id', $id)->first(['*', 'id as joiners']);
        if (! empty($info)) {
            $info = $info->toArray();
            foreach ($info['joiners'] as &$item) {
                $item['user_info'] = User::find($item['uid']);
            }
            return $info;
        } else {
            return [];
        }
    }

    /**
     * 保存活动
     * @param $data
     * @author klinson <klinson@163.com>
     */
    public function store($data)
    {
        $Activity = new Activity();
        $Activity->title = $data['title'];
        $Activity->date = $data['date'];
        $Activity->start_time = $data['start_time'];
        $Activity->end_time = $data['end_time'];
        $Activity->address = $data['address'];
        $Activity->number = $data['number'];
        $Activity->content = $data['content'];
        $Activity->cover = $data['cover'];
        $Activity->type = $data['type'];
        $Activity->enroll_number = 0;
        $Activity->uid = session('login_info');
        $Activity->save();

    }
}