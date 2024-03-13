<?php

namespace App\Repositories\Repository;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class StaffRepository extends BaseRepository implements StaffRepositoryInterface
{
    public function __construct(Staff $staff)
    {
        parent::__construct($staff);
    }

    public function getAllStatus($status)
    {
        $data = $this->model->where("status", '=', $status)->get();
        return $data;
    }

    public function getStaffByCitizenIdentityCard($citizen_identity_card)
    {
        $results = $this->model->where('citizen_identity_card', '=', (int)$citizen_identity_card)->first();
        // Log::info("cccd".$citizen_identity_card);
        if ($results === null) {
            return -1; // Không tìm thấy kết quả
        } else {
            return $results->id; // Trả về kết quả tìm thấy
        }
    }

    public function getStaffsWithoutAccount()
    {
        $staffs = $this->model->whereNotIn('id', function ($query) {
            $query->select('staff_id')->from('users');
        })->get();

        return $staffs;
    }

    public function search1($request)
    {
        $data = collect();
        if ($request != []) {
            $data = $this->model->selectRaw("staffs.id, staffs.name, staffs.phone_number, staffs.birthday, staffs.address, department_id, staffs.citizen_identity_card, staffs.created_at, staffs.updated_at,
          IF(staffs.status = 0, 'nghỉ việc', 'hoạt động') AS status,
          IF(staffs.gender = 0, 'nam', 'nữ') AS gender,
          departments.name as department_name,
          IF(users.staff_id = staffs.id, users.username, '') AS username")
                ->leftJoin('users', 'users.staff_id', '=', 'staffs.id')
                ->join('departments', 'departments.id', '=', 'staffs.department_id')
                ->where(function ($query) use ($request) {
                    if ($request['txt_name'] !== null) {
                        $query->where('staffs.name', 'like', '%' . $request['txt_name'] . '%');
                    }
                    if ($request['txt_address'] !== null) {
                        $query->where('staffs.address', 'like', '%' . $request['txt_address'] . '%');
                    }
                    if ($request['txt_department'] !== '-1') {
                        $query->where('staffs.department_id', $request['txt_department']);
                    }
                    if ($request['txt_username'] !== null) {
                        $query->where('users.username', 'like', '%' . $request['txt_username'] . '%');
                    }
                    if ($request['txt_citizen_identity_card'] !== null) {
                        $query->where('staffs.citizen_identity_card', 'like', '%' . $request['txt_citizen_identity_card'] . '%');
                    }
                    if ($request['txt_birthday'] !== null) {
                        $query->where('staffs.birthday', $request['txt_birthday']);
                    }
                    if ($request['txt_gender'] !== '-1') {
                        $query->where('staffs.gender', $request['txt_gender']);
                    }
                    if ($request['txt_status'] !== '-1') {
                        $query->where('staffs.status', '=', $request['txt_status']);
                    }
                })->orderBy('staffs.updated_at', 'desc')->get();
        }
        return $data;
    }

    public function calculateStaffSalary()
    {
        return $this->model->selectRaw("staffs.id as staff_id, contracts.id as contract_id, salaries.basic_salary,
    COUNT(CASE WHEN TIME_FORMAT(timekeepings.start_time, '%H:%i:%s')>'08:30:00' THEN 1 END) AS 'late_arrival_date',
    COUNT(CASE WHEN DAYOFWEEK(timekeepings.start_time) NOT IN (1, 7) THEN 1 END) as 'number_working_day',
    SUM(CASE WHEN DAYOFWEEK(timekeepings.start_time) IN (1, 7) THEN TIME_FORMAT(timekeepings.end_time, '%H:%i:%s')-TIME_FORMAT(timekeepings.start_time, '%H:%i:%s') ELSE 0 END) as 'overtime'")
            ->join("timekeepings", "timekeepings.staff_id", "=", "staffs.id")
            ->join("contracts", "contracts.staff_id", "=", "staffs.id")
            ->join("salaries", "salaries.id", "=", "contracts.salary_id")
            ->leftJoin("users", "users.staff_id", "=", "staffs.id")
            ->whereMonth("timekeepings.start_time", "=", date("m"))
            ->where("contracts.status", "=", 1)
            ->groupBy('staffs.id', 'staffs.name', 'users.username', 'contracts.id', 'salaries.basic_salary')
            ->orderBy('staffs.id')
            ->get();
    }

}

?>
