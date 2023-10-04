@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Books</h1>

    <form class="flex items-center gap-4 mb-4" method="get" action="{{ route('books.index') }}">
        <label for="title" class="sr-only">Search by title</label>
        <input class="input h-10" type="text" name="title" placeholder="Search by title" value="{{ request('title') }}">
        <input type="hidden" name="filter" value="{{ request('filter') }}">
        <button class="btn h-10" type="submit">Search</button>
        <a class="btn-clear h-10" href="{{ route('books.index') }}">Clear</a>
    </form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular last month',
                'popular_last_6months' => 'Popular last 6 months',
                'highest_rated_last_month' => 'Highest rated last month',
                'highest_rated_last_6months' => 'Highest rated last 6 months',
            ];
        @endphp

        @foreach ($filters as $filter => $label)
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $filter]) }}"
                class="filter-item {{ request('filter') === $filter || (request('filter') === null && $filter === '') ? 'filter-item-active' : '' }}"
                >{{ $label }}</a>
        @endforeach
    </div>

    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">by {{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                {{ number_format($book->reviews_avg_rating, 1) }}
                                <x-star-rating :rating="$book->reviews_avg_rating" />
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                    <div class="book-timestamp flex space-x-4">
                        <span>Created {{ $book->created_at->format('M j, Y') }}</span>
                        <span>Updated {{ $book->updated_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>

    <div class="mt-4">
        {{ $books->links('pagination::tailwind') }}
    </div>
@endsection
