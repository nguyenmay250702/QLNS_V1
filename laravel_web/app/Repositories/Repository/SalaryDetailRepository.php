<?php
namespace App\Repositories\Repository;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\SalaryDetailRepositoryInterface;
use App\SalaryDetail;
use App\User;

class SalaryDetailRepository extends BaseRepository implements SalaryDetailRepositoryInterface
{
  public function __construct(SalaryDetail $salaryDetail)
  {
    parent::__construct($salaryDetail);
  }

  public function search($request)
  {
    $data = collect();
    if ($request != []) {
      $data = $this->model->select('users.username', 'staffs.name', 'salaries.basic_salary', 'overtime', 'late_arrival_date', 'unpaid_leave_days', 'total_salary')
        ->leftJoin('users', 'users.id', '=', 'salary_details.staff_id')
        ->join("staffs", "staffs.id", "=", "salary_details.staff_id")
        ->join("contracts", "contracts.id", "=", "salary_details.contract_id")
        ->join("salaries", "salaries.id", "=", "contracts.salary_id")
        ->Where(function ($query) use ($request) {
          if ($request['txt_pay_date'] != null) {
            $query->where('salary_details.pay_date', 'like', '%' . $request['txt_pay_date'] . '%');
          }
          if ($request['txt_username'] != null) {
            $query->where('users.username', 'like', '%' . $request['txt_username'] . '%');
          }
          if ($request['txt_staff_name'] != null) {
            $query->where('staffs.name', 'like', '%' . $request['txt_staff_name'] . '%');
          }
          if ($request['txt_basic_salary'] != null) {
            $query->where('salaries.basic_salary', $request['txt_basic_salary']);
          }
          if ($request['txt_overtime'] != null) {
            $query->where('salary_details.overtime', $request['txt_overtime']);
          }
          if ($request['txt_late_arrival_date'] != null) {
            $query->where('salary_details.late_arrival_date', $request['txt_late_arrival_date']);
          }
          if ($request['txt_unpaid_leave_days'] != null) {
            $query->where('salary_details.unpaid_leave_days', $request['txt_unpaid_leave_days']);
          }
          if ($request['txt_total_salary'] != null) {
            $query->where('salary_details.total_salary', $request['txt_total_salary']);
          }
        })->orderBy('staffs.created_at', 'desc')->get();
    }
    return $data;
  }
}
?>