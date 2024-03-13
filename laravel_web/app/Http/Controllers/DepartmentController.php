<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends CommonController
{
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();

        $this->departmentRepository->store($data);
        return redirect()->route("departments.search")->with('success', 'Thêm mới phòng ban thành công.');
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->validated();
        $this->departmentRepository->update($department->id, $data);
        return redirect()->route('departments.search')->with('success','Cập nhật thông tin phòng ban thành công.');
    }


    public function destroy(Department $department)
    {
        // $this->departmentRepository->delete( $department->id );
        $this->departmentRepository->update($department->id, ["status"=>0]);
        return redirect()->back()->with('success','Xóa thông tin phòng ban thành công.');
    }
}
