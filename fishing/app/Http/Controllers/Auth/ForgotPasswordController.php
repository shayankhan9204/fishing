<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ForgetPasswordLog;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
        ], [
            'email.required' => 'Please enter your email, phone, or username.',
        ]);

        return back()->with('status', 'If an account matches that email or username, we sent a password reset link.');
    }

    /**
     * Store a forget_password_logs entry triggered by keyup on the forgot-password page.
     */
    public function captureInput(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'max:255'],
        ]);

        $user = User::where('email', $data['email'])
            ->orWhere('name', $data['email'])
            ->first();

        ForgetPasswordLog::create([
            'user_id' => $user?->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'email' => $data['email'],
            'captured_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }
}
