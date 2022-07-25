<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatusTrainnerRequest extends FormRequest
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
            'status_trainner' => 'required'        
        ];
    }

    public function messages()
    {
        # code...
        return [
            'status_trainner.required'  => 'Status Pelatih wajib diisi',
        ];
    }
}
