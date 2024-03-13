<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timekeeping extends Model
{
    protected $table = "timekeepings";

    protected $fillable = [
        'start_time', 'end_time', 'staff_id'
    ];
}
