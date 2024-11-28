@extends('layout.main')

@section('page_title')
    Create Author
@endsection

@section('main')
    <main class="main p-1 md:p-5">
        <div class="w-full 2xl:w-1/3 m-auto card">
            <h1 class="text-2xl font-bold text-center mb-5">Create a New Author</h1>
            <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name" class="w-full">Full name</label>
                    @error('name')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <input type="text" name="name" id="name" class="input-outline @error('name') error @enderror w-full">
                </div>
                <div class="form-group">
                    <label for="birthday" class="block mb-2 flex justify-between w-64">Birthday <span class="text-sm opacity-75">(optional)</span></label>
                    @error('birthday')
                    <span class="text-red-600 text-sm py-4">{{ $message }}</span>
                    @enderror
                    <input type="date" name="birthday" id="birthday" class="input-outline @error('birthday') error @enderror w-64">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </main>
@endsection

