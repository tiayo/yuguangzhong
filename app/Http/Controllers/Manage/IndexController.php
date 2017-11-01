<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\OrderService;
use App\Services\Manage\UserService;

class IndexController extends Controller
{
    public function index(UserService $user)
    {
        return view('manage.index.index', [
            'lists' => $user->get(10),
        ]);
    }
}