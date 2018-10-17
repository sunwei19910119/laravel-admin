<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Validation\Rule;

class RoleRequest extends Request
{
    public function rules()
    {
        switch($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        'name'                      => 'required|unique:' . config('admin.role_table'),
                        'display_name'              => "required|max:255",
                        'description'               => 'required|max:255',
                    ];
                }
            // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'display_name'              => "required|max:255",
                        'description'               => 'required|max:255'
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                };
        }
    }

    public function messages()
    {
        return [
            'name.required'                 => '角色标识必填',
            'name.unique'                   => '角色标识已存在',
            'display_name.required'         => '角色名称必填',
            'display_name.max'              => '角色名称最多255个字符',
            'description.required'          => '角色描述必填',
            'description.max'               => '角色描述最多255个字符',
        ];
    }
}
