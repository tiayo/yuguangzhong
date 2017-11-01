<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\OrderService;
use App\Services\Manage\ManagerService;

class IndexController extends Controller
{
    public function index(ManagerService $user)
    {
        return view('manage.index.index', [
            'lists' => $user->get(10),
        ]);
    }
}