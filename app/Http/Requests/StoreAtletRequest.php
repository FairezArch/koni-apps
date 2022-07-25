<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAtletRequest extends FormRequest
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
            'name_atlet'        => 'required',
            'nik'               => 'required',
            'place_born'        => 'required',
            'domicile_address'  => 'required',
            'file_ktp_atlet'    => 'required|file|mimes:jpg,jpeg,bmp,png',
            'file_npwp'         => 'required|file|mimes:jpg,jpeg,bmp,png',
            'photo_profile' => 'required|file|mimes:jpg,jpeg,bmp,png',
            'email'     => 'required|email|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'name_atlet.required'       => 'Nama wajib diisi',
            'nik.required'              => 'Nama wajib diisi',
            'place_born.required'       => 'Tempat Lahir wajib diisi',
            'domicile_address.required' => 'Tempat domisili wajib diisi',
            'file_ktp_atlet.required'   => 'Foto KTP wajib diupload',
            'file_ktp_atlet.image'      => 'File harus berupa format .jpg .png .jpeg',
            'file_npwp.required'          => 'Foto NPWP wajib diupload',
            'file_npwp.image'             => 'File harus berupa format .jpg .png .jpeg',
            'photo_profile.required'  => 'Foto Status Atlet wajib diupload',
            'photo_profile.image'     => 'File harus berupa format .jpg .png .jpeg',
            'email.required' => 'Email wajib diisi/sudah digunakan',
        ];
    }
}
