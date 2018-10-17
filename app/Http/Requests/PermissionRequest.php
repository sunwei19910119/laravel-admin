<?php

namespace App\Http\Requests;


class PermissionRequest extends Request
{

    public function rules()
    {
        switch($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        'name'                      => 'required|unique:' . config('admin.permission_table'),
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
            'name.required'                 => '权限标识必填',
            'name.unique'                   => '权限标识已存在',
            'display_name.required'         => '权限名称必填',
            'display_name.max'              => '权限名称最多255个字符',
            'description.required'          => '权限描述必填',
            'description.max'               => '权限描述最多255个字符',
        ];
    }
}
