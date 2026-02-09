<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::visibleOnWebsite()->latest()->take(6)->get();
        $latestArticles = Article::published()->latest()->take(3)->get();

        return view('public.home', compact('featuredCourses', 'latestArticles'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }
}
