@extends('layout.main')

@section('page_title')
    Book List
@endsection

@section('main')
    <main class="main p-5">
        @if(session('success'))
            <script>
                window.onload = () => { displayToastNotification("{{ session('success') }}", 'success') }
            </script>
        @endif
        <a href="{{ route('books.create') }}" class="btn btn-primary icon">
            <i class="fa-solid fa-plus"></i>
        </a>
        <div class="flex flex-wrap justify-center gap-20 pt-5">
            @forelse($books as $book)
                @include('partial.book')
            @empty
                <p class="text-red-600 text-xl font-bold text-center">
                    There are no book records available at the moment.
                </p>
            @endforelse
        </div>
    </main>
@endsection
