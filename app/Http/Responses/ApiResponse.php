<?php

/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/18
 * Time: 13:16
 */

namespace App\Http\Responses;

class ApiResponse
{
    /**
     * 带数据成功返回
     * @param array $info
     * @param string $message
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function successWithData($info = [], $message = '')
    {
        $data = [
            'code' => 0,
            'message' => $message ?? 'success',
            'data' => $info
        ];
        return response()->json($data);
    }

    /**
     * 操作成功提示
     * @param string $message
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($message = '')
    {
        $data = [
            'code' => 0,
            'message' => $message ?? 'success'
        ];
        return response()->json($data);
    }

    /**
     * 操作失败提示
     * @param string $message
     * @author klinson <klinson@163.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message = '')
    {
        $data = [
            'code' => 1,
            'message' => $message ?? 'error'
        ];
        return response()->json($data);
    }

}