<div class="col">
                <div class="card bg-dark text-white border border-secondary">
                    <img src="{{ asset('storage/' . $file->file_path) }}" class="card-img-top" alt="Image">

                    <div class="card-body">
                        <small class="d-block text-muted mb-2">{{ $file->file_name }}</small>

                        <form action="{{ route('media.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger w-100" type="submit">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>