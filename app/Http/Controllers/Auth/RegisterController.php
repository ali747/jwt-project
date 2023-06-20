<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    protected $fillable = [

        'username', 'name', 'email', 'password'
        // Other fillable attributes...
    ];

    public function registerget(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required', // Ensure the 'name' field is required
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'username' => $request->query('username'),
            'name' => $request->query('name'),
            'email' => $request->query('email'),
            'password' => Hash::make($request->query('password')),
        ]);
        return $request->query('username');
        return response()->json(['message' => 'User registered successfully'], 201);
    }
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }
}
