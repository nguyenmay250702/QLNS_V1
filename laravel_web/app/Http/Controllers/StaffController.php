<?php

namespace App\Http\Controllers;

use App\Exports\StaffExport;
use App\Http\Requests\StaffRequest;
use App\Imports\StaffExcel;
use App\Imports\StaffImport;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\SalaryDetailRepositoryInterface;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Repositories\Interfaces\TimeKeepingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Repository\DepartmentRepository;
use App\Staff;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StaffController extends CommonController
{
    public function store(StaffRequest $request)
    {
        $staff_id_old = $this->staffRepository->getStaffByCitizenIdentityCard($request->validated()['citizen_identity_card']);
        if($staff_id_old != -1) {
            return redirect()->back()->withErrors(['isPastStaff' => $staff_id_old])->withInput();
        }

        $data = $request->validated();

        $this->staffRepository->store($data);
        return redirect()->route("staffs.search")->with('success', 'Thêm mới nhân viên thành công.');
    }

    public function update(StaffRequest $request, Staff $staff)
    {
        $data = $request->validated();

        $this->staffRepository->update($staff->id, $data);
        return redirect()->route('staffs.search')->with('success','Cập nhật thông tin nhân viên thành công.');
    }

    public function destroy(Staff $staff)
    {
        $this->staffRepository->update($staff->id, ['status'=> 0]);
        return redirect()->back()->with('success','Xóa thông tin nhân viên thành công.');
    }

    public function import(Request $request){
        $file = $request->file('txt_file')->store("public/templates");
        $import = new StaffImport($this->staffRepository);
        $import->import($file);

        if (Session::has('importError')) {
            Session::forget('importError');
        }

        if($import->failures()->isNotEmpty()){
            $templateFileName = 'mẫu ghi lỗi danh sách nhân viên.xlsx';
            $newFileName = time() . '_danh sách nhân viên bị lỗi.xlsx';

            $templatePath = public_path('templates') . '/' . $templateFileName;
            $newPath = public_path('templates') . '/' . $newFileName;

            Session::put('importError', $newFileName);

            if (File::exists($templatePath)) {
                File::copy($templatePath, $newPath);

                $spreadsheet = IOFactory::load($newPath);
                $worksheet = $spreadsheet->getActiveSheet();

                $row = 2;
                $check = -2;
                foreach ($import->failures() as $failure) {
                    if($check != $failure->row()){
                        $worksheet->setCellValue('A' . $row, $failure->values()["ten_nhan_vien"]);
                        $worksheet->setCellValue('B' . $row, $failure->values()["so_can_cuoc_cong_dan"]);
                        $worksheet->setCellValue('C' . $row, $failure->values()["so_dien_thoai"]);
                        $worksheet->setCellValue('D' . $row, $failure->values()["ngay_sinh"]);
                        $worksheet->setCellValue('E' . $row, $failure->values()["gioi_tinh"]);
                        $worksheet->setCellValue('F' . $row, $failure->values()["dia_chi"]);
                        $worksheet->setCellValue('G' . $row, $failure->values()["phong_ban"]);
                        $worksheet->setCellValue('H' . $row, $failure->values()["trang_thai"]);
                        $worksheet->setCellValue('I' . $row, $failure->errors()[0]);

                        $check = $failure->row();
                        $row1 = $row;
                        $row++;
                    }else{
                        $worksheet->setCellValue('I' . $row1, $worksheet->getCell('I'.$row1)->getValue()."\n".$failure->errors()[0]);
                    }
                }

                $writer = new Xlsx($spreadsheet);
                $writer->save($newPath);
            }
        }
        return back()->with('success','Thêm thông tin nhân viên thành công.');
    }

    public function export(Request $request){
        $data = $this->staffRepository->search1($request->all());
        return Excel::download(new StaffExport($data),'danh sách nhân viên.xlsx');
    }

}
