<div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" class="form-control" rows="8" required>{{ old('body', $article->body) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-warning">Update Article</button>
        </div>