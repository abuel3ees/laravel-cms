<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $query = Article::query();
        if ($request ->filled('title')){
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        if($request->filled('user_id')){
            $query->where('user_id', $request->input('user_id'));
        }

        if($request ->filled('from') && $request ->filled('to')){
            $query->whereBetween('created_at', [$request->input('from'), $request->input('to')]);
        }
        $articles = $query->latest()->paginate(6);
        return response()->json($articles);
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
            return response()->json(['message' => 'Article Added Successfully!', 'article' => $article]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Update the article
        $article = Article::findOrFail($id);
        $article->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);
        return response()->json(['message' => 'Article updated successfully.', 'article' => $article]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->json(['message' => 'Article deleted successfully.']);
    }

    public function publish(string $id){
        $article = Article::findOrFail($id);
        $article->status = 'published';
        $article->save();
        return response()->json(['message'=> 'Article published successfully.', 'article' => $article]);
    }
}
