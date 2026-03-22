<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Taskora Project Management</title>
    
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
        
        .reset-container {
            width: 100%;
            max-width: 450px;
        }
        
        .reset-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 40px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .reset-card:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }
        
        .reset-header {
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
        
        .reset-header h1 {
            font-size: 28px;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .reset-header p {
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
            color: #6b7280;
            font-size: 16px;
            padding: 5px;
            transition: color 0.2s;
            z-index: 10;
        }

        .toggle-password:hover {
            color: #3b82f6;
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
        
        @media (max-width: 480px) {
            .reset-card {
                padding: 30px;
            }
            
            .reset-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <!-- Reset Password Card -->
        <div class="reset-card">
            <!-- Logo/Branding Header -->
            <div class="reset-header">
                <div class="logo">
                    <img src="{{ asset('images/Taskora Logo.png') }}" alt="Taskora Logo">
                </div>
                <h1>Reset Password</h1>
                <p>Enter your new password below</p>
            </div>
            
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
            
            <!-- Reset Password Form -->
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                
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
                        value="{{ old('email', $request->email) }}"
                        placeholder="your.email@example.com"
                        required 
                        autofocus
                    >
                </div>
                
                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock" style="color: #3b82f6; margin-right: 6px;"></i>
                        New Password
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
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Confirm Password Input -->
                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fas fa-lock" style="color: #3b82f6; margin-right: 6px;"></i>
                        Confirm Password
                    </label>
                    <div class="password-group">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation"
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye" id="password_confirmation-icon"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i>
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
