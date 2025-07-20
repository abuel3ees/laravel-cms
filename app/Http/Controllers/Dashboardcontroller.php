<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Media;
class Dashboardcontroller extends Controller
{
    public function index() {
    $totalArticles = Article::count();
    $published = Article::whereNull("deleted_at")->count();
    $totalUsers = User::count();
    $totalAdmins = User::where('role', 'admin')->count();
    $mediaCount = Media::count();
    $userCounts = User::selectRaw("MONTH(created_at) as month, COUNT(*) as total")
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month');
    $articleCounts = Article::selectRaw("MONTH(created_at) as month, COUNT(*) as total")
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month');

    $monthLabels = [];
    $userData = [];
    $articleData = [];
    foreach (range(1, 12) as $month) {
        $label = date('M', mktime(0, 0, 0, $month, 10)); // Jan, Feb, ...
        $monthLabels[] = $label;
        $userData[] = $userCounts[$month] ?? 0;
        $articleData[] = $articleCounts[$month] ?? 0;
    }


    return view('general', compact(
        'totalArticles', 'published', 'totalUsers', 'totalAdmins' , 'mediaCount', 'monthLabels', 'userData', 'articleData'
    ));
}

    public function general(){
       
    }
}
