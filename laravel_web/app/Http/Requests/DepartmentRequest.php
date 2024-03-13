<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        if($this->input("function") == "create"){
            $this->merge([
                'name' => $this->input('txt_name'),
                'address' => $this->input('txt_address'),
            ]); 
        }elseif($this->input('function') == 'update'){
            $this->merge([
                'name' => $this->input('txt_name'),
                'address' => $this->input('txt_address'),
                'status'=> $this->input('txt_status'),
            ]); 
        }
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
            ];
        }elseif($this->input('function') == 'update'){
            return [
                'name' => 'required',
                'address' => 'required',
                'status' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên phòng ban.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
        ];
    }
}
