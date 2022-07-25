<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamSupportRequest extends FormRequest
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
            'phone'  => 'required',
            'email'     => 'required|email|unique:users,email,'.$request->user_id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Nama wajib diisi',
            'sk_no.required'  => 'Nomor SK wajib diisi',
            'phone.required'  => 'Nomor telepon wajib diisi',
            'email.required' => 'Email wajib diisi/sudah digunakan'
        ];
    }
}
