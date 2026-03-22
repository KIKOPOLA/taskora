<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - Taskora Project Management</title>
    
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
        
        .forgot-container {
            width: 100%;
            max-width: 420px;
        }
        
        .forgot-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 40px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .forgot-card:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }
        
        .forgot-header {
            text-align: center;
            margin-bottom: 0;
            padding-bottom: 25px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .logo {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000;
            padding: 12px;
            border-radius: 10px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        
        .logo img {
            max-width: 220px;
            height: auto;
            object-fit: contain;
        }
        
        .forgot-header h1 {
            font-size: 28px;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .forgot-header p {
            color: #4b5563;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }
        
        .form-group {
            margin-bottom: 20px;
            margin-top: 24px;
        }
        
        .form-group:first-of-type {
            margin-top: 24px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }
        
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            font-family: inherit;
            box-sizing: border-box;
            display: block;
            height: auto;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: #f8faff;
        }

        input[type="email"]:hover,
        input[type="password"]:hover,
        input[type="text"]:hover {
        }

        .password-group {
            position: relative;
            display: block;
            width: 100%;
        }

        .password-group input {
            width: 100% !important;
            padding-right: 45px !important;
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
            color: #3b82f6;
            transform: translateY(-50%) scale(1.1);
        }

        .toggle-password:active {
            transform: translateY(-50%) scale(0.95);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
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
            margin-top: 24px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        }

        .btn-submit:active {
            transform: translateY(0);
        }
        
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 20px;
            text-align: center;
            color: #3b82f6;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: #1e40af;
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: #d1d5db;
            font-size: 13px;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e5e7eb;
        }
        
        .info-message {
            background-color: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .info-message i {
            color: #3b82f6;
            margin-top: 2px;
            flex-shrink: 0;
        }
        
        .error-message {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .error-message i {
            color: #dc2626;
        }
        
        .success-message {
            background-color: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .success-message i {
            color: #059669;
        }
        
        @media (max-width: 480px) {
            .forgot-card {
                padding: 30px;
            }
            
            .forgot-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <!-- Forgot Password Card -->
        <div class="forgot-card">
            <!-- Logo/Branding Header -->
            <div class="forgot-header">
                <div class="logo">
                    <img src="{{ asset('images/Taskora Logo.png') }}" alt="Taskora Logo">
                </div>
                <h1>Reset Password</h1>
                <p>Enter your email and new password to reset your account</p>
            </div>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('status') }}</div>
                </div>
            @endif
            
            <!-- Error Messages -->
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
            
            <!-- Info Message -->
            <div class="info-message">
                <i class="fas fa-info-circle"></i>
                <span>Reset your password directly by entering your email and new password below.</span>
            </div>
            
            <!-- Reset Password Form -->
            <form method="POST" action="{{ route('password.email') }}">
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
                
                <!-- New Password -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-key" style="color: #3b82f6; margin-right: 6px;"></i>
                        New Password
                    </label>
                    <div class="password-group">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your new password"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fas fa-check-circle" style="color: #3b82f6; margin-right: 6px;"></i>
                        Confirm New Password
                    </label>
                    <div class="password-group">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Confirm your new password"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye" id="password_confirmation-icon"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check"></i>
                    Reset Password
                </button>
            </form>
            
            <!-- Back to Login -->
            <a href="{{ route('login') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Login
            </a>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
