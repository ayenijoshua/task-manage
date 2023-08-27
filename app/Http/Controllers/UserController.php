<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\User;

class UserController extends Controller
{
    private $user;
    function __construct(RepositoryInterface $user)
    {
        $this->user = $user;
    }
    

    /**
     * get employee dashboard
     */
    public function userDashboard(Request $request)
    {
        $id = $request->user()->id;
        $user = $this->user->get($id)->load('tasks');
        return view ('dashboard',['user'=>$user]);
    }
}
