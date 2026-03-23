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

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            color: var(--white);
            overflow: hidden;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── NOISE TEXTURE OVERLAY ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.35;
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 90%;
            max-width: 420px;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(40px) saturate(1.5);
            border: 1px solid rgba(245,197,24,0.15);
            border-radius: 24px;
            padding: 48px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 1px rgba(255,255,255,0.1);
        }

        .login-header {
            margin-bottom: 32px;
            text-align: center;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0 auto 16px;
            text-decoration: none;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: block;
            object-fit: contain;
            object-position: center;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(245,197,24,0.25);
        }

        .brand-name {
            font-family: 'Space Grotesk', 'Sora', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: -0.02em;
        }

        .brand-name .door-accent {
            color: var(--gold);
        }

        .login-title {
            font-family: 'Space Grotesk', 'Sora', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.02em;
            background: linear-gradient(90deg, var(--white) 0%, var(--gold-pale) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            font-size: 0.95rem;
            color: var(--muted);
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--white);
            letter-spacing: 0.3px;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(245,197,24,0.12);
            border-radius: 12px;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
        }

        input::placeholder {
            color: rgba(255,255,255,0.35);
        }

        input:focus {
            background: rgba(255,255,255,0.1);
            border-color: rgba(245,197,24,0.35);
            box-shadow: 0 0 0 3px rgba(245,197,24,0.1);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 0.85rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--gold);
        }

        .forgot-password {
            color: var(--gold);
            text-decoration: none;
            font-weight: 500;
        }

        .login-button {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--gold-pale) 100%);
            border: none;
            border-radius: 12px;
            color: var(--navy);
            font-family: 'Space Grotesk', 'Sora', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            margin-bottom: 16px;
            box-shadow: 0 4px 15px rgba(245,197,24,0.25);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .signup-link {
            text-align: center;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .signup-link a {
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
        }

        .error-message {
            color: var(--error);
            font-size: 0.85rem;
            margin-top: 6px;
            display: none;
        }

        input.error {
            border-color: var(--error);
            background: rgba(255, 107, 107, 0.05);
        }

        .divider {
            text-align: center;
            margin: 24px 0;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .divider::before,
        .divider::after {
            content: '';
            display: inline-block;
            width: 50px;
            height: 1px;
            background: rgba(245,197,24,0.15);
            margin: 0 12px;
            vertical-align: middle;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
                border-radius: 20px;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .remember-forgot {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{ asset('images/logo.png') }}" alt="SmartRoom Logo" class="brand-icon">
                    <span class="brand-name">Smart<span class="door-accent">Door</span></span>
                </a>
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to your SmartRoom account</p>
            </div>

            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                    <div class="error-message" id="emailError"></div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="•••••••••" required>
                    <div class="error-message" id="passwordError"></div>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="login-button">Sign In</button>

                <div class="signup-link">
                    Don't have an account? <a href="/signup">Create one</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            document.querySelectorAll('input').forEach(el => el.classList.remove('error'));

            const email = emailInput.value.trim();
            const password = passwordInput.value;

            let hasError = false;

            // Validation
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

            if (hasError) return;

            try {
                // Replace with actual API endpoint
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email, password })
                });

                if (response.ok) {
                    window.location.href = '/dashboard';
                } else {
                    const data = await response.json();
                    showError('emailError', data.message || 'Login failed');
                }
            } catch (error) {
                showError('emailError', 'An error occurred. Please try again.');
            }
        });

        function showError(elementId, message) {
            const errorEl = document.getElementById(elementId);
            errorEl.textContent = message;
            errorEl.style.display = 'block';
        }

        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // Add focus effects
        [emailInput, passwordInput].forEach(input => {
            input.addEventListener('focus', () => {
                document.querySelectorAll('input').forEach(el => {
                    if (el !== input) {
                        el.style.background = 'rgba(255,255,255,0.04)';
                    }
                });
                input.style.background = 'rgba(255,255,255,0.1)';
            });

            input.addEventListener('blur', () => {
                document.querySelectorAll('input').forEach(el => {
                    el.style.background = 'rgba(255,255,255,0.06)';
                });
            });
        });
    </script>
</body>
</html>
