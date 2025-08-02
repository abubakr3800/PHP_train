<!-- Use the main layout -->
@extends('layouts.app')

<!-- Define the main content -->
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Login form -->
            <form method="POST" action="">
                @csrf <!-- CSRF protection token -->

                <!-- Email input field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" value="" class="form-control" required autofocus>
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

                <!-- Remember me checkbox -->
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection