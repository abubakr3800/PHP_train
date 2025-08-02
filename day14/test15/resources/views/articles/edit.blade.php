<!-- Use the main layout -->
@extends('layouts.app')

<!-- Define the main content -->
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Article</h2>
    
    <!-- Form to update existing article -->
    <form method="POST" action="{{ route('articles.update', $article) }}">
        @csrf <!-- CSRF protection token -->
        @method('PUT') <!-- Override method to PUT for updates -->
        
        <!-- Title input field with current value -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
        </div>
        
        <!-- Body textarea field with current value -->
        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="5" required>{{ $article->body }}</textarea>
        </div>
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Update Article</button>
    </form>
</div>
@endsection