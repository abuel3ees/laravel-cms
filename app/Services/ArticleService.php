<?php
namespace App\Services;

use App\Models\Article;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use App\Jobs\PublishArticleJob;

class ArticleService{

    public function store(array $data, ?UploadedFile $file = null){
        $media = null;
        if ($file) {
            $path = $file->store('images', 'public');
            $media = Media::create([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        $article = Article::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => auth()->id(),
            'media_id' => $media->id ?? null,
            'status' => 'pending', 
        ]);
        dispatch(new PublishArticleJob($article))->delay(now()->addSeconds(7));
        return $article;
    }
    public function filterArticles(array $filters, int $perpage = 6){
         $query = Article::query();

    if (!empty($filters['title'])) {
        $query->where('title', 'like', '%' . $filters['title'] . '%');
    }

    if (!empty($filters['user_id'])) {
        $query->where('user_id', $filters['user_id']);
    }

    if (!empty($filters['from']) && !empty($filters['to'])) {
        $query->whereBetween('created_at', [$filters['from'], $filters['to']]);
    }

    return $query->latest()->paginate($perpage);
    }

    public function clientShow(){
        $articles = Article::where('status', 'published')
        ->whereNull('deleted_at')
        ->latest() 
        ->paginate(6);
        return $articles;
    }
}
