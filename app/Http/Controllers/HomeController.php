<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\GalleryImage;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::visibleOnWebsite()->latest()->take(6)->get();
        $latestArticles = Article::published()->latest()->take(3)->get();
        $galleryImages = GalleryImage::homeFeatured()
            ->with('category')
            ->whereHas('category', fn($q) => $q->active())
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        return view('public.home', compact('featuredCourses', 'latestArticles', 'galleryImages'));
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
