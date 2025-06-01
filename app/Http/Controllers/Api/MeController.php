<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeController extends Controller
{
    /**
     * Get current user information
     */
    public function show(Request $request)
    {
        return response()->json([
            'user' => new UserResource($request->user())
        ]);
    }

    /**
     * Update current user information
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'nullable|string|max:255|unique:users,username,' . $request->user()->id,
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $request->user()->id,
            'avatarIndex' => 'nullable|integer|min:0|max:9',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $user = $request->user();

        $updateData = [];
        if ($request->has('username')) {
            $updateData['username'] = $request->username;
        }
        if ($request->has('email')) {
            $updateData['email'] = $request->email;
        }
        if ($request->has('avatarIndex')) {
            $updateData['avatar_index'] = $request->avatarIndex;
        }

        $user->update($updateData);

        return response()->json([
            'user' => new UserResource($user)
        ]);
    }
}
