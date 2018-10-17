<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Validation\Rule;

class AdminUserRequest extends Request
{
    public function rules()
    {
        switch($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        'username' => [
                            'required',
                            'between:3,25',
                            'regex:/^[A-Za-z0-9\-\_]+$/'
                        ],
                        'email' => "required|email|unique:" . config('admin.user_table'),
                        'password' => 'required|confirmed|between:6,25',
                        'mobile' => 'digits:11',
                        'roles' => 'array',
                    ];
                }
            // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'username' => [
                            'required',
                            'between:3,25',
                            'regex:/^[A-Za-z0-9\-\_]+$/',
                            Rule::unique(config('admin.user_table'))->ignore($this->input('id')),
                        ],
                        'mobile' => 'digits:11',
                        'roles' => 'array',
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
            'username.required'             => '用户名必填',
            'username.unique'               => '用户名已存在',
            'email.required'                => '邮箱必填',
            'email.email'                   => '邮箱格式不正确',
            'email.unique'                  => '邮箱已存在',
            'password.required'             => '密码必填',
            'password.confirmed'            => '两次密码不一致',
            'password.min'                  => '密码最小6位数',
            'mobile.digits'                 => '手机号码为11位数',
            'roles.array'                   => '权限错误',
        ];
    }
}
