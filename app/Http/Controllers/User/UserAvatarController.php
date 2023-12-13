<?php

namespace App\Http\Controllers\User;

use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAvatarRequest;
use App\Traits\FileUploaderTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{
    use FileUploaderTrait;
    /**
     * Update the user's avatar.
     */
    public function update(UserAvatarRequest $request)
    {
        try {
            $user = $request->user();
            // Delete the current avatar if it exists
            if ($user->avatar !== null) {
                try {
                    $this->deleteFile($user->avatar);
                } catch (\Exception $e) {
                    // Silence is golden...
                }
            }

            $avatar =  $this->uploadFile($request->file('avatar'), Settings::AVATAR_FOLDER, 'public', $user->id . '_avatar_' . time());
            $user->avatar = $avatar;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User photo updated successfully',
                // 'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete the user's photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {

        /** @var \App\Models\User $user */
        $user = $request->user();
        try {
            // Delete the current avatar if it exists
            $this->deleteFile($user->avatar);
        } catch (\Exception $e) {
            // Silence is golden...
        }
        $user->avatar = null;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User photo deleted successfully',
            //'data' => $user,
        ], 200);
    }
}
