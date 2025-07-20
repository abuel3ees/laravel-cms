<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'file_name',
        'file_path',
        'mime_type',
    ];

    /**
     * Get the full URL of the media file.
     */
    public function url()
    {
        return asset('storage/' . $this->path);
    }

    /**
     * Get the file's extension.
     */
    public function extension()
    {
        return pathinfo($this->filename, PATHINFO_EXTENSION);
    }
}
