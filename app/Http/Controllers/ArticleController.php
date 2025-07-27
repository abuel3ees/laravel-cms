<?php

namespace App\Http\Controllers;

use App\Jobs\publisharticlejob;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\User;
use App\Imports\Articlesimport;
use Maatwebsite\Excel\Facades\Excel;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
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
        $users = User::select('id', 'name')->get();

        return view('articles.index', compact('articles', 'users'));
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
                'status' => 'pending', // Default status
            ]);
            dispatch(new publisharticlejob($article))->delay(now()->addMinutes(0.25));
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
{       $articles = Article::where('status', 'published')
        ->whereNull('deleted_at')
        ->latest() 
        ->paginate(6);

    return view('articles.client', compact('articles'));
}
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,csv',
    ]);

    Excel::import(new ArticlesImport, $request->file('file'));

    return back()->with('success', '✅ Articles imported successfully!');
}
}
