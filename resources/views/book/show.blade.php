@extends('layout.main')

@section('page_title')
    {{ $book->title }}
@endsection

@section('main')
    <main class="main p-5">
        <div class="w-full flex gap-5 flex-col md:flex-row">
            <img src="{{ asset('images/' . ($book->image ?? 'book_default.png')) }}" alt="Book's image"
                 class="rounded-normal shadow-xl">
            <div class="w-full px-5 py-10 flex flex-col items-center md:items-start gap-4">
                <h1 class="title w-full font-bold text-xl text-center md:text-left">{{ $book->title }}</h1>
                <h2 class="author truncate overflow-hidden font-semibold">{{ $book->author->name }}</h2>
                <span class="badge bg-blue-500 text-white px-3 py-1 rounded">{{ $book->category->name }}</span>
                <h2 class="pages">
                    <strong>Number of pages:</strong>
                    <span class="{{ $book->pages ? '' : 'opacity-80 italic' }}">
                        {{ $book->pages ?? 'Information not available.' }}
                    </span>
                </h2>
                <p class="mb-10 w-full text-center md:text-left md:w-96">
                    <strong>Description:</strong>
                    <span class="{{ $book->description ? '' : 'opacity-80 italic' }}">
                    {{ $book->description ?? 'Description not available.' }}
                </span>
                </p>
                <div class="flex gap-5">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary icon">
                        <i class="fas fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route("books.destroy", $book) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary icon"
                            onclick="return confirm('Are you sure you want to delete this book? This action cannot be undone.');">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
