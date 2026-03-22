<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password - Taskora Project Management</title>
    
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
        
        .change-password-container {
            width: 100%;
            max-width: 450px;
        }
        
        .change-password-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 40px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .change-password-card:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }
        
        .change-header {
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
        
        .change-header h1 {
            font-size: 28px;
            color: #0f172a;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .change-header p {
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
        
        input[type="password"] {
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
        
        input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: #f8faff;
        }
        
        input[type="password"]:hover {
            border-color: #d1d5db;
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
        
        .success-message {
            background-color: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .success-message i {
            color: #22c55e;
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
            .change-password-card {
                padding: 30px;
            }
            
            .change-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="change-password-container">
        <!-- Change Password Card -->
        <div class="change-password-card">
            <!-- Logo/Branding Header -->
            <div class="change-header">
                <div class="logo">
                    <img src="{{ asset('images/Taskora Logo.png') }}" alt="Taskora Logo">
                </div>
                <h1>Change Password</h1>
                <p>Update your password securely</p>
            </div>
            
            <!-- Success Message -->
            @if (session('status') === 'password-updated')
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <div>Password updated successfully!</div>
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
            
            <!-- Change Password Form -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')
                
                <!-- Current Password -->
                <div class="form-group">
                    <label for="current_password">
                        <i class="fas fa-lock" style="color: #3b82f6; margin-right: 6px;"></i>
                        Current Password
                    </label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        placeholder="Enter your current password"
                        required
                        autocomplete="current-password"
                    >
                </div>
                
                <!-- New Password -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-key" style="color: #3b82f6; margin-right: 6px;"></i>
                        New Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your new password"
                        required
                        autocomplete="new-password"
                    >
                </div>
                
                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fas fa-check-circle" style="color: #3b82f6; margin-right: 6px;"></i>
                        Confirm New Password
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Confirm your new password"
                        required
                        autocomplete="new-password"
                    >
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check"></i>
                    Update Password
                </button>
            </form>
            
            <!-- Back Link -->
            <a href="{{ route('dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>
