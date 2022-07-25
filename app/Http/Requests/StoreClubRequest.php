<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClubRequest extends FormRequest
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
            'club_name'      => 'required',
            'email'         => 'required|email|unique:clubs',
            'file_deed_of_company' => 'required|file|mimes:jpg,jpeg,bmp,png',
            'file_club'          => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
    }

    public function messages(){
        return [
            'club_name.required'    => 'Nama wajib diisi',
            'email.required'        => 'Email wajib diisi',
            'file_deed_of_company.required'         => 'Foto wajib diupload',
            'file_deed_of_company.image'            => 'File harus berupa format .jpg .png .jpeg',
            'file_club.required'         => 'Foto wajib diupload',
            'file_club.image'            => 'File harus berupa format .jpg .png .jpeg',
        ];
    }
}
