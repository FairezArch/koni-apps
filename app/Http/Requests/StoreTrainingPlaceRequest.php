<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingPlaceRequest extends FormRequest
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
            'place_name' => 'required',
            // 'file_training' => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        # code...
        return [
            'place_name.required'  => 'Nama wajib diisi',
            // 'file_training.required'  => 'Foto wajib diupload',
        ];
    }
}
