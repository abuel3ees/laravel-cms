<?php

namespace App\Imports;

use App\Jobs\PublishArticleJob;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArticlesImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $article =  new Article([
            'title'    => $row['title'],
            'body'     => $row['body'],
            'user_id'  => Auth::id(),
            'media_id' => $row['media_id'] ?? null,
            'status'   => 'pending', // Default status
        ]);
        $article->save(); // Save the article to the database
        dispatch(new PublishArticleJob($article))->delay(now()->addMinutes(0.25));
        return $article;
    }
}

