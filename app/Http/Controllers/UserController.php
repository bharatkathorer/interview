<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->get();
        return Inertia::render('Welcome', [
            'users' => $users
        ]);
    }

    public function store(UserRequest $request)
    {

        try {
            User::query()->create([...$request->validated(), 'password' => Hash::make($request->password)]);
            return redirect()->back()->with('success', 'user create successfully');
        } catch (\Exception $e) {
            info($e->getMessage());
            return redirect()->back()->with('error', 'user create successfully');
        }
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

            return redirect()->back()->with('success', 'user update successfully');
        } catch (\Exception $e) {
            info($e->getMessage());
            return redirect()->back()->with('error', 'user create successfully');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'user delete successfully');

    }

}
