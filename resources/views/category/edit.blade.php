@extends('layout.main')

@section('page_title')
    Edit Author
@endsection

@section('main')
    <main class="main p-1 md:p-5">
        <div class="w-full 2xl:w-1/3 m-auto card">
            <h1 class="text-2xl font-bold text-center mb-5">Edit Category</h1>
            <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="w-full">Name</label>
                    @error('name')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <input type="text" name="name" id="name" class="input-outline @error('name') error @enderror w-full"
                           value="{{ old('name', $category->name) }}">
                </div>

                <div class="form-group flex gap-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </main>
@endsection

