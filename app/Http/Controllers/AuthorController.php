<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $authors = Author::all()->map(function ($author) {
            $author->birthday = $author->birthday ? $author->birthday->translatedFormat('d F, Y') : null;
            return $author;
        });

        return view('author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request) : RedirectResponse
    {
        $validated = $request->validated();

        Author::query()->create([
            'name' => $validated['name'],
            'birthday' => $validated['birthday'] ?? null,
        ]);

        return redirect()->route('authors.index')->with('success', 'Author added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author) : RedirectResponse
    {
        return redirect()->route('authors.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author) : View
    {
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author) : RedirectResponse
    {
        $validated = $request->validated();
        $author->update($validated);
        return redirect()->route('authors.index')->with('success', 'Author updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author) : RedirectResponse
    {
        $author->books->each(function ($book) {
            $imagePath = public_path('images/' . $book->image);
            if ($book->image && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $book->delete();
        });
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author and associated books deleted successfully!');
    }
}
