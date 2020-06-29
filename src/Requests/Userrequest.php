<?php

namespace Quyenvkbn\System\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Quyenvkbn\System\Rules\OldPassword;

class Userrequest extends FormRequest
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
        $validation = [
            'rolesUser' => 'required'
        ];
        if(request()->password){
            $validation['password'] = 'required|min:8';
        }
        if(request()->id && request()->password && request()->old_password){
            $validation['password'] .= '|confirmed';
            $validation['old_password'] = new OldPassword;
        }
        if (!request()->id) {
            $validation['email'] = 'email:rfc,dns|unique:users,email';
        }
        return $validation;
    }
}
