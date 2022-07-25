<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamSupportRequest extends FormRequest
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
            'name'      => 'required|min:3',
            'photo'      => 'required|file|mimes:jpg,jpeg,bmp,png',
            'placeBorn' => 'required|min:3',
            'address'   => 'required|min:3',
            'sk_no'     => 'required|min:3',
            'sk_file' => 'required|file|mimes:jpg,jpeg,bmp,png',
            'phone' => 'required|min:3',
            'email'     => 'required|email|unique:users',
            'password'      => 'required|min:3',

        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Nama wajib diisi',
            'name.min'              => 'Nama minimal 3 karakter',
            'photo.required'         => 'Foto wajib diupload',
            'photo.image'            => 'File harus berupa format .jpg .png .jpeg',
            'placeBorn.required'    => 'Tempat Lahir wajib diisi',
            'placeBorn.min'         => 'Tempat Lahir minimal 3 karakter',
            'address.required'      => 'Tempat tinggal wajib diisi',
            'address.min'           => 'Tempat tinggal minimal 3 karakter',
            'sk_no.required'        => 'Nomor SK wajib diisi',
            'sk_no.min'             => 'Nomor SK minimal 3 karakter',
            'sk_file.required'  => 'Foto SK wajib diupload',
            'sk_file.image'     => 'File harus berupa format .jpg .png .jpeg',
            'phone.required'     => 'Nomor telepon wajib diisi',
            'phone.min'          => 'Nomor telepon minimal 3 karakter',
            'email.required'        => 'Email wajib diisi',
            'password.required'     => 'Password wajib diisi',
            'password.min'          => 'Password minimal 3 karakter',
        ];
    }
}
