<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login – SmartRoom</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet"/>
    <style>
        :root {
            --navy: #0b1640;
            --navy-mid: #112060;
            --navy-light: #1a2f80;
            --gold: #f5c518;
            --gold-deep: #d4a10a;
            --gold-pale: #fde97a;
            --white: #ffffff;
            --off-white: #f0f4ff;
            --muted: rgba(255,255,255,0.55);
            --card-bg: rgba(255,255,255,0.04);
            --card-border: rgba(245,197,24,0.18);
            --error: #ff6b6b;
            --success: #51cf66;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Noise texture */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.35;
        }

        /* Ambient glow blobs */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            pointer-events: none;
            z-index: 0;
        }
        .blob-1 {
            width: 400px; height: 400px;
            background: var(--gold);
            top: -100px; left: -100px;
        }
        .blob-2 {
            width: 300px; height: 300px;
            background: var(--navy-light);
            bottom: -80px; right: -60px;
        }

        /* ── CARD ── */
        .login-card {
            position: relative;
            z-index: 10;
            display: flex;
            width: 90%;
            max-width: 860px;
            min-height: 520px;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(245,197,24,0.1);
            animation: slideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            position: relative;
            width: 42%;
            flex-shrink: 0;
            background: linear-gradient(160deg, var(--navy-light) 0%, var(--navy) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 36px;
            overflow: hidden;
        }

        /* Wavy right edge */
        .left-panel::after {
            content: '';
            position: absolute;
            top: 0; right: -1px;
            width: 60px;
            height: 100%;
            background: var(--white);
            clip-path: ellipse(60px 55% at 100% 50%);
            opacity: 0.07;
        }

        /* decorative circles */
        .panel-circle {
            position: absolute;
            border-radius: 50%;
            border: 1.5px solid rgba(245,197,24,0.15);
        }
        .panel-circle-1 { width: 280px; height: 280px; top: -80px; left: -80px; }
        .panel-circle-2 { width: 180px; height: 180px; bottom: -40px; right: -60px; border-color: rgba(245,197,24,0.1); }
        .panel-circle-3 {
            width: 110px; height: 110px;
            bottom: 80px; left: 30px;
            border-color: rgba(245,197,24,0.08);
        }

        .panel-welcome {
            font-family: 'Sora', sans-serif;
            font-size: 0.85rem;
            font-weight: 300;
            color: var(--muted);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .panel-icon-wrap {
            width: 88px;
            height: 88px;
            background: rgba(245,197,24,0.12);
            border: 1.5px solid rgba(245,197,24,0.3);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: 0 8px 32px rgba(245,197,24,0.15);
        }

        .panel-icon-wrap svg {
            width: 44px;
            height: 44px;
        }

        .panel-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: -0.02em;
            margin-bottom: 20px;
        }

        .panel-brand .accent { color: var(--gold); }

        .panel-tagline {
            font-size: 0.88rem;
            color: var(--muted);
            text-align: center;
            line-height: 1.65;
            max-width: 220px;
        }

        /* dots decoration */
        .panel-dots {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 6px;
        }
        .panel-dots span {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: rgba(245,197,24,0.3);
        }
        .panel-dots span:first-child { background: var(--gold); }

        /* ── RIGHT PANEL ── */
        .right-panel {
            flex: 1;
            background: rgba(255,255,255,0.055);
            backdrop-filter: blur(40px) saturate(1.4);
            padding: 52px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-left: 1px solid rgba(245,197,24,0.08);
        }

        .form-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(90deg, var(--white) 0%, var(--gold-pale) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 6px;
        }

        .form-subtitle {
            font-size: 0.9rem;
            color: var(--muted);
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 0.85rem;
            font-weight: 500;
            color: rgba(255,255,255,0.8);
            letter-spacing: 0.2px;
        }

        .input-wrap {
            position: relative;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 42px 12px 16px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(245,197,24,0.12);
            border-radius: 12px;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
        }

        input::placeholder { color: rgba(255,255,255,0.3); }

        input:focus {
            background: rgba(255,255,255,0.1);
            border-color: rgba(245,197,24,0.4);
            box-shadow: 0 0 0 3px rgba(245,197,24,0.08);
        }

        /* checkmark icon on right of input */
        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(245,197,24,0.4);
            font-size: 14px;
            pointer-events: none;
            transition: color 0.25s;
        }

        input:focus ~ .input-icon { color: var(--gold); }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 0.83rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--muted);
        }

        input[type="checkbox"] {
            width: 16px; height: 16px;
            cursor: pointer;
            accent-color: var(--gold);
        }

        .forgot-password {
            color: var(--gold);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover { text-decoration: underline; }

        /* Buttons row */
        .btn-row {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .isolate-link {
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: #1d4ed8;
            text-decoration: none;
            font-weight: 600;
        }

        .isolate-link:hover {
            text-decoration: underline;
        }

        .login-button {
            flex: 1;
            padding: 13px 20px;
            background: var(--gold);
            border: none;
            border-radius: 12px;
            color: var(--navy);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.92rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            cursor: pointer;
            box-shadow: none;
            transition: none;
        }


        .signup-button {
            flex: 1;
            padding: 13px 20px;
            background: var(--navy-light);
            border: none;
            border-radius: 12px;
            color: var(--white);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.92rem;
            font-weight: 600;
            cursor: pointer;
            transition: none;
        }


        .terms {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.82rem;
            color: var(--muted);
            margin-bottom: 0;
        }

        .terms input[type="checkbox"] { margin-top: 2px; }

        .terms a {
            color: var(--gold);
            text-decoration: none;
        }

        .error-message {
            color: var(--error);
            font-size: 0.82rem;
            margin-top: 5px;
            display: none;
        }

        .error-message.is-visible {
            display: block;
        }

        input.error {
            border-color: var(--error);
        }

        /* responsive */
        @media (max-width: 640px) {
            .login-card { flex-direction: column; max-width: 420px; }
            .left-panel { width: 100%; min-height: 200px; padding: 36px 28px; }
            .left-panel::after { display: none; }
            .right-panel { padding: 36px 28px; }
            .btn-row { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="login-card">
        <!-- LEFT PANEL -->
        <div class="left-panel">
            <div class="panel-circle panel-circle-1"></div>
            <div class="panel-circle panel-circle-2"></div>
            <div class="panel-circle panel-circle-3"></div>

            <p class="panel-welcome">Welcome to</p>

            <div style="width:72px; height:72px; margin:0 auto 18px; display:flex; align-items:center; justify-content:center;">
                <img src="{{ asset('images/logo.png') }}" alt="SmartRoom Logo" style="width:72px; height:72px; border-radius:16px; background:#fff; object-fit:cover; box-shadow:0 2px 8px rgba(0,0,0,0.08);" />
            </div>

            <div class="panel-brand">Smart<span class="accent">Room</span></div>

            <p class="panel-tagline">Your intelligent space management platform for seamless access and control.</p>

        </div>

        <!-- RIGHT PANEL -->
        <div class="right-panel">
            <h1 class="form-title">Sign In</h1>
            <p class="form-subtitle">Access your SmartRoom account</p>

            @if (session('status'))
                <div style="margin-bottom:12px;padding:10px 12px;border:1px solid #bbf7d0;background:#f0fdf4;color:#166534;border-radius:8px;font-size:0.82rem;">
                    {{ session('status') }}
                </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('auth.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
                        <span class="input-icon">✓</span>
                    </div>
                    <div class="error-message {{ $errors->has('email') ? 'is-visible' : '' }}" id="emailError">
                        {{ $errors->first('email') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" placeholder="•••••••••" required>
                        <span class="input-icon">✓</span>
                    </div>
                    <div class="error-message {{ $errors->has('password') ? 'is-visible' : '' }}" id="passwordError">
                        {{ $errors->first('password') }}
                    </div>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                </div>

                <div class="btn-row">
                    <button type="submit" class="login-button">Sign In</button>
                    <button type="button" id="signupButton" class="signup-button" data-signup-url="{{ route('auth.signup') }}">Create Account</button>
                </div>

                <a id="isolatedTabLink" class="isolate-link" href="#" target="_blank" rel="noopener noreferrer" style="display:none;">
                    Open isolated tab for another account
                </a>

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms">By signing in, I agree with the <a href="#">Terms &amp; Conditions</a></label>
                </div>
            </form>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const signupButton = document.getElementById('signupButton');
        const isolatedTabLink = document.getElementById('isolatedTabLink');

        if (signupButton) {
            signupButton.addEventListener('click', () => {
                const signupUrl = signupButton.getAttribute('data-signup-url');
                if (signupUrl) {
                    window.location.href = signupUrl;
                }
            });
        }

        if (isolatedTabLink) {
            const host = window.location.hostname;
            let alternateHost = '';

            if (host === '127.0.0.1') {
                alternateHost = 'localhost';
            } else if (host === 'localhost') {
                alternateHost = '127.0.0.1';
            }

            if (alternateHost !== '') {
                const isolatedUrl = `${window.location.protocol}//${alternateHost}:${window.location.port || '8000'}${window.location.pathname}`;
                isolatedTabLink.href = isolatedUrl;
                isolatedTabLink.style.display = 'inline-flex';
            }
        }

        if (loginForm && emailInput && passwordInput) {
            loginForm.addEventListener('submit', (e) => {
            document.querySelectorAll('.error-message').forEach(el => { el.textContent = ''; el.style.display = 'none'; });
            [emailInput, passwordInput].forEach(el => el.classList.remove('error'));

            const email = emailInput.value.trim();
            const password = passwordInput.value;
            let hasError = false;

            if (!email) {
                showError('emailError', 'Email is required');
                emailInput.classList.add('error');
                hasError = true;
            } else if (!isValidEmail(email)) {
                showError('emailError', 'Please enter a valid email');
                emailInput.classList.add('error');
                hasError = true;
            }

            if (!password) {
                showError('passwordError', 'Password is required');
                passwordInput.classList.add('error');
                hasError = true;
            }

                if (hasError) {
                    e.preventDefault();
                }
            });
        }

        function showError(elementId, message) {
            const errorEl = document.getElementById(elementId);
            errorEl.textContent = message;
            errorEl.style.display = 'block';
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }
    </script>
</body>
</html>