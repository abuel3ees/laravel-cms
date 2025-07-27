<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Article;
class PublishArticleJob implements ShouldQueue
{
    protected $article;
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article; 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->article->status = 'published';
        $this->article->save();
    }
}
