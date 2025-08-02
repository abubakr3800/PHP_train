<!-- Use the main layout -->
@extends('layouts.app')

<!-- Define the main content -->
@section('content')
<div class="container text-center py-5">
    <h1 class="mb-4">Dashboard</h1>
    <!-- Display the logged-in user's name -->
    <p class="lead">Welcome, !</p>
    <!-- Link to manage articles -->
    <a href="/articles" class="btn btn-primary">Manage My Articles</a>
</div>
@endsection