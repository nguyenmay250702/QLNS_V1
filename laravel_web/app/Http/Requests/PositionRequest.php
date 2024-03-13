<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            ]); 
        }elseif($this->input('function') == 'update'){
            $this->merge([
                'name' => $this->input('txt_name'),
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
            ];
        }elseif($this->input('function') == 'update'){
            return [
                'name' => 'required',
                'status' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên phòng ban.',
        ];
    }
}
