<!-- Use the main layout -->
@extends('layouts.app')

<!-- Define the main content -->
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Register</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Registration form -->
            <form method="POST" action="">
                @csrf <!-- CSRF protection token -->

                <!-- Full name input field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" value="" class="form-control" required autofocus>
                    <!-- Display validation errors for name -->
                    @error('name')
                        <div class="text-danger mt-1"></div>
                    @enderror
                </div>

                <!-- Email input field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" value="" class="form-control" required>
                    <!-- Display validation errors for email -->
                    @error('email')
                        <div class="text-danger mt-1"></div>
                    @enderror
                </div>

                <!-- Password input field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <!-- Display validation errors for password -->
                    @error('password')
                        <div class="text-danger mt-1"></div>
                    @enderror
                </div>

                <!-- Password confirmation field -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-success w-100">Create Account</button>
            </form>
        </div>
    </div>
</div>
@endsection