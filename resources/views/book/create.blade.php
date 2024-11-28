@extends('layout.main')

@section('page_title')
    Create Book
@endsection

@section('main')
    <main class="main p-1 md:p-5">
        <div class="w-full 2xl:w-1/3 m-auto card">
            <h1 class="text-2xl font-bold text-center mb-5">Create a New Book</h1>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title w-full">Title</label>
                    @error('title')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <input type="text" name="title" id="title" class="input-outline @error('title') error @enderror w-full">
                </div>

                <div class="form-group">
                    <label for="description" class="block mb-2 flex justify-between">Description <span class="text-sm opacity-75">(optional)</span></label>
                    @error('description')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <textarea name="description" id="description" class="input-outline @error('description') error @enderror w-full" maxlength="800" oninput="updateCharacterCount()"></textarea>
                    <div class="text-sm text-right mt-1">
                        <span id="charCount">0</span>/800
                    </div>
                </div>
                <div class="form-group w-full md:w-1/3">
                    <label for="pages" class="block mb-2 flex justify-between">Number of Pages <span class="text-sm opacity-75">(optional)</span></label>
                    @error('pages')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <input type="number" name="pages" id="pages" class="input-outline @error('pages') error @enderror w-full" min="1">
                </div>

                <div class="flex flex-col md:flex-row gap-10 md:gap-4">
                    <div class="form-group w-full md:w-full">
                        <label for="author_id" class="block text-sm font-medium mb-2">Author</label>
                        @error('author_id')
                        <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                        @enderror
                        <select name="author_id" id="author_id" class="input-outline @error('author_id') error @enderror w-full">
                            <option value="" selected disabled>Select an author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group w-full md:w-full">
                        <label for="category_id" class="block text-sm font-medium mb-2">Category</label>
                        @error('category_id')
                        <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                        @enderror
                        <select name="category_id" id="category_id" class="input-outline @error('category_id') error @enderror w-full">
                            <option value="" selected disabled>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="book_image" style="width: 400px" class="flex justify-between">Book's image (Max. 2MB) <span class="text-sm opacity-75">(optional)</span></label>
                    @error('book_image')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <label class="picture w-full input-outline @error('book_image') error @enderror" for="book_image" tabIndex="0">
                        <span class="book_image"></span>
                    </label>
                    <input type="file" name="image" id="book_image">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        function updateCharacterCount() {
            const textarea = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            charCount.textContent = textarea.value.length;
        }
    </script>
    <script>
        const inputFile = document.querySelector("#book_image");
        const pictureImage = document.querySelector(".book_image");
        const pictureImageTxt = "Choose an image";
        pictureImage.innerHTML = pictureImageTxt;

        inputFile.addEventListener("change", function (e) {
            const inputTarget = e.target;
            const file = inputTarget.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function (e) {
                    const readerTarget = e.target;

                    const img = document.createElement("img");
                    img.src = readerTarget.result;
                    img.classList.add("book_image");

                    pictureImage.innerHTML = "";
                    pictureImage.appendChild(img);
                });

                reader.readAsDataURL(file);
            } else {
                pictureImage.innerHTML = pictureImageTxt;
            }
        });
    </script>
@endsection
