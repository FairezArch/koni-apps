<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarActivitieRequest extends FormRequest
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
            'name_match' => 'required',
        ];
    }

    public function messages()
    {
        # code...
        return [
            'name_match.required'  => 'Nama Pertandingan wajib diisi',
        ];
    }
}
