<?php
/**
 * Created by PhpStorm.
 * User: sunwei
 * Date: 2018/11/21
 * Time: 4:18 PM
 */

namespace App\Helpers\Api;


class ResponseMsg
{
    const HTTP_CONTINUE = 100;
    const HTTP_SWITCHING_PROTOCOLS = 101;
    const HTTP_PROCESSING = 102;            // RFC2518
    const HTTP_EARLY_HINTS = 103;           // RFC8297
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_NO_CONTENT = 204;
    const HTTP_RESET_CONTENT = 205;
    const HTTP_PARTIAL_CONTENT = 206;
    const HTTP_MULTI_STATUS = 207;          // RFC4918
    const HTTP_ALREADY_REPORTED = 208;      // RFC5842
    const HTTP_IM_USED = 226;               // RFC3229
    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_FOUND = 302;
    const HTTP_SEE_OTHER = 303;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_USE_PROXY = 305;
    const HTTP_RESERVED = 306;
    const HTTP_TEMPORARY_REDIRECT = 307;
    const HTTP_PERMANENTLY_REDIRECT = 308;  // RFC7238
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_PAYMENT_REQUIRED = 402;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_CONFLICT = 409;
    const HTTP_GONE = 410;
    const HTTP_LENGTH_REQUIRED = 411;
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_REQUEST_URI_TOO_LONG = 414;
    const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_EXPECTATION_FAILED = 417;
    const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918

    /**
     * @deprecated
     */
    const HTTP_PRECONDITION_REQUIRED = 428;                                       // RFC6585
    const HTTP_TOO_MANY_REQUESTS = 429;                                           // RFC6585
    const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;                             // RFC6585
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_NOT_IMPLEMENTED = 501;
    const HTTP_BAD_GATEWAY = 502;
    const HTTP_SERVICE_UNAVAILABLE = 503;
    const HTTP_GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;
    const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;                             // RFC6585


    public static $statusTexts = array(
        100 => '继续',
        101 => '切换协议',
        102 => '进行中',
        103 => '预加载',
        200 => '成功',
        201 => '已创建',
        202 => '已接受',
        203 => '非授权信息',
        204 => '无内容',
        205 => '重置内容',
        206 => '部分内容',
        207 => '多种状态',
        208 => '已经报告',      // RFC5842
        226 => '使用IM协议',               // RFC3229
        300 => '多种选择',
        301 => '永久移动',
        302 => '临时移动',
        303 => '查看其他位置',
        304 => '未修改',
        305 => '使用代理',
        307 => '临时重定向',
        308 => '永久跳转',    // RFC7238
        400 => '请求错误',
        401 => '未授权',
        402 => '要求支付',
        403 => '禁止',
        404 => '未找到',
        405 => '方法禁用',
        406 => '不接受',
        407 => '需要代理授权',
        408 => '请求超时',
        409 => '冲突',
        410 => '已删除',
        411 => '需要有效长度',
        412 => '未满足前提条件',
        413 => '请求实体过大',
        414 => '请求的 URI 过长',
        415 => '不支持的媒体类型',
        416 => '请求范围不符合要求',
        417 => '未满足期望值',
        422 => '校验错误',
        428 => '要求先决条件',
        429 => '太多请求',
        431 => '请求头字段太大',
        500 => '服务器内部错误',
        501 => '尚未实施',
        502 => '错误网关',
        503 => '服务不可用',
        504 => '网关超时',
        505 => 'HTTP 版本不受支持',
        511 => '要求网络认证',
    );
}