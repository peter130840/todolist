<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todolists extends Model
{
    protected $fillable = [
        'user_id','user_name','job', 'done','id',
    ];

}

