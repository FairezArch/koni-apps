<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateSportRequest extends FormRequest
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
            'sportbranch_name'  => 'required|min:3',
            'email'             => 'required|email|unique:users,email,'.$request->id,
            'phone_number_sport'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sportbranch_name.required'     => 'Nama wajib diisi',
            'sportbranch_name.min'          => 'Nama minimal 3 karakter',
            'email.required'                => 'Email wajib diisi',
            'phone_number_sport.required'   => 'Nomor HP wajib diisi',
        ];
    }
}
