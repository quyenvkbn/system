<?php

namespace Quyenvkbn\System\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $name = 'required|unique:roles,name';
        if(!empty(request()->id)){
            $name .= ','.request()->id.',id';
        }
        return [
            'name' => $name,
            'permission' => 'required',
        ];
    }
}
