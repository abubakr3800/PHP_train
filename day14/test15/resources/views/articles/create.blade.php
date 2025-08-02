<!-- Use the main layout -->
@extends('layouts.app')

<!-- Define the main content -->
@section('content')
<div class="container">
    <h2 class="mb-4">Create New Article</h2>
    
    <!-- Form to create new article -->
    <form method="POST" action="{{ route('articles.store') }}">
        @csrf <!-- CSRF protection token -->
        @method('POST')
        <!-- Title input field -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="" required>
        </div>
        
        <!-- Body textarea field -->
        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="5" required></textarea>
        </div>
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-success">Save Article</button>
    </form>
</div>
@endsection