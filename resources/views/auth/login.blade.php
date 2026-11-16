<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Taskora Project Management</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
        }
        
        .login-card {
            background: #000000;
            border: 1px solid #1f2937;
            border-radius: 16px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.8);
            padding: 40px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .login-card:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.95);
            border-color: #374151;
            transform: translateY(-2px);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #1f2937;
        }
        
        .logo {
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            padding: 0;
            width: auto;
        }
        
        .logo a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: transform 0.2s ease;
        }

        .logo a:hover {
            transform: scale(1.03);
        }
        
        .logo img {
            max-width: 220px;
            max-height: 80px;
            height: auto;
            width: auto;
            object-fit: contain;
            display: block;
        }
        
        .login-header h1 {
            font-size: 28px;
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .login-header p {
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #ffffff;
        }
        
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            background-color: #111827;
            border: 1.5px solid #374151;
            border-radius: 8px;
            font-size: 14px;
            color: #ffffff;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            font-family: inherit;
            box-sizing: border-box;
            display: block;
        }
        
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        input[type="text"]::placeholder {
            color: #6b7280;
        }
        
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            background-color: #1f2937;
            color: #ffffff;
        }
        
        input[type="email"]:hover,
        input[type="password"]:hover,
        input[type="text"]:hover {
            border-color: #4b5563;
        }
        
        .password-group {
            position: relative;
            display: block;
            width: 100%;
            height: 48px;
        }
        
        .password-group input {
            width: 100% !important;
            height: 48px !important;
            padding: 12px 14px !important;
            box-sizing: border-box !important;
            line-height: 24px !important;
        }
        
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            font-size: 16px;
            padding: 0;
            margin: 0;
            width: 20px;
            height: 20px;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        
        .toggle-password i {
            transition: opacity 0.2s ease, transform 0.2s ease;
            display: block;
        }
        
        .toggle-password:hover {
            color: #60a5fa;
            transform: translateY(-50%) scale(1.1);
        }
        
        .toggle-password:active {
            transform: translateY(-50%) scale(0.95);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 13px;
        }
        
        .remember-checkbox {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            color: #e2e8f0;
        }
        
        input[type="checkbox"] {
            cursor: pointer;
            width: 16px;
            height: 16px;
            accent-color: #3b82f6;
            background-color: #111827;
            border: 1px solid #4b5563;
        }
        
        .forgot-link {
            color: #60a5fa;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .forgot-link:hover {
            color: #93c5fd;
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #94a3b8;
            font-size: 13px;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #374151;
        }
        
        .signup-prompt {
            text-align: center;
            color: #cbd5e1;
            font-size: 14px;
        }
        
        .signup-link {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .signup-link:hover {
            color: #93c5fd;
            text-decoration: underline;
        }
        
        .error-message {
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid #ef4444;
            color: #fca5a5;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .error-message i {
            color: #f87171;
        }
        

        @media (max-width: 480px) {
            .login-card {
                padding: 30px;
            }
            
            .login-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Login Card with Header -->
        <div class="login-card">
            <!-- Logo/Branding Header -->
            <div class="login-header">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('images/Taskora Logo.png') }}" alt="Taskora Logo">
                    </a>
                </div>
                <h1>Welcome Back</h1>
                <p>Sign in to your account and start managing your projects</p>
            </div>
            
            <!-- Error Messages -->
            @if (session('error'))
                <div class="error-message">
                    <i class="fas fa-circle-exclamation"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif
            @if ($errors->any())
                <div class="error-message">
                    <i class="fas fa-circle-exclamation"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope" style="color: #3b82f6; margin-right: 6px;"></i>
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        placeholder="your.email@example.com"
                        required 
                        autofocus
                    >
                </div>
                
                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock" style="color: #3b82f6; margin-right: 6px;"></i>
                        Password
                    </label>
                    <div class="password-group">
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Remember & Forgot -->
                <div class="remember-forgot">
                    <label class="remember-checkbox">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Forgot password?
                        </a>
                    @endif
                </div>
                
                <!-- Login Button -->
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>
            </form>
            
            <!-- Divider -->
            <div class="divider">or</div>
            
            <!-- Sign Up Link -->
            <div class="signup-prompt">
                Don't have an account?
                <a href="{{ route('register') }}" class="signup-link">
                    Create one now
                </a>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = event.target.closest('.toggle-password');
            const icon = button.querySelector('i');
            
            // Animate icon out
            icon.style.opacity = '0.3';
            icon.style.transform = 'scale(0.8)';
            
            setTimeout(() => {
                if (field.type === 'password') {
                    field.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    field.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
                
                // Animate icon back in
                icon.style.opacity = '1';
                icon.style.transform = 'scale(1)';
            }, 100);
        }
    </script>
</body>
</html>
