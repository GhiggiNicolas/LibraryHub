<article class="card book">
    <img src="{{ asset('images/' . ($book->image ?? 'book_default.png')) }}" alt="Book's image" class="card-image">
    <div class="card-content">
        <h1 class="title truncate overflow-hidden font-bold text-xl">{{ $book->title }}</h1>
        <h2 class="author truncate overflow-hidden font-semibold">{{ $book->author->name }}</h2>
        <div class="hidden-content">
            <span class="badge">{{ $book->category->name }}</span>
            <div class="btn-list">
                <a href="{{ route('books.show', $book) }}">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('books.edit', $book) }}">
                    <i class="fas fa-pen-to-square"></i>
                </a>
                <form action="{{ route("books.destroy", $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Are you sure you want to delete this book? This action cannot be undone.');">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</article>
