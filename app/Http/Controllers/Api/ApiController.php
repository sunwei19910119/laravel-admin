<?php
/**
 * Created by PhpStorm.
 * User: sunwei
 * Date: 2018/11/21
 * Time: 9:36 AM
 */

namespace App\Http\Controllers\Api;


use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class ApiController extends Controller
{
    use ApiResponse,Helpers;

}