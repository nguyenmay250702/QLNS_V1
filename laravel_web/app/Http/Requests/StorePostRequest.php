<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StorePostRequest extends FormRequest
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
    //             'username' => $this->input('username'),
    //             'password' => Hash::make($this->input('password')),
    //             'staff_id' => $this->input('staff_id'),
    //             'role_id' => $this->input('role_id'),
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
        if($this->input("function") == "create"){
            return [
                'username' => 'required',
                'password' => [
                    'required',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,30}$/',
                ],
                'staff_id' => 'not_in:--chọn mã nhân viên--',
                'role_id' => 'required',
            ];
        }elseif($this->input("function") == "update"){
            return [
                'username' => 'required',
                'password' => ['nullable', 'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,30}$/'],
                'staff_id' => 'not_in:--chọn mã nhân viên--',
                'role_id' => 'required',
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
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.regex' => 'Mật khẩu phải từ 8-30 ký tự và phải chứa ít nhất 1 chữ in hoa và 1 chữ thường.',
                'staff_id.not_in' => 'Vui lòng chọn mã nhân viên.',
                'role_id.required' => '',
            ];
        }elseif($this->input("function") == "update"){
            return [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'password.regex' => 'Mật khẩu phải từ 8-30 ký tự và phải chứa ít nhất 1 chữ in hoa và 1 chữ thường.',
                'staff_id.not_in' => 'Vui lòng chọn mã nhân viên.',
                'role_id.required' => '',
            ];
        }else{
            return [
                'username.required' => 'Vui lòng nhập tên đăng nhập.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
            ];
        }
    }
    /**
 * Handle a passed validation attempt.
 */
    // protected function passedValidation(): void
    // {
    //     $this->merge([
    //         'password' => Hash::make($this->input('password')),
    //     ]);
    //     // dd($this->input('password'));
    // }
}
