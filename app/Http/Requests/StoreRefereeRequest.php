<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRefereeRequest extends FormRequest
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
            'file_ktp_referee'  => 'required|file|mimes:jpg,jpeg,bmp,png',
            'npwp_file'         => 'required|file|mimes:jpg,jpeg,bmp,png',
            'certificate_number' => 'required',
            'certificate_file'   => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        return [
            'referee_name.required'       => 'Nama wajib diisi',
            'nik.required'              => 'NIK diisi',
            'npwp_number.required'      => 'NPWP wajib diisi',
            'file_ktp_referee.required'   => 'Foto KTP wajib diupload',
            'file_ktp_referee.image'      => 'File harus berupa format .jpg .png .jpeg',
            'npwp_file.required'        => 'NPWP wajib diupload',
            'npwp_file.image'           => 'File harus berupa format .jpg .png .jpeg',
            'certificate_number.required'      => 'Sertifikat Wajib diisi',
            'certificate_file.required'        => 'Sertifikat wajib diupload',
            'certificate_file.image'           => 'File harus berupa format .jpg .png .jpeg',
        ];
    }
}
