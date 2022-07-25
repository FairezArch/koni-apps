<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolePermissionRequest extends FormRequest
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
            'name' => 'required',
            'permission' => 'required',
        ];
    }

    public function messages()
    {
        # code...
        return [
            'name.required'         => 'Nama role wajib diisi',
            'permission.required'   => 'Permission wajib dipilih',
        ];
    }
}
