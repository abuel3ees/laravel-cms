<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterArticleRequest;
use App\Http\Requests\ImportArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Jobs\publisharticlejob;
use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\User;
use App\Imports\Articlesimport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UpdateArticleRequest;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterArticleRequest $request, ArticleService $articleService)
    {
       $articles = $articleService->filterArticles($request->validated());
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
            public function store(StoreArticleRequest $request, ArticleService $service)
            {  
                $service->store($request->validated(), $request->file('image'));
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
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->validated());
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
    public function clientIndex(ArticleService $articleService)
{       $articles = $articleService->clientShow();
        // Fetch articles with status 'published' and not soft deleted
        // This method should return a view to display the client-side articles

    return view('articles.client', compact('articles'));
}
    public function import(ImportArticleRequest $request)
{
    Excel::import(new ArticlesImport, $request->file('file'));

    return back()->with('success', '✅ Articles imported successfully!');
}
}
