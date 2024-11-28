@extends('layout.main')

@section('page_title')
    Author List
@endsection

@section('main')
    <main class="main p-5">
        @if(session('success'))
            <script>
                window.onload = () => { displayToastNotification("{{ session('success') }}", 'success') }
            </script>
        @endif

        <div style="width: 680px;" class="mx-auto mb-4 flex flex-col items-start gap-3">
            <a href="{{ route('authors.create') }}" class="btn btn-primary icon">
                <i class="fa-solid fa-plus"></i>
            </a>
            <div class="w-full flex gap-4 items-center justify-between">
                <input
                    type="text"
                    id="search"
                    class="input-outline w-96"
                    placeholder="Filter authors..."
                    oninput="filterTable()">
                <select id="pageSize" class="input-outline" onchange="updatePageSize()">
                    <option value="10">10 per page</option>
                    <option value="20">20 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>

        <div class="container-custom-table">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <button onclick="sortTable('name')" class="btn btn-ghost">Name<i class="fa-solid fa-arrow-right-arrow-left transform rotate-90 ml-2 font-light text-sm"></i></button>
                        </th>
                        <th>
                            <button onclick="sortTable('birthday')" class="btn btn-ghost">Birthday<i class="fa-solid fa-arrow-right-arrow-left transform rotate-90 ml-2 font-light text-sm"></i></button>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="authorTable"></tbody>
            </table>
        </div>


        <div style="width: 680px;" class="mx-auto mt-4 flex justify-between items-center">
            <button onclick="previousPage()" class="btn btn-primary btn-outline">
                Previous
            </button>
            <p id="pages_number">Page 1 of 1</p>
            <button onclick="nextPage()" class="btn btn-primary btn-outline">
                Next
            </button>
        </div>

    </main>
@endsection

@section('scripts')
    <script>
        let authors = @json($authors); // Pass authors to JavaScript
        let currentPage = 1;
        let pageSize = 10;
        let currentSort = { column: 'name', direction: 'asc' };
        let filteredAuthors = [...authors];

        function totalPages() {
            return Math.ceil(filteredAuthors.length / pageSize);
        }

        function updatePageNumber() {
            const pageNumberElement = document.getElementById('pages_number');
            pageNumberElement.textContent = `Page ${currentPage} of ${totalPages()}`;
        }

        function renderTable() {
            const tbody = document.getElementById('authorTable');
            tbody.innerHTML = '';
            const start = (currentPage - 1) * pageSize;
            const end = currentPage * pageSize;

            filteredAuthors.slice(start, end).forEach(author => {
                const formattedDate = author.birthday
                    ? new Date(author.birthday).toLocaleDateString('en', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    })
                    : 'Not Available';

                tbody.innerHTML += `
                <tr>
                    <td>${author.id}</td>
                    <td>${author.name}</td>
                    <td>${formattedDate}</td>
                    <td class="flex justify-end  gap-2">
                        <a href="/authors/${author.id}/edit" class="btn btn-primary icon">
                            <i class="fas fa-pen-to-square"></i>
                        </a>
                        <form action="${window.location.origin}/authors/${author.id}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-primary icon"
                                    onclick="return confirm('Are you sure you want to delete this author? This action cannot be undone.');">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>`;
            });

            updatePageNumber();
        }

        function filterTable() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            filteredAuthors = authors.filter(author =>
                author.name.toLowerCase().includes(searchInput)
            );
            currentPage = 1;
            renderTable();
        }

        function sortTable(column) {
            currentSort.direction = currentSort.column === column
                ? (currentSort.direction === 'asc' ? 'desc' : 'asc')
                : 'asc';
            currentSort.column = column;

            filteredAuthors.sort((a, b) => {
                if (a[column] < b[column]) return currentSort.direction === 'asc' ? -1 : 1;
                if (a[column] > b[column]) return currentSort.direction === 'asc' ? 1 : -1;
                return 0;
            });

            renderTable();
        }

        function updatePageSize() {
            pageSize = parseInt(document.getElementById('pageSize').value);
            currentPage = 1;
            renderTable();
        }

        function nextPage() {
            if (currentPage < totalPages()) {
                currentPage++;
                renderTable();
            }
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderTable();
        });
    </script>
@endsection

