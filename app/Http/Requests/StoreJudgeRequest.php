<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJudgeRequest extends FormRequest
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
            'judge_name'      => 'required',
            'nik'               => 'required',
            'npwp_number'       => 'required',
            'file_ktp_judge'  => 'required|file|mimes:jpg,jpeg,bmp,png',
            'file_npwp'         => 'required|file|mimes:jpg,jpeg,bmp,png',
            'certificate_file'   => 'required|file|mimes:jpg,jpeg,bmp,png',
            'email'     => 'required|email|unique:users'
        ];
    }

    public function messages()
    {
        return [
            'judge_name.required'       => 'Nama wajib diisi',
            'nik.required'              => 'NIK diisi',
            'npwp_number.required'       => 'NPWP wajib diisi',
            'file_ktp_judge.required'   => 'Foto KTP wajib diupload',
            'file_ktp_judge.image'      => 'File harus berupa format .jpg .png .jpeg',
            'file_npwp.required'        => 'NPWP wajib diupload',
            'file_npwp.image'           => 'File harus berupa format .jpg .png .jpeg',
            'certificate_file.required'        => 'Sertifikat wajib diupload',
            'certificate_file.image'           => 'File harus berupa format .jpg .png .jpeg',
            'email.required' => 'Email wajib diisi/sudah digunakan'
        ];
    }
}
