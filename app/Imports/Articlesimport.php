<?php

namespace App\Imports;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArticlesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Article([
            'title'    => $row['title'],
            'body'     => $row['body'],
            'user_id'  => Auth::id(),
            'media_id' => $row['media_id'] ?? null,
        ]);
    }
}

