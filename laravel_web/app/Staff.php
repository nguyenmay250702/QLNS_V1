<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = "staffs";
    protected $fillable = ['name','phone_number', 'citizen_identity_card','birthday', 'address', 'gender', 'department_id', 'status'] ;
}
