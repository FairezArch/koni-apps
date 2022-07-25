<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateClubRequest extends FormRequest
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
            'club_name'      => 'required',
            'email'     => 'required|email|unique:clubs,email,'.$request->id,
            
        ];
    }

    public function messages(){
        return [
            'club_name.required'    => 'Nama wajib diisi',
            'email.required'        => 'Email wajib diisi',
        ];
    }
}
