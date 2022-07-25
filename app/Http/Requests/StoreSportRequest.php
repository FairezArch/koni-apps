<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSportRequest extends FormRequest
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
            'sportbranch_name'          => 'required|min:3',
            'email'                     => 'required|email|unique:users',
            'phone_number_sport'        => 'required',
            'file_sport'                => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        return [
            'sportbranch_name.required'     => 'Nama wajib diisi',
            'sportbranch_name.min'          => 'Nama minimal 3 karakter',
            'email.required'                => 'Email wajib diisi',
            'phone_number_sport.required'   => 'Nomor HP wajib diisi',
            'file_sport.required'           => 'Foto wajib diupload',
            'file_sport.image'              => 'File harus berupa format .jpg .png .jpeg', 
        ];
    }
}
