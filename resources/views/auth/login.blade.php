@extends('layouts.main')
@section('content')
    <style>
        body {
            background: linear-gradient(to right, #e0ecff, #f4f9ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            min-height: 100vh;
        }

        .login-card {
            background-color: #fff;
            width: 100%;
            max-width: 420px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }

        .login-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.15);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
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

        .checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #333;
        }

        .checkbox input {
            margin-right: 8px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
        }

        .form-footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .btn-login {
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

        .btn-login:hover {
            background-color: #0056b3;
        }

        /* Style for the registration title */
        .registration-title {
            font-size: 2rem;
            /* Make the text size bigger for prominence */
            font-weight: 700;
            /* Bold text */
            text-align: center;
            /* Center the title */
            color: #023e8a;
            /* Dark blue color */
            text-transform: uppercase;
            /* All letters in uppercase */
            letter-spacing: 1px;
            /* Slight letter spacing for better readability */
            margin-bottom: 20px;
            /* Add some space below the title */
            position: relative;
        }

        /* Style for the span inside the registration-title */
        .register-text {
            display: block;
            /* Move "Please Register First!" to the next line */
            color: #00B4D8;
            /* Light blue color to make it stand out */
            font-weight: 600;
            /* Semi-bold font for the span */
            font-size: 1.2rem;
            /* Slightly smaller font size for the span */
            margin-top: 10px;
            /* Add some space between the two lines */
        }

        /* Underline effect using a pseudo-element */
        .registration-title:before {
            content: '';
            position: absolute;
            width: 60px;
            /* Width of the underline */
            height: 3px;
            /* Thickness of the underline */
            /* background-color: #00B4D8; */
            /* Color of the underline */
            top: 50%;
            /* Center it vertically */
            left: 50%;
            /* Center it horizontally */
            transform: translateX(-50%) translateY(-50%);
            /* Center it precisely */
        }
    </style>

    <div class="login-wrapper">
        <div class="login-card">
            <h3 class="registration-title">Haven't Registered Yet?
                <span class="register-text">Please Register First!</span>
            </h3>


            <div class="login-header">
                <h2>Welcome Back</h2>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Remember Me -->
                <div class="checkbox">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">{{ __('Remember me') }}</label>
                </div>

                <!-- Forgot password and Login button -->
                <div class="form-footer mb-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    {{ __('Log in') }}
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
