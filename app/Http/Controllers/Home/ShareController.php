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

    public function allList(Request $request)
    {
        $page = $request->get('page', 1);
        $pageRows = $request->get('page_rows', 1000);

        $map = [

        ];

        $list = $this->ShareRepository->getList($map, $page, $pageRows);
        return $this->Response->successWithData($list);
    }

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
}
