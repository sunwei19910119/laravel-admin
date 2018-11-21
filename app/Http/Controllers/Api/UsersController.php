<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;


class UsersController extends ApiController
{
    public function index(UserRequest $request)
    {
        $user = User::get();
        return $this->response->array($user);
    }
}
