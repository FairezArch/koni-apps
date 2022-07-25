<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'title'     => 'required|min:3',
            'content_news'  => 'required|min:3',
            'file_news.*'      => 'required|file|mimes:jpg,jpeg,bmp,png',
        
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Nama wajib diisi',
            'name.min'       => 'Nama minimal 3 karakter',
            'content_news.required'  => 'Konten wajib diisi',
            'content_news.min'       => 'Konten minimal 3 karakter',
            'file_news.required'       => 'Foto wajib diupload',
            'file_news.image' => 'File harus berupa format .jpg .png .jpeg',
        ];
    }
}
