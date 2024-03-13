<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
    // public function prepareForValidation()
    // {
    //     if($this->input("function") == "create"){
    //         $this->merge([
    //             'username' => $this->input('txt_username'),
    //             'password' => $this->input('txt_password'),
    //             'staff_id' => $this->input('txt_staff_id'),
    //             'role_id' => $this->input('txt_role_id'),
    //         ]); 
    //     }     
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->input('id'));
        if($this->input("function") == "create"){
            return [
                'username' => 'required|unique:users,username',
                'password' => [
                    'required',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,30}$/',
                ],
                'staff_id' => 'not_in:--chọn mã nhân viên--',
                'role_id' => 'required',
            ];
        }elseif($this->input("function") == "update"){
            return [
                'username' => ['required',Rule::unique("users", "username")->ignore($this->input('id'))],
                'password' => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,30}$/'],
                'staff_id' => 'not_in:--chọn mã nhân viên--',
                'role_id' => 'required',
                'status' => 'required',
            ];
        }else{
            return [
                'username' => 'required',
                'password' => 'required',          
            ];
        }
    }

    public function messages()
    {
        if($this->input("function") == "create"){
            return [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'username.unique' => 'Tên đăng nhập đã được sử dụng.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.regex' => 'Mật khẩu phải từ 8-30 ký tự và phải chứa ít nhất 1 chữ in hoa và 1 chữ thường.',
                'staff_id.not_in' => 'Vui lòng chọn mã nhân viên.',     
                'role_id.required' => '',
            ];
        }elseif($this->input("function") == "update"){
            return [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'username.unique' => 'Tên đăng nhập đã được sử dụng.',
                'password.regex' => 'Mật khẩu phải từ 8-30 ký tự và phải chứa ít nhất 1 chữ in hoa và 1 chữ thường.',
                'staff_id.not_in' => 'Vui lòng chọn mã nhân viên.',
                'role_id.required' => '',
                'status.required' => '',
            ];
        }else{
            return [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
            ];
        }
    }
}
