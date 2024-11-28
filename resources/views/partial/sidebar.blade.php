<aside class="sidebar z-10">
    <section class="sidebar-section">
        <a href="{{ route('books.index') }}" class="btn btn-ghost icon">
            <i class="fa-solid fa-book"></i>
            <span class="badge">Books</span>
        </a>
        <a href="{{ route('authors.index') }}" class="btn btn-ghost icon">
            <i class="fa-solid fa-feather"></i>
            <span class="badge">Authors</span>
        </a>
        <a href="{{ route('categories.index') }}" class="btn btn-ghost icon">
            <i class="fa-solid fa-list"></i>
            <span class="badge">Categories</span>
        </a>
    </section>

    <section class="sidebar-section">
        <button id="theme-toggle-btn" class="btn btn-ghost icon">
            <i class="fa-solid"></i>
        </button>
    </section>
    <script src="{{ asset('js/theme.js') }}" async></script>
</aside>
