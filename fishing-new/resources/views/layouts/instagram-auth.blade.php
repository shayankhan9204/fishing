<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Instagram')">
    <title>@yield('title', 'Instagram')</title>

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #fafafa;
            color: #262626;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: #0095f6;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .language-bar {
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 12px 16px 0;
            flex-shrink: 0;
        }

        .language-select {
            appearance: none;
            -webkit-appearance: none;
            background-color: transparent;
            border: none;
            color: #8e8e8e;
            font-size: 12px;
            line-height: 16px;
            padding: 4px 18px 4px 0;
            cursor: default;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238e8e8e' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right center;
            background-size: 10px;
        }

        .language-select:focus {
            outline: none;
        }

        .page-wrapper {
            width: 100%;
            max-width: 350px;
            padding: 12px 0 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            justify-content: center;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #dbdbdb;
            border-radius: 1px;
            padding: 40px 40px 20px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card--bottom {
            margin-top: 10px;
            padding: 20px 40px;
            text-align: center;
            font-size: 14px;
            width: 100%;
            background-color: #ffffff;
            border: 1px solid #dbdbdb;
            border-radius: 1px;
        }

        .card--back-to-login {
            margin-top: 0;
            border-top: 1px solid #dbdbdb;
            background-color: #fafafa;
            padding: 14px 40px;
            text-align: center;
            width: 100%;
            border-bottom-left-radius: 1px;
            border-bottom-right-radius: 1px;
        }

        .card--back-to-login a {
            color: #262626;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
        }

        .card--back-to-login a:hover {
            text-decoration: underline;
        }

        .logo {
            margin-bottom: 22px;
            display: block;
            text-decoration: none;
        }

        .logo svg {
            width: 175px;
            height: 51px;
            display: block;
        }

        .card-subtitle {
            color: #8e8e8e;
            font-size: 17px;
            font-weight: 600;
            text-align: center;
            line-height: 20px;
            margin: 0 0 16px 0;
        }

        .card-description {
            color: #8e8e8e;
            font-size: 14px;
            text-align: center;
            line-height: 18px;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .icon-circle-container {
            width: 96px;
            height: 96px;
            border: 2px solid #262626;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .icon-circle-container svg {
            width: 48px;
            height: 48px;
            fill: none;
            stroke: #262626;
            stroke-width: 2;
        }

        .form-status {
            width: 100%;
            margin-bottom: 14px;
            background-color: #eef9f1;
            border: 1px solid #45c05d;
            border-radius: 4px;
            padding: 10px 12px;
            color: #1b6329;
            font-size: 13px;
            line-height: 1.4;
            text-align: center;
        }

        .form-errors {
            width: 100%;
            margin-bottom: 14px;
        }

        .form-errors__list {
            list-style: none;
            background-color: #fff5f5;
            border: 1px solid #ed4956;
            border-radius: 4px;
            padding: 10px 12px;
        }

        .form-errors__item {
            color: #ed4956;
            font-size: 13px;
            line-height: 1.4;
        }

        .form-errors__item + .form-errors__item {
            margin-top: 4px;
        }

        .auth-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group {
            position: relative;
            width: 100%;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .form-input {
            width: 100%;
            padding: 9px 8px 7px;
            font-size: 12px;
            line-height: 18px;
            color: #262626;
            background-color: #fafafa;
            border: 1px solid #dbdbdb;
            border-radius: 3px;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .form-input-has-toggle {
            padding-right: 50px;
        }

        .form-input::placeholder {
            color: #8e8e8e;
        }

        .form-input:focus {
            border-color: #a8a8a8;
        }

        .form-input--error {
            border-color: #ed4956;
        }

        .toggle-password-btn {
            position: absolute;
            right: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: none;
            align-items: center;
            justify-content: center;
            user-select: none;
        }

        .toggle-password-btn:hover svg {
            stroke: #262626;
        }

        .toggle-password-btn svg {
            width: 18px;
            height: 18px;
            stroke: #8e8e8e;
            transition: stroke 0.2s ease;
            display: block;
        }

        .field-error {
            color: #ed4956;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .btn-primary {
            width: 100%;
            margin-top: 8px;
            padding: 7px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
            background-color: #0095f6;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: #1877f2;
            text-decoration: none;
        }

        .btn-primary:active:not(:disabled) {
            background-color: #0064d1;
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-facebook {
            width: 100%;
            background-color: #0095f6;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            padding: 7px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .btn-facebook:hover {
            background-color: #1877f2;
            text-decoration: none;
        }

        .btn-facebook svg {
            width: 16px;
            height: 16px;
            fill: #ffffff;
        }

        .divider {
            display: flex;
            align-items: center;
            width: 100%;
            margin: 18px 0;
            gap: 18px;
        }

        .divider__line {
            flex: 1;
            height: 1px;
            background-color: #dbdbdb;
        }

        .divider__text {
            font-size: 13px;
            font-weight: 600;
            color: #8e8e8e;
            text-transform: uppercase;
        }

        .facebook-login {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #385185;
            text-decoration: none;
            margin-top: 8px;
        }

        .facebook-login:hover {
            text-decoration: none;
            color: #003569;
        }

        .facebook-login svg {
            width: 16px;
            height: 16px;
            fill: #385185;
            flex-shrink: 0;
        }

        .forgot-password {
            margin-top: 18px;
            font-size: 12px;
            text-align: center;
        }

        .forgot-password a {
            color: #00376b;
            font-size: 12px;
        }

        .terms-text {
            color: #8e8e8e;
            font-size: 12px;
            text-align: center;
            line-height: 16px;
            margin-top: 14px;
            padding: 0 4px;
        }

        .terms-text a {
            color: #8e8e8e;
            font-weight: 600;
        }

        .bottom-text {
            color: #262626;
            font-size: 14px;
        }

        .bottom-text a {
            font-weight: 600;
        }

        .app-download-section {
            width: 100%;
            max-width: 350px;
            text-align: center;
            margin-top: 18px;
        }

        .app-download-heading {
            font-size: 14px;
            color: #262626;
            margin-bottom: 16px;
        }

        .app-badges {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .app-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 136px;
            height: 40px;
            background-color: #000000;
            border-radius: 5px;
            color: #ffffff;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.02em;
        }

        .app-badge:hover {
            opacity: 0.85;
            text-decoration: none;
        }

        .app-badge span {
            display: block;
            font-size: 9px;
            font-weight: 400;
            opacity: 0.9;
        }

        .meta-footer {
            width: 100%;
            max-width: 1000px;
            padding: 24px 16px 36px;
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            font-size: 12px;
            color: #8e8e8e;
            flex-shrink: 0;
        }

        .meta-footer__links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px 16px;
            list-style: none;
        }

        .meta-footer__link a {
            color: #8e8e8e;
            text-decoration: none;
        }

        .meta-footer__link a:hover {
            text-decoration: underline;
        }

        .meta-footer__copyright {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        @media (max-width: 450px) {
            body {
                background-color: #ffffff;
            }

            .page-wrapper {
                padding: 0;
                max-width: 100%;
            }

            .card {
                border: none;
                border-radius: 0;
                padding: 24px 16px 16px;
            }

            .card--bottom {
                border: none;
                border-top: 1px solid #dbdbdb;
                border-radius: 0;
                padding: 20px 16px;
                margin-top: 0;
            }

            .card--back-to-login {
                border: none;
                border-top: 1px solid #dbdbdb;
                border-radius: 0;
            }

            .card-subtitle {
                margin: 0 0 16px;
            }

            .app-download-section {
                padding: 16px 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <header class="language-bar" role="banner">
        <label for="language-select" class="visually-hidden">Select language</label>
        <select id="language-select" class="language-select" aria-label="Select language" disabled>
            <option selected>English</option>
        </select>
    </header>

    <main class="page-wrapper" role="main">
        @yield('content')

        @hasSection('bottom')
            @yield('bottom')
        @endif

        <section class="app-download-section" aria-label="Get the app">
            <p class="app-download-heading">Get the app.</p>
            <div class="app-badges">
                <a href="#" class="app-badge" aria-label="Download on the App Store">
                    <div>
                        <span>Download on the</span>
                        App Store
                    </div>
                </a>
                <a href="#" class="app-badge" aria-label="Get it on Google Play">
                    <div>
                        <span>Get it on</span>
                        Google Play
                    </div>
                </a>
            </div>
        </section>
    </main>

    <footer class="meta-footer" role="contentinfo">
        <ul class="meta-footer__links">
            <li class="meta-footer__link"><a href="#">Meta</a></li>
            <li class="meta-footer__link"><a href="#">About</a></li>
            <li class="meta-footer__link"><a href="#">Blog</a></li>
            <li class="meta-footer__link"><a href="#">Jobs</a></li>
            <li class="meta-footer__link"><a href="#">Help</a></li>
            <li class="meta-footer__link"><a href="#">API</a></li>
            <li class="meta-footer__link"><a href="#">Privacy</a></li>
            <li class="meta-footer__link"><a href="#">Terms</a></li>
            <li class="meta-footer__link"><a href="#">Locations</a></li>
            <li class="meta-footer__link"><a href="#">Instagram Lite</a></li>
            <li class="meta-footer__link"><a href="#">Threads</a></li>
            <li class="meta-footer__link"><a href="#">Contact Uploading & Non-Users</a></li>
            <li class="meta-footer__link"><a href="#">Meta Verified</a></li>
        </ul>
        <div class="meta-footer__copyright">
            <span>English</span>
            <span>&copy; {{ date('Y') }} Instagram from Meta</span>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const eyeOpenSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
            const eyeOffSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;

            const passwordInputs = document.querySelectorAll('input[type="password"], input.form-input-has-toggle');
            passwordInputs.forEach(input => {
                const wrapper = input.closest('.input-wrapper');
                if (wrapper) {
                    const btn = wrapper.querySelector('.toggle-password-btn');
                    if (btn) {
                        btn.innerHTML = eyeOpenSVG;
                        input.addEventListener('input', function () {
                            btn.style.display = input.value.length > 0 ? 'inline-flex' : 'none';
                        });

                        btn.addEventListener('click', function () {
                            if (input.type === 'password') {
                                input.type = 'text';
                                btn.innerHTML = eyeOffSVG;
                                btn.setAttribute('aria-label', 'Hide password');
                            } else {
                                input.type = 'password';
                                btn.innerHTML = eyeOpenSVG;
                                btn.setAttribute('aria-label', 'Show password');
                            }
                        });
                    }
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
