<?php

namespace App\Http\Controllers\Home;

use App\Http\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Http\Responses\ApiResponse;
use PHPUnit\Framework\Exception;

class ActivityController extends BaseController
{
    protected $Response;
    protected $ActivityRepository;
    public function __construct()
    {
        parent::__construct();
        $this->Response = new ApiResponse;
        $this->ActivityRepository = new ActivityRepository();
    }


    public function lists(Request $request)
    {
        $page = $request->get('page', 1);
        $pageRows = $request->get('page_rows', 10);
        $search = trim($request->get('search', ''));

        $map = [
            'status' => 1
        ];
        $search && $map['title'] = '%'.$search.'%';

        $list = $this->ActivityRepository->getList($map, $page, $pageRows);
        return $this->Response->successWithData($list);
    }

    /**
     * 获取活动详情
     * @param $id
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id)
    {
        $info = $this->ActivityRepository->getInfo($id);
        if (! empty($info)) {
            return $this->Response->successWithData($info);
        } else {
            return $this->Response->error('不存在该活动');
        }
    }

    /**
     * 发布活动
     * @param Request $Request
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $Request)
    {
        $fields = ['title', 'start_time', 'end_time', 'number', 'address', 'content', 'date', 'cover', 'type'];
        $data = $Request->only($fields);
        $this->ActivityRepository->store($data);
        return $this->Response->success('发布成功');
    }

    /**
     * 活动报名
     * @param $activity_id
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function enroll($activity_id)
    {
        try {
            $this->ActivityRepository->enroll($activity_id);
            return $this->Response->success('报名成功');
        } catch (Exception $e) {
            return $this->Response->error($e->getMessage());
        }
    }
}
