<?php

namespace App\Http\Requests;

class MenuRequest extends Request
{

    public function rules()
    {
        return [
            'parent_id'     => 'Numeric',
            'title'         => 'required|max:50',
            'icon'          => 'required|max:50',
            'uri'           => 'max:50',
            'route_key'     => 'in:url,controller',
            'route_value'   => 'max:128',
        ];
    }


    public function messages()
    {
        return [
            'title.required'                => '标题必选',
            'title.max'                     => '标题最多50个字符',
            'icon.required'                 => 'ICON必选',
            'icon.max'                      => 'ICON最多50个字符',
            'uri.required'                  => '路径最多50个字符',
            'route_key.required'            => '路由必选',
            'route_key.in'                  => '路由只能选择URL、Controller',
            'route_value.required'          => '路由内容必填',
            'route_value.max'               => '路由内容最多128个字符',
        ];
    }
}
