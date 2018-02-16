<?php

namespace App\Http\Controllers\Home;


use App\Http\Repositories\FileRepository;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;

class FileController extends BaseController
{
    protected $Response;
    public function __construct()
    {
        parent::__construct();
        $this->Response = new ApiResponse();
    }

    public function upload(Request $request)
    {
        $FileRepository = new FileRepository();
        $file = $request->file('file');
        $path = $FileRepository->upload($file);

        // 文件是否上传成功
        if ($path) {
            return $this->Response->successWithData(['path' => $path]);
        } else {
            return $this->Response->error('上传失败');

        }

    }
}
