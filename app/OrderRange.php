<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRange extends Model
{
    protected $table = 'order_range';
   
    protected $fillable = [
        'id','user_id','initial_order_range','last_order_range','created_at','updated_at',
    ];
}
