<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserVerifyEmailController extends Controller
{
    // verify email
    public function store(Request $request, \App\Models\User $user)
    {
        if ($user->email_verification_token !== $request->token) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token',
            ], 422);
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Email verified successfully',
            'data' => $user
        ], 200);
    }
}
