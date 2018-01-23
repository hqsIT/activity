<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/18
 * Time: 0:48
 */
class BaseController extends Controller
{
    public function __construct()
    {
//        dump( session('login_info'));exit;
    }
}