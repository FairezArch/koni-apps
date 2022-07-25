<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRefereeRequest extends FormRequest
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
    public function rules()
    {
        return [
            //
            'referee_name'      => 'required',
            'nik'               => 'required',
            'npwp_number'       => 'required',
            'certificate_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'referee_name.required'       => 'Nama wajib diisi',
            'nik.required'              => 'NIK diisi',
            'npwp_number.required'      => 'NPWP wajib diisi',
            'certificate_number.required' => 'Sertifikat Wajib diisi',
        ];
    }
}
