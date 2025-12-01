<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vanisha Bakery</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Quicksand", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #111;
            width: 100%;
            overflow: hidden;
        }

        /* Alert Notification */
        .alert {
            position: fixed;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.4);
            animation: slideDown 0.5s ease-out;
            z-index: 9999;
            max-width: 500px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .alert-error {
            background: linear-gradient(135deg, #FF4F0F, #DC2525);
            color: white;
        }

        .alert-success {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
        }

        .ring {
            position: relative;
            width: 500px;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;   
        }

        .ring i {
            position: absolute;
            inset: 0;
            border: 2px solid #fff;
            transition: 0.5s;
        }

        .ring i:nth-child(1) {
            border-radius: 38% 62% 63% 37% / 41% 44% 56% 59%;
            animation: animate 6s linear infinite;
        }

        .ring i:nth-child(2) {
            border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
            animation: animate 4s linear infinite;
        }

        .ring i:nth-child(3) {
            border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
            animation: animate2 10s linear infinite;
        }

        .ring:hover i {
            border: 6px solid var(--clr);
            filter: drop-shadow(0 0 20px var(--clr));
        }

        @keyframes animate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes animate2 {
            0% {
                transform: rotate(360deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        .login {
            position: absolute;
            width: 320px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
        }

        .login h2 {
            font-size: 2.2em;
            color: #fff;
            margin-bottom: 10px;
        }

        .login .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1em;
            margin-bottom: 15px;
        }

        .login .inputBx {
            position: relative;
            width: 100%;
        }

        .login .inputBx input {
            position: relative;
            width: 100%;
            padding: 14px 20px;
            background: transparent;
            border: 2px solid #fff;
            border-radius: 40px;
            font-size: 1.1em;
            color: #fff;
            box-shadow: none;
            outline: none;
            transition: all 0.3s;
        }

        .login .inputBx input:focus {
            border-color: #FFF287;
            box-shadow: 0 0 15px rgba(255, 242, 135, 0.5);
        }

        .login .inputBx input.error {
            border-color: #DC2525;
            animation: shake 0.4s;
        }

        .login .inputBx input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .login .inputBx input[type="submit"] {
            width: 100%;
            background: linear-gradient(45deg, #FF4F0F, #FFF287);
            border: none;
            cursor: pointer;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .login .inputBx input[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 79, 15, 0.5);
        }

        .login .inputBx input[type="submit"]:active {
            transform: translateY(0);
        }

        .login .checkbox-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 10px;
        }

        .login .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #FFF287;
        }

        .login .checkbox-wrapper label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95em;
            cursor: pointer;
        }

        .login .links {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .login .links a {
            color: #FFF287;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login .links a:hover {
            color: #fff;
        }

        .error-message {
            color: #FF6B6B;
            background: rgba(255, 79, 15, 0.1);
            border: 1px solid rgba(255, 79, 15, 0.3);
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            margin-top: 5px;
            text-align: center;
        }

        /* Google Button */
        .google-btn {
            width: 100%;
            padding: 14px 20px;
            background: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            font-weight: 600;
            font-size: 1em;
            color: #333;
        }

        .google-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
            border-color: #FFF287;
        }

        .divider {
            width: 100%;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9em;
            margin: 5px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: rgba(255, 255, 255, 0.3);
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .ring {
                width: 400px;
                height: 400px;
            }

            .login {
                width: 280px;
            }

            .login h2 {
                font-size: 1.8em;
            }
        }

        @media (max-width: 480px) {
            .ring {
                width: 350px;
                height: 350px;
            }

            .login {
                width: 260px;
            }

            .login h2 {
                font-size: 1.6em;
            }

            .login .inputBx input {
                padding: 12px 18px;
                font-size: 1em;
            }

            .google-btn {
                padding: 12px 18px;
                font-size: 0.95em;
            }
        }
    </style>
</head>
<body>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="alert alert-error" id="errorAlert">
            <span style="font-size: 24px;">❌</span>
            <span>{{ $errors->first() }}</span>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('errorAlert');
                if(el) {
                    el.style.animation = 'slideDown 0.5s ease-out reverse';
                    setTimeout(() => el.remove(), 500);
                }
            }, 5000);
        </script>
    @endif

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success" id="successAlert">
            <span style="font-size: 24px;">✅</span>
            <span>{{ session('success') }}</span>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('successAlert');
                if(el) {
                    el.style.animation = 'slideDown 0.5s ease-out reverse';
                    setTimeout(() => el.remove(), 500);
                }
            }, 5000);
        </script>
    @endif

    @if(session('error'))
        <div class="alert alert-error" id="errorSessionAlert">
            <span style="font-size: 24px;">❌</span>
            <span>{{ session('error') }}</span>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('errorSessionAlert');
                if(el) {
                    el.style.animation = 'slideDown 0.5s ease-out reverse';
                    setTimeout(() => el.remove(), 500);
                }
            }, 5000);
        </script>
    @endif

    <div class="ring">
        <i style="--clr:#FF4F0F"></i>
        <i style="--clr:#DC2525"></i>
        <i style="--clr:#FFF287;"></i>
        
        <div class="login">
            <h2>Login</h2>
            <p class="subtitle">Vanisha Bakery</p>
            
            <form method="POST" action="{{ route('login') }}" style="width: 100%; display: flex; flex-direction: column; gap: 20px;">
                @csrf

                <!-- Email Input -->
                <div class="inputBx">
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email Address"
                        class="@error('email') error @enderror"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="inputBx">
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password"
                        class="@error('password') error @enderror"
                        required
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="checkbox-wrapper">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <!-- Submit Button -->
                <div class="inputBx">
                    <input type="submit" value="Sign In">
                </div>

                <!-- Divider -->
                <div class="divider">atau</div>

                <!-- Google Login Button -->
                <a href="{{ route('auth.google') }}" class="google-btn">
                    <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.64 9.20454C17.64 8.56636 17.5827 7.95273 17.4764 7.36364H9V10.845H13.8436C13.635 11.97 13.0009 12.9232 12.0477 13.5614V15.8195H14.9564C16.6582 14.2527 17.64 11.9454 17.64 9.20454Z" fill="#4285F4"/>
                        <path d="M9 18C11.43 18 13.4673 17.1941 14.9564 15.8195L12.0477 13.5614C11.2418 14.1014 10.2109 14.4204 9 14.4204C6.65591 14.4204 4.67182 12.8373 3.96409 10.71H0.957275V13.0418C2.43818 15.9832 5.48182 18 9 18Z" fill="#34A853"/>
                        <path d="M3.96409 10.71C3.78409 10.17 3.68182 9.59318 3.68182 9C3.68182 8.40682 3.78409 7.83 3.96409 7.29V4.95818H0.957275C0.347727 6.17318 0 7.54773 0 9C0 10.4523 0.347727 11.8268 0.957275 13.0418L3.96409 10.71Z" fill="#FBBC05"/>
                        <path d="M9 3.57955C10.3214 3.57955 11.5077 4.03364 12.4405 4.92545L15.0218 2.34409C13.4632 0.891818 11.4259 0 9 0C5.48182 0 2.43818 2.01682 0.957275 4.95818L3.96409 7.29C4.67182 5.16273 6.65591 3.57955 9 3.57955Z" fill="#EA4335"/>
                    </svg>
                    <span>Masuk dengan Google</span>
                </a>

                <!-- Links -->
                <div class="links">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                    <a href="{{ route('register') }}">Sign Up</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
