<?php

/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/18
 * Time: 14:07
 */
namespace App\Http\Repositories;
use App\Models\Activity;

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
        $list = Activity::where($map)
            ->limit($page * $pageRows, ($page + 1) * $pageRows)
            ->orderBy('create_time', 'desc')
            ->get();
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
        $info = Activity::where('id', $id)->first();
        if (! empty($info)) {
            return $info->toArray();
        } else {
            return [];
        }
    }
}