<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign Up – SmartRoom</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
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

        .signup-container {
            position: relative;
            z-index: 10;
            width: 90%;
            max-width: 480px;
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

        .signup-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(40px) saturate(1.5);
            border: 1px solid rgba(245,197,24,0.15);
            border-radius: 24px;
            padding: 48px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 1px rgba(255,255,255,0.1);
        }

        .signup-header {
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

        .signup-title {
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

        .signup-subtitle {
            font-size: 0.95rem;
            color: var(--muted);
            font-weight: 400;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--white);
            letter-spacing: 0.3px;
        }

        input,
        select {
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

        select {
            cursor: pointer;
        }

        select option {
            background: var(--navy);
            color: var(--white);
        }

        input:focus,
        select:focus {
            background: rgba(255,255,255,0.1);
            border-color: rgba(245,197,24,0.35);
            box-shadow: 0 0 0 3px rgba(245,197,24,0.1);
        }

        .password-requirements {
            margin-top: 12px;
            padding: 12px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(245,197,24,0.1);
            border-radius: 8px;
            font-size: 0.8rem;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 4px 0;
            color: var(--muted);
            transition: color 0.3s;
        }

        .requirement::before {
            content: '○';
            color: rgba(245,197,24,0.4);
            font-weight: bold;
            width: 12px;
        }

        .requirement.met {
            color: var(--success);
        }

        .requirement.met::before {
            content: '✓';
            color: var(--success);
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
            font-size: 0.85rem;
            color: var(--muted);
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: var(--gold);
            flex-shrink: 0;
        }

        .terms-text a {
            color: var(--gold);
            text-decoration: none;
            font-weight: 500;
        }

        .signup-button {
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

        .signup-button:active {
            transform: translateY(0);
        }

        .signup-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .login-link {
            text-align: center;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .login-link a {
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

        @media (max-width: 480px) {
            .signup-card {
                padding: 32px 24px;
                border-radius: 20px;
            }

            .signup-title {
                font-size: 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-card">
            <div class="signup-header">
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{ asset('images/logo.png') }}" alt="SmartRoom Logo" class="brand-icon">
                    <span class="brand-name">Smart<span class="door-accent">Door</span></span>
                </a>
                <h1 class="signup-title">Get Started</h1>
                <p class="signup-subtitle">Create your SmartRoom account in seconds</p>
            </div>

            <form id="signupForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="John" required>
                        <div class="error-message" id="firstNameError"></div>
                    </div>

                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Doe" required>
                        <div class="error-message" id="lastNameError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                    <div class="error-message" id="emailError"></div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="•••••••••" required>
                    <div class="error-message" id="passwordError"></div>
                    <div class="password-requirements">
                        <div class="requirement" id="reqLength">
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement" id="reqUppercase">
                            <span>One uppercase letter</span>
                        </div>
                        <div class="requirement" id="reqNumber">
                            <span>One number</span>
                        </div>
                        <div class="requirement" id="reqSpecial">
                            <span>One special character</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="•••••••••" required>
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>

                <label class="terms-checkbox">
                    <input type="checkbox" name="terms" required>
                    <div class="terms-text">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </div>
                </label>

                <button type="submit" class="signup-button">Create Account</button>

                <div class="login-link">
                    Already have an account? <a href="/login">Sign in</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const signupForm = document.getElementById('signupForm');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        // Password strength validation
        passwordInput.addEventListener('input', validatePassword);

        function validatePassword() {
            const password = passwordInput.value;

            updateRequirement('reqLength', password.length >= 8);
            updateRequirement('reqUppercase', /[A-Z]/.test(password));
            updateRequirement('reqNumber', /[0-9]/.test(password));
            updateRequirement('reqSpecial', /[!@#$%^&*(),.?":{}|<>]/.test(password));
        }

        function updateRequirement(id, isMet) {
            const element = document.getElementById(id);
            if (isMet) {
                element.classList.add('met');
            } else {
                element.classList.remove('met');
            }
        }

        signupForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]').forEach(el => el.classList.remove('error'));

            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            const termsCheckbox = document.querySelector('input[name="terms"]');

            let hasError = false;

            // Validation
            if (!firstName) {
                showError('firstNameError', 'First name is required');
                document.getElementById('firstName').classList.add('error');
                hasError = true;
            }

            if (!lastName) {
                showError('lastNameError', 'Last name is required');
                document.getElementById('lastName').classList.add('error');
                hasError = true;
            }

            if (!email) {
                showError('emailError', 'Email is required');
                document.getElementById('email').classList.add('error');
                hasError = true;
            } else if (!isValidEmail(email)) {
                showError('emailError', 'Please enter a valid email');
                document.getElementById('email').classList.add('error');
                hasError = true;
            }

            if (!password) {
                showError('passwordError', 'Password is required');
                passwordInput.classList.add('error');
                hasError = true;
            } else if (!isValidPassword(password)) {
                showError('passwordError', 'Password does not meet requirements');
                passwordInput.classList.add('error');
                hasError = true;
            }

            if (password !== confirmPassword) {
                showError('confirmPasswordError', 'Passwords do not match');
                confirmPasswordInput.classList.add('error');
                hasError = true;
            }

            if (!termsCheckbox.checked) {
                showError('firstNameError', 'You must agree to the terms');
                hasError = true;
            }

            if (hasError) return;

            try {
                // Replace with actual API endpoint
                const response = await fetch('/api/signup', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        firstName,
                        lastName,
                        email,
                        password
                    })
                });

                if (response.ok) {
                    window.location.href = '/login?success=true';
                } else {
                    const data = await response.json();
                    showError('emailError', data.message || 'Sign up failed');
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

        function isValidPassword(password) {
            return password.length >= 8 &&
                   /[A-Z]/.test(password) &&
                   /[0-9]/.test(password) &&
                   /[!@#$%^&*(),.?":{}|<>]/.test(password);
        }
    </script>
</body>
</html>
