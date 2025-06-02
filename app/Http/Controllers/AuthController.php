<?php
// filepath: app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController 
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $user = User::where('username', $fields['username'])->first();
    
        if (! $user || ! Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        // Clean up old tokens
        $user->tokens()->delete();
    
        $token = $user->createToken('auth_token')->plainTextToken;
        
        // Calculate expiry time
        // Use config value or fallback to default (2 hours)
        $expirationMinutes = config('sanctum.expiration', 120);
        $expiryTime = now()->addMinutes($expirationMinutes)->timestamp;
    
        return response()->json([
            'message' => 'Login successful!',
            'user'    => $user,
            'token'   => $token,
            'token_type' => 'Bearer',
            'expires_at' => $expiryTime * 1000, // Convert to milliseconds for JS
        ]);
    }
    
    // Add a token refresh endpoint
    public function refreshToken(Request $request)
    {
        $user = $request->user();
        
        // Create a new token
        $token = $user->createToken('auth_token')->plainTextToken;
        
        // Calculate expiry time
        $expirationMinutes = config('sanctum.expiration', 120);
        $expiryTime = now()->addMinutes($expirationMinutes)->timestamp;
        
        return response()->json([
            'message' => 'Token refreshed',
            'token' => $token,
            'expires_at' => $expiryTime * 1000, // Convert to milliseconds for JS
        ]);
    }
    
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return response()->json(['status' => __($status)]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return response()->json(['status' => __($status)]);
    }
}