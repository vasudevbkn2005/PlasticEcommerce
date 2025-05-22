@extends('layouts.main')
@section('content')
    <style>
        body {
            background: linear-gradient(to right, #e0ecff, #f4f9ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .reset-password-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            min-height: 100vh;
        }

        .reset-password-card {
            background-color: #fff;
            width: 100%;
            max-width: 420px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }

        .reset-password-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.15);
        }

        .reset-password-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .reset-password-header h2 {
            font-size: 2rem;
            color: #2c3e50;
            font-weight: 700;
            margin: 0;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #007BFF;
            outline: none;
            background-color: #fff;
        }

        .form-group label {
            position: absolute;
            top: -10px;
            left: 12px;
            background: #fff;
            padding: 0 5px;
            font-size: 0.8rem;
            color: #007BFF;
        }

        .btn-reset {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-reset:hover {
            background-color: #0056b3;
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-login a {
            color: #007BFF;
            text-decoration: none;
        }

        .back-to-login a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="reset-password-wrapper">
        <div class="reset-password-card">
            <div class="reset-password-header">
                <h2>Reset Your Password</h2>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <button type="submit" class="btn-reset">
                    {{ __('Email Password Reset Link') }}
                </button>
            </form>

            <div class="back-to-login">
                <p>Remember your password? <a href="{{ route('login') }}">Back to Login</a></p>
            </div>
        </div>
    </div>
@endsection
