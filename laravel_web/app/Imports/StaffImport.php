<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class StaffImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure

{
    use Importable, SkipsFailures;
    protected $staffRepository;

    public function __construct($staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    // public function mapping():array
    // {
    //     return [
    //         'name'  => 'A1',
    //         'citizen_identity_card' => 'B1',
    //         'phone_number'  => 'C1',
    //         'birthday'  => 'D1',
    //         'gender'  => 'E1',
    //         'address'  => 'F1',
    //         'department_id'  => 'G1',
    //         'status'  => 'H1',
    //     ];
    // }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $row["ngay_sinh"] = date('Y-m-d', strtotime('1899-12-30 +' . $row["ngay_sinh"] . ' days'));
        // Log::info($row);
        return $this->staffRepository->store([
            "name"=>$row["ten_nhan_vien"],
            "citizen_identity_card"=> $row["so_can_cuoc_cong_dan"],
            "phone_number"=>$row["so_dien_thoai"],
            "birthday"=> $row["ngay_sinh"],
            "address"=> $row["dia_chi"],
            "gender"=> $row["gioi_tinh"],
            "department_id"=> $row["phong_ban"],
            "status"=> $row["trang_thai"],
        ]);
    }



    public function rules(): array
    {
        return [
             'ten_nhan_vien' => 'required',
             'so_can_cuoc_cong_dan' => 'required|size:12|unique:staffs,citizen_identity_card',
             'so_dien_thoai' => 'required|size:10|unique:staffs,phone_number',
             'ngay_sinh' => 'required',
             'dia_chi' => 'required',
             'gioi_tinh' => 'required',
             'phong_ban' => 'required',    
             'trang_thai' => 'required',      
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'ten_nhan_vien.required' => 'Vui lòng nhập tên nhân viên.',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ.',
            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.size' => 'Số điện thoại phải có 10 số.',
            'so_dien_thoai.unique' => 'Số điện thoại đã được sử dụng.',
            'so_can_cuoc_cong_dan.required' => 'Vui lòng nhập số căn cước công dân.',
            'so_can_cuoc_cong_dan.size' => 'Số căn cước công dân phải có 12 số.',
            'so_can_cuoc_cong_dan.unique' => 'Số căn cước công dân đã được sử dụng.',
            'gioi_tinh.required' => 'Vui lòng chọn giới tính',
            'trang_thai.required' => 'Vui lòng chọn trạng thái hoạt động',
            'ngay_sinh.required' => 'Vui lòng chọn ngày sinh.',
            'phong_ban.required' => 'Vui lòng chọn phòng ban.',
        ];
    }
}
