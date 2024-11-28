<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $books = Book::with(['author', 'category'])->get();

        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('book.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request) : RedirectResponse
    {
        $validated = $request->validated();

        $filename = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();

                $destinationPath = public_path('images');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $filename = uniqid('book_', true) . '.' . $extension;
                $imagePath = $destinationPath . '/' . $filename;

                $manager = new ImageManager(Driver::class);

                $imageManager = $manager->read($image->getRealPath());
                $image = $imageManager->cover(config('book.max_width'), config('book.max_height'));
                $image->save($imagePath);
            } else {
                return redirect()->back()->withErrors(['image' => 'Invalid image file.']);
            }
        }

        Book::query()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'pages' => $validated['pages'] ?? null,
            'author_id' => $validated['author_id'],
            'category_id' => $validated['category_id'],
            'image' => $filename
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book) : View
    {
        $book->load(['author', 'category']);
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book) : View
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('book.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book) : RedirectResponse
    {
        $validated = $request->validated();

        $filename = $book->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $destinationPath = public_path('images');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $filename = uniqid('book_', true) . '.' . $extension;
                $imagePath = $destinationPath . '/' . $filename;

                $manager = new ImageManager(Driver::class);

                $imageManager = $manager->read($image->getRealPath());
                $image = $imageManager->cover(config('book.max_width'), config('book.max_height'));
                $image->save($imagePath);

                if ($book->image) {
                    $oldImagePath = public_path('images/' . $book->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                return redirect()->back()->withErrors(['image' => 'Invalid image file.']);
            }
        }

        $book->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'pages' => $validated['pages'] ?? null,
            'author_id' => $validated['author_id'],
            'category_id' => $validated['category_id'],
            'image' => $filename,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book) : RedirectResponse
    {
        if ($book->image && file_exists(public_path('images/' . $book->image))) {
            unlink(public_path('images/' . $book->image));
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

}
