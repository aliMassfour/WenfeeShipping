<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->where('role_id', "=", 2)->paginate(5);
        $users->each(function (User &$user) {
            $deliveries = $user->deliveries;
            if (sizeof($deliveries) > 0) {
                $user->setAttribute('status', 'busy');
            } else {
                $user->setAttribute('status', 'available');
            }

        });
        return view('users.index')->with([
            'users' => $users
        ]);

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);
        return redirect()->back()->with([
            'message' => 'driver created successfully',
            'messageStatus' => 1
        ]);
    }
}
