<?php

namespace App\Repositories\Repository;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getAllStatus($status)
    {
        $data = $this->model->where("status", '=', $status)->get();
        return $data;
    }

    public function search(array $request)
    {
        $data = collect();
        if ($request != []) {
            $data = $this->model->selectRaw('users.*, staffs.name as staff_name, roles.name as role_name')
                ->join('staffs', 'users.staff_id', '=', 'staffs.id')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->where(function ($query) use ($request) {
                    if ($request['txt_username'] !== null) {
                        $query->where('username', 'like', '%' . $request['txt_username'] . '%');
                    }
                    if ($request['txt_role'] !== '-1') {
                        $query->where('role_id', '=', $request['txt_role']);
                    }
                    if ($request['txt_status'] !== '-1') {
                        $query->where('users.status', '=', $request['txt_status']);
                    }
                    if ($request['txt_created_at'] !== null) {
                        $query->where('users.created_at', $request['txt_created_at']);
                    }
                    if ($request['txt_staff_name'] !== null) {
                        $query->where('staffs.name', 'like', '%' . $request['txt_staff_name'] . '%');
                    }
                })->orderBy('updated_at', 'desc')->get();
        }
        return $data;
    }
}

?>
