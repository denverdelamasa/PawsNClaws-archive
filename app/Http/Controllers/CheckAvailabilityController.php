<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CheckAvailabilityController extends Controller
{
    public function check(Request $request)
    {
        $data = $request->validate([
            'username' => ['nullable', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string'],
            'email' => ['nullable', 'string', 'max:255']
        ]);

        $response = [];

        // Check username availability
        if (!empty($data['username'])) {
            $usernameExists = User::where('username', $data['username'])->exists();
            $response['username'] = $usernameExists
                ? ['available' => false, 'message' => 'Username is already taken.']
                : ['available' => true, 'message' => 'Username is available.'];
        }

        // Check email availability
        if (!empty($data['email'])) {
            $usernameExists = User::where('email', $data['email'])->exists();
            $response['email'] = $usernameExists
                ? ['available' => false, 'message' => 'Email is already taken.']
                : ['available' => true, 'message' => 'Email is available.'];
        }

        // Check name availability
        if (!empty($data['name'])) {
            $nameExists = User::where('name', $data['name'])->exists();
            $response['name'] = $nameExists
                ? ['available' => false, 'message' => 'Name is already in use.']
                : ['available' => true, 'message' => 'Name is available.'];
        }

        // Check password strength
        if (!empty($data['password'])) {
            $validator = Validator::make($data, [
                'password' => [Password::defaults()],
            ]);

            $response['password'] = $validator->fails()
                ? ['valid' => false, 'message' => 'Password is not strong enough.']
                : ['valid' => true, 'message' => 'Password is strong.'];
        }

        return response()->json($response);
    }
}
