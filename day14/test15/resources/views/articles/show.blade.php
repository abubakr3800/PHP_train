
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    <p class="text-muted">By {{ $article->user->name }} | {{ $article->created_at->format('M d, Y') }}</p>

    <div class="mt-4">
        <p>{{ $article->content }}</p>
    </div>

    <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-3">← Back to Articles</a>
</div>
@endsection