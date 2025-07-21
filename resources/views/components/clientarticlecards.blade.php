<div class="col">
                <div class="card bg-dark text-white h-100 border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>

                        @if ($article->media)
                            <img src="{{ asset('storage/' . $article->media->file_path) }}"
                                 alt="{{ $article->media->file_name }}"
                                 class="img-fluid rounded mb-3">
                        @endif

                        <div class="article-preview">{!! $article->body !!}</div>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-end">
                        <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-outline-warning mt-3">
                            VIEW_MORE
                        </a>
                    </div>
                </div>
            </div>