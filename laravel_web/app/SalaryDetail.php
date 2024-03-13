<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    protected $fillable = ['staff_id', 'contract_id', 'pay_date', 'overtime', 'late_arrival_date', 'unpaid_leave_days', 'late_penalty_per_day', 'total_salary'] ;
}
