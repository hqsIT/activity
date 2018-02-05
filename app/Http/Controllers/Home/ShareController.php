<?php

namespace App\Http\Controllers\Home;

use App\Http\Repositories\ShareRepository;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;

class ShareController extends BaseController
{
    protected $Response;
    protected $ShareRepository;
    public function __construct()
    {
        parent::__construct();
        $this->Response = new ApiResponse();
        $this->ShareRepository = new ShareRepository();
    }

    /**
     * 分享
     * @param Request $request
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function share(Request $request)
    {
        $content = $request->post('content', '');
        $share_pic = $request->post('share_pic', '');

        if (empty($content) && empty($share_pic)) {
            return $this->Response->error('分享内容不能为空');
        }

        $this->ShareRepository->createShare($share_pic, $content);

        return $this->Response->success('发布成功');
    }

    /**
     * 总列表
     * @param Request $request
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function allList(Request $request)
    {
        $page = $request->get('page', 1);
        $pageRows = $request->get('page_rows', 1000);

        $map = [

        ];

        $list = $this->ShareRepository->getList($map, $page, $pageRows);
        return $this->Response->successWithData($list);
    }

    /**
     * 我分享的列表
     * @param Request $request
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function myList(Request $request)
    {
        $page = $request->get('page', 1);
        $pageRows = $request->get('page_rows', 1000);

        $map = [
            'uid' => session('login_info')
        ];

        $list = $this->ShareRepository->getList($map, $page, $pageRows);
        return $this->Response->successWithData($list);
    }

    /**
     * 分享详情
     * @param $share_id
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($share_id)
    {
        $data['info'] = $this->ShareRepository->info($share_id);
        $data['isFavoured'] = $this->ShareRepository->isFavoured($share_id);
        return $this->Response->successWithData($data);
    }

    /**
     * 点赞
     * @param $share_id
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function favour($share_id)
    {
        $this->ShareRepository->favour($share_id);
        return $this->Response->success('点赞成功');
    }

    /**
     * 取消赞
     * @param $share_id
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function unFavour($share_id)
    {
        $this->ShareRepository->unFavour($share_id);
        return $this->Response->success('取消赞成功');
    }

    public function commentSubmit(Request $request)
    {
        $content = $request->post('content', '');
        $share_id = $request->post('share_id', 0);
        $to_uid = $request->post('to_uid', 0);
        if (empty($content)) {
            return $this->Response->error('评论内容不能为空');
        }

        $this->ShareRepository->commentTo($share_id, $content, $to_uid);
        return $this->Response->success('评论成功');
    }
}
