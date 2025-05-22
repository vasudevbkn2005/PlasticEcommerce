@extends('layouts.main')

@section('content')
    <style>
        /* Profile container styling */
.profile-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 30px;
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fa;
}

/* Header styling */
.header {
    text-align: center;
    margin-bottom: 30px;
}

.header h2 {
    font-size: 2rem;
    color: #333;
    font-weight: 600;
    margin-bottom: 10px;
    border-bottom: 2px solid #007BFF;
    display: inline-block;
    padding-bottom: 5px;
}

/* Profile content section */
.profile-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Card styling */
.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border: 1px solid #ddd;
}

/* Section title styling */
.section-title {
    font-size: 1.5rem;
    color: #007BFF;
    font-weight: 500;
    margin-bottom: 10px;
}

/* Card content padding */
.card-content {
    margin-top: 10px;
}

/* Form inputs */
input[type="text"], input[type="email"], input[type="password"], textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 1rem;
    color: #333;
    background-color: #f9f9f9;
    box-sizing: border-box;
}

input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, textarea:focus {
    border-color: #007BFF;
    outline: none;
}

/* Buttons */
button {
    padding: 10px 20px;
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .profile-container {
        padding: 15px;
    }

    .card {
        padding: 15px;
    }
}

    </style>

    <div class="profile-container">
        <div class="header">
            <h2>Profile</h2>
        </div>

        <div class="profile-content">
            <!-- Profile Information Section -->
            <div class="card">
                <div class="card-content">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="card">
                <div class="card-content">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Account Deletion Section -->
            <div class="card">
                <div class="card-content" style="color: red">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
