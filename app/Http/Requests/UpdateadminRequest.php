<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
class UpdateadminRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            //
            'name'      => 'required',
            'sk_no'     => 'required',
            'phoneNum'  => 'required',
            'email'     => 'required|email|unique:users,email,'.$request->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Nama wajib diisi',
            'sk_no.required'  => 'Nomor SK wajib diisi',
            'phoneNum.required'  => 'Nomor telepon wajib diisi',
            'email.required' => 'Email wajib diisi/sudah digunakan'
        ];
    }
}
