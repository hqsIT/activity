<?php

/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/18
 * Time: 14:07
 */
namespace App\Http\Repositories;
use App\Models\Activity;
use App\Models\ActivityEnroll;
use App\Models\User;
use PHPUnit\Framework\Exception;

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
     * 是否参与此活动
     * @param $activity_id
     * @author klinson <klinson@163.com>
     * @return bool
     */
    public function isJoined($activity_id, $uid)
    {
        $enrollInfo = ActivityEnroll::where('activity_id', $activity_id)->where('uid' , $uid)->first();

        if (! empty($enrollInfo)) {
            return true;
        } else {
            return false;
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

    /**
     * 活动报名
     * @param $activity_id
     * @author klinson <klinson@163.com>
     */
    public function enroll($activity_id)
    {
        $info = Activity::where('id', $activity_id)->first();
        if (empty($info)) {
            throw new Exception('活动不存在');
        }
        if (time() > strtotime($info->date . ' ' . $info->end_time)) {
            throw new Exception('活动已结束，不可报名');
        } else if (time() > strtotime($info->date . ' ' . $info->start_time)) {
            throw new Exception('活动已开始，不可报名');
        } else {
            $uid = session('login_info');
            if ($uid == $info->uid) {
                throw new Exception('自己发布的活动，不可报名');
            }
            $enrollInfo = ActivityEnroll::where('activity_id', $activity_id)->where('uid' , $uid)->first();

            if (! empty($enrollInfo)) {
                throw new Exception('您已经报名，请勿重新报名');
            }
            $Enroll = new ActivityEnroll(['activity_id' => $activity_id, 'uid' => $uid]);
//            $Enroll->activity_id = $activity_id;
//            $Enroll->uid = $uid;
//            dump($Enroll->getAttributes());
            $Enroll->save();
        }
    }
}