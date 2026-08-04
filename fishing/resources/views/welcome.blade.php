<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aw, Snap!</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f5f5;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 420px;
            padding: 0 24px;
            text-align: center;
        }

        .emoji {
            font-size: 72px;
            line-height: 1;
            margin-bottom: 24px;
            display: block;
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 12px;
            color: #1a1a1a;
        }

        p {
            font-size: 14px;
            color: #6b6b6b;
            line-height: 1.6;
            margin: 0 0 28px;
        }

        .btn {
            display: inline-block;
            padding: 9px 20px;
            background: #1a73e8;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-family: inherit;
        }

        .btn:hover {
            background: #1765cc;
        }

        .error-code {
            margin-top: 32px;
            font-size: 11px;
            color: #b0b0b0;
        }
    </style>
</head>
<body>
    <div class="container">
        <span class="emoji" role="img" aria-label="Sad face">😕</span>
        <h1>Aw, Snap!</h1>
        <p>
            Something went wrong! Too much traffic.<br>
            Try reloading, or go back to the login page.
        </p>
        <a href="{{ route('login') }}" class="btn">Go to Login</a>
        <div class="error-code">Error code: Out of service &nbsp;·&nbsp; <a href="#" onclick="location.reload(); return false;" style="color:#b0b0b0;">Reload</a></div>
    </div>
</body>
</html>
