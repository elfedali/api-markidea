<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEmailRequest;
use Illuminate\Support\Facades\Validator;

class UserChangeEmailController extends Controller
{
    // change email
    public function store(UserEmailRequest $request, User $user)
    {
        $user->update([
            'email' => $request->email,
            'email_verified_at' => null,
            'email_verification_token' => \Illuminate\Support\Str::random(32),
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Email changed successfully',
            'data' => $user
        ], 200);
    }
}
