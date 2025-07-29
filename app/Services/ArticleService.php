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
}