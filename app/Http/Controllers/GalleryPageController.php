<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;

class GalleryPageController extends Controller
{
    public function index()
    {
        $categories = GalleryCategory::active()
            ->withCount('images')
            ->orderBy('sort_order')
            ->get();

        $images = GalleryImage::with('category')
            ->whereHas('category', fn($q) => $q->active())
            ->orderBy('sort_order')
            ->get();

        return view('public.gallery', compact('categories', 'images'));
    }
}
