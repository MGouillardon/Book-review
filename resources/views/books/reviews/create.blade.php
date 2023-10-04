@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <a href="{{ route('books.show', $book) }}" class="btn"><- Back to the book</a>
    </div>
    <h1 class="mb-10 text-2xl">Add Reviews for {{ $book->title }}</h1>

    <form method="POST" action="{{ route('books.reviews.store', $book) }}">
        @csrf
        <label for="review">Review</label>
        <textarea name="review" id="review" required class="input mb-4"></textarea>
        @error('review')
            <p class="text-red-500 text-xs mb-4">{{ $message }}</p>
        @enderror
        <label for="rating">Rating</label>
        <select name="rating" id="rating" class="input mb-4" required>
            <option value="">Select a rating</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        @error('rating')
            <p class="text-red-500 text-xs mb-4">{{ $message }}</p>
        @enderror
        <button type="submit" class="btn">Add Review</button>
    </form>
@endsection
