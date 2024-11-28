@extends('layout.main')

@section('page_title')
    Edit Author
@endsection

@section('main')
    <main class="main p-1 md:p-5">
        <div class="w-full 2xl:w-1/3 m-auto card">
            <h1 class="text-2xl font-bold text-center mb-5">Edit Author</h1>
            <form action="{{ route('authors.update', $author) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="w-full">Full name</label>
                    @error('name')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <input type="text" name="name" id="name" class="input-outline @error('name') error @enderror w-full"
                           value="{{ old('name', $author->name) }}">
                </div>
                <div class="form-group">
                    <label for="birthday" class="block mb-2 flex justify-between w-64">Birthday <span class="text-sm opacity-75">(optional)</span></label>
                    @error('birthday')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <input type="date" name="birthday" id="birthday" class="input-outline @error('birthday') error @enderror w-64"
                           value="{{ old('birthday', $author->birthday ? \Carbon\Carbon::parse($author->birthday)->format('Y-m-d') : '') }}">
                </div>

                <div class="form-group flex gap-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('authors.index') }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </main>
@endsection

