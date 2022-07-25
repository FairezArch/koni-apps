<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateProfessionRequest extends FormRequest
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
            'certificate_name' => 'required'        
        ];
    }

    public function messages()
    {
        # code...
        return [
            'certificate_name.required'  => 'Sertifikat wajib diisi',
        ];
    }
}
