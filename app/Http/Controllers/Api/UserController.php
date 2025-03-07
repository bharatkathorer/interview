<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => User::query()->get(),
        ], 200);
    }

    public function store(UserRequest $request)
    {

        try {
            $user = User::query()->create([...$request->validated(), 'password' => Hash::make($request->password)]);
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            info($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit(User $user)
    {

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);

    }


    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']);
            }
            $user->update($data);
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        } catch (\Exception $e) {
            info($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'users deleted successfully',
        ], 200);

    }
}
