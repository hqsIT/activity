<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/22
 * Time: 22:41
 */

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Storage;

class FileRepository
{
    /**
     * @param \Illuminate\Http\UploadedFile|array|null $File $File
     * @return bool|string
     */
    public function upload($File)
    {
        if ($File->isValid()) {
            // 获取文件相关信息
            $originalName = $File->getClientOriginalName(); // 文件原名
            $ext = $File->getClientOriginalExtension();     // 扩展名
            $realPath = $File->getRealPath();   //临时文件的绝对路径
            $type = $File->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = date('Ym') . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $res = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
            if ($res) {
                $path = Storage::disk('uploads')->url($filename);
                $path = strtr($path, '\\', '/'); //Windows处理
                return $path;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}