<?php

namespace App\Repositories\Repository;

use App\Department;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    public function __construct(Department $department)
    {
        parent::__construct($department);
    }

    public function search(array $request)
    {
        $data = collect();
        if ($request != []) {
            $data = $this->model->where(function ($query) use ($request) {
                if ($request['txt_name'] !== null) {
                    $query->where('name', 'like', '%' . $request['txt_name'] . '%');
                }
                if ($request['txt_address'] !== null) {
                    $query->where('address', 'like', '%' . $request['txt_address'] . '%');
                }
                if ($request['txt_status'] !== "-1") {
                    $query->where('status', '=', $request['txt_status']);
                }
            })->orderBy('updated_at', 'desc')->get();
        }
        return $data;
    }
}

?>
