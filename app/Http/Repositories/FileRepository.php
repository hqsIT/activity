<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/22
 * Time: 22:41
 */

namespace App\Http\Repositories;

class FileRepository
{
    /**
     * @param \Illuminate\Http\UploadedFile|array|null $File
     * @author klinson <klinson@163.com>
     */
    public function upload($File)
    {
        $savePath = 'uploads' . DIRECTORY_SEPARATOR . date('Ym') . DIRECTORY_SEPARATOR . date('d') . DIRECTORY_SEPARATOR;
        $path = $File->store($savePath);
        return env('APP_URL') . '/' . $path;
    }
}