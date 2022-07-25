<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryNewsRequest extends FormRequest
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
            'category_name' => 'required|min:3',
            'file_category' => 'required|file|mimes:jpg,jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        # code...
        return [
            'category_name.required'  => 'Nama wajib diisi',
            'category_name.min'       => 'Nama minimal 3 karakter',
            'file_category.required'  => 'Foto wajib diupload',
        ];
    }
}
