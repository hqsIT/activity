<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/23
 * Time: 12:46
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $timestamps = true;
    public $dateFormat = 'Y/m/d h:i:s';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    public function fromDateTime($value) {
        return strtolower($value);
    }
    public function getDateFormat() {
        return 'U';
    }
    public function freshTimestamp() {
        return time();
    }
}