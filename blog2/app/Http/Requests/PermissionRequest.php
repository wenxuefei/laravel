<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        $reg = 'required|unique:permissions,name';
        if (request('id', '')) {
            $reg .= ',' . $this->id;
        }

        $rules['name'] = $reg;

        return $rules;

    }

    public function messages()
    {
        return [
            'name.required' => '权限不能为空',
            'name.unique' => '权限不能重复'
        ];
    }
}
