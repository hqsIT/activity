<?php

namespace App\Models;

class User extends BaseModel
{
    protected $table = 'user';
    public $timestamps = false;
    const CREATED_AT = false;
    const UPDATED_AT = false;

}
