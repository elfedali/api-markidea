<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdatePhoneRequest;
use Illuminate\Http\Request;

class UserPhoneNumberController extends Controller
{
    // update phone number

    public function store(UserUpdatePhoneRequest $request)
    {
        $request->user()->update([
            'phone_number' => $request->phone_number,
            'phone_number_verified_at' => null,
            'phone_number_verification_token' => \Illuminate\Support\Str::random(32),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Phone number changed successfully',
            'data' => $request->user()
        ], 200);
    }
}
