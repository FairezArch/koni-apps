<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateAtletRequest extends FormRequest
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
            'name_atlet'        => 'required',
            'nik'               => 'required',
            'place_born'        => 'required',
            'domicile_address'  => 'required',
            'email'     => 'required|email|unique:users,email,'.$request->users_id,

        ];
    }

    public function messages()
    {
        return [
            'name_atlet.required'       => 'Nama wajib diisi',
            'nik.required'              => 'Nama wajib diisi',
            'place_born.required'       => 'Tempat Lahir wajib diisi',
            'domicile_address.required' => 'Tempat domisili wajib diisi',
            'email.required' => 'Email wajib diisi/sudah digunakan'

        ];
    }
}
