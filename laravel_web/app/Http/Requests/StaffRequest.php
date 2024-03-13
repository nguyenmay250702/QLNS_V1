<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => $this->input('txt_name'),
            'address' => $this->input('txt_address'),
            'phone_number' => $this->input('txt_phone_number'),
            'citizen_identity_card' => $this->input('txt_citizen_identity_card'),
            'gender' => $this->input('txt_gender'),
            'birthday' => $this->input('txt_birthday'),
            'department_id' => $this->input('txt_department'),
            'status' => $this->input('txt_status'),
        ]); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->input("function") == "create"){
            return [
                'name' => 'required',
                'address' => 'required',
                'phone_number' => 'required|size:10|unique:staffs,phone_number',
                'citizen_identity_card' => ['required',
                                            'size:12',
                                            Rule::unique('staffs', 'citizen_identity_card')->where(function ($query) {
                                                $query->where('status', 1);
                                            })],
                'gender' => 'required',
                'status' => 'required',
                'birthday' => 'required',
                'department_id' => 'not_in:-1',
            ];
        }elseif($this->input("function") == "update"){
            return [
                'name' => 'required',
                'address' => 'required',
                'phone_number' => ['required', 'size:10', Rule::unique("staffs", "phone_number")->ignore($this->input('id'))],
                'citizen_identity_card' => ['required', 'size:12', Rule::unique("staffs", "citizen_identity_card")->ignore($this->input('id'))],
                'gender' => 'required',
                'status' => 'required',
                'birthday' => 'required',
                'department_id' => 'not_in:-1',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên nhân viên.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'phone_number.size' => 'Số điện thoại phải có 10 số.',
            'phone_number.unique' => 'Số điện thoại đã được sử dụng.',
            'citizen_identity_card.required' => 'Vui lòng nhập số căn cước công dân.',
            'citizen_identity_card.size' => 'Số căn cước công dân phải có 12 số.',
            'citizen_identity_card.unique' => 'Số căn cước công dân đã được sử dụng.',
            'gender.required' => 'Vui lòng chọn giới tính',
            'status.required' => 'Vui lòng chọn trạng thái hoạt động',
            'birthday.required' => 'Vui lòng chọn ngày sinh.',
            'department_id.not_in' => 'Vui lòng chọn phòng ban.',
        ];
    }
}
