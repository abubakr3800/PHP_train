<!-- Use the main layout -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Articles</h1>

    @auth
        <a href="/articles/create" class="btn btn-primary mb-3">+ New Article</a>
    @endauth

    @foreach($articles as $article)
        <div class="card my-3">
            <div class="card-body">
                <h4> {{ $article->title }} </h4> <!-- Display article title -->
                <p>{{ \Illuminate\Support\Str::limit($article->body, 100) }} <a href="{{ route('articles.show', $article) }}" class="btn btn-link">Read More</a></p> <!-- Display article content -->
                <p class="text-muted">By {{ $article->user->name }} </p> <!-- Show author name -->

                @can('update', $article)
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                @endcan

                

                @can('delete', $article)
                    <form method="POST" action="{{ route('articles.destroy', $article) }}" class="d-inline">
                        @csrf <!-- CSRF protection token -->
                        @method('DELETE') <!-- Override method to DELETE -->
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endcan

            </div>
        </div>
    @endforeach
</div>
@endsection