<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdatePasswordRequest;
use Illuminate\Http\Request;

class UserChangePasswordController extends Controller
{
    // change password
    public function store(UserUpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully',
            'data' => $request->user()
        ], 200);
    }
}
