<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainnerRequest extends FormRequest
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
            'trainer_name'      => 'required',
            'nik'               => 'required',
            'nomor_npwp'       => 'required',
            'email'     => 'required|email|unique:users,email,'.$request->users_id,

        ];
    }

    public function messages()
    {
        return [
            'trainer_name.required'       => 'Nama wajib diisi',
            'nik.required'              => 'NIK diisi',
            'nomor_npwp.required'      => 'NPWP wajib diisi',
            'email.required' => 'Email wajib diisi/sudah digunakan'
        ];
    }
}
