   <div class="mb-4">
            <label for="title" class="form-label text-warning fs-5" style="color: #FF4433; ">TITLE</label>
            <input type="text" name="title" id="title"
                   class="form-control bg-dark text-white border border-secondary"
                   placeholder="Enter article title" required
                   value="{{ old('title') }}">
        </div>
  <label for="body" class="form-label text-warning fs-5" style="color: #FF4433">BODY</label>
            <textarea name="body" id="body" rows="6"
                      class="form-control bg-dark text-white border border-secondary"
                      placeholder="Write something..." required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label text-light">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit"
                class="btn text-white px-4 py-2"
                style="background-color: #FF4433; border: none;">
            Post Article
        </button>
    </form>