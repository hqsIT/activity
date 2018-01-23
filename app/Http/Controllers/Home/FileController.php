<?php

namespace App\Http\Controllers\Home;


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
        $path = $request->file('file')->store('uploads/');

        return $this->Response->successWithData(['path' => $path]);
    }
}
