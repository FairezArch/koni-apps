<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainnerRequest extends FormRequest
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
            'trainer_name'      => 'required',
            'nik'               => 'required',
            'nomor_npwp'       => 'required',
            'file_ktp_trainner'  => 'required|file|mimes:jpg,jpeg,bmp,png',
            'file_npwp'         => 'required|file|mimes:jpg,jpeg,bmp,png',
            'certificate_file'   => 'required|file|mimes:jpg,jpeg,bmp,png',
            'photo_profile'   => 'required|file|mimes:jpg,jpeg,bmp,png',
            'email'     => 'required|email|unique:users'
        ];
    }

    public function messages()
    {
        return [
            'trainer_name.required'       => 'Nama wajib diisi',
            'nik.required'              => 'NIK diisi',
            'nomor_npwp.required'      => 'NPWP wajib diisi',
            'file_ktp_trainner.required'   => 'Foto KTP wajib diupload',
            'file_ktp_trainner.image'      => 'File harus berupa format .jpg .png .jpeg',
            'file_npwp.required'        => 'NPWP wajib diupload',
            'file_npwp.image'           => 'File harus berupa format .jpg .png .jpeg',
            'certificate_file.required'        => 'Sertifikat wajib diupload',
            'certificate_file.image'           => 'File harus berupa format .jpg .png .jpeg',
            'photo_profile.required'        => 'NPWP wajib diupload',
            'photo_profile.image'           => 'File harus berupa format .jpg .png .jpeg',
            'email.required' => 'Email wajib diisi/sudah digunakan'
        ];
    }
}
