@extends('layouts.main')
@section('content')
    <style>
        body {
            background: linear-gradient(to right, #e0ecff, #f4f9ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            min-height: 100vh;
        }

        .register-card {
            background-color: #fff;
            width: 100%;
            max-width: 520px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }

        .register-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.15);
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            font-size: 2rem;
            color: #2c3e50;
            font-weight: 700;
            margin: 0;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
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

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
        }

        .form-footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .btn-register {
            padding: 12px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-register:hover {
            background-color: #0056b3;
        }

        .error-text {
            color: red;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        /* Style for the register header */
        .register-header h2 {
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

        /* Style for the span inside the register-header */
        .register-subtext {
            display: block;
            /* Move "Now to Get Started" to the next line */
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
        .register-header h2:before {
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

    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-header">
                <h2>Register <span class="register-subtext">Now to Get Started</span></h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="error-text" />
                </div>

                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required />
                    <x-input-error :messages="$errors->get('email')" class="error-text" />
                </div>

                <div class="form-group">
                    <label for="mobile">{{ __('Mobile') }}</label>
                    <input id="mobile" type="tel" name="mobile" value="{{ old('mobile') }}" required />
                    <x-input-error :messages="$errors->get('mobile')" class="error-text" />
                </div>

                <div class="form-group">
                    <label for="address">{{ __('Address') }}</label>
                    <input id="address" type="text" name="address" value="{{ old('address') }}" required />
                    <x-input-error :messages="$errors->get('address')" class="error-text" />
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="error-text" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-text" />
                </div>

                <div class="form-footer mt-4">
                    <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                    <button type="submit" class="btn-register">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
