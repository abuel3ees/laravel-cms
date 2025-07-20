<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('articles.index', ['articles' => Article::latest()->paginate(6)] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
        // This method should return a view to create a new article
    }


    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $user_id = auth()->id();

            $media = null;
            if ($request->hasFile('image')) {
               $file = $request->file('image');
                if($file){
                    $path = $file->store('images', 'public');
                    $media = Media::create([
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }

            $article = Article::create([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'user_id' => $user_id,
                'media_id' => $media ? $media->id : null,
            ]);
            return redirect()->route('articles.index')->with('success','Article Addded Successfuly!');
        }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
        // This method should return a view to display the article details
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
    public function softDelete($id){
        $article = Article::findOrFail($id);
        $article->delete();
        $article->save();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
    public function clientIndex()
{
    $articles = Article::whereNull('deleted_at')
        ->latest()
        ->paginate(6);

    return view('articles.client', compact('articles'));
}
}
