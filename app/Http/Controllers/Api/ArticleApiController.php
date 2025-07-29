<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Http\Requests\FilterArticleRequest;

class ArticleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterArticleRequest $request, ArticleService $articleService)
    {
        $articles = $articleService->filterArticles($request->validated());
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request, ArticleService $service)
    {
        $service->store($request->validated(), $request->file('image'));
        return response()->json(['message' => 'Article Added Successfully!'], 201);
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
     public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->validated());
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
