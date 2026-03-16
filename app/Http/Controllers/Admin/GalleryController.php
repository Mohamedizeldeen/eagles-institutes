<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryCategory::withCount('images')->orderBy('sort_order')->get();
        $selectedCategory = null;
        $images = collect();

        if ($request->filled('category')) {
            $selectedCategory = GalleryCategory::findOrFail($request->category);
            $images = $selectedCategory->images()->orderBy('sort_order')->get();
        }

        return view('admin.gallery.index', compact('categories', 'selectedCategory', 'images'));
    }

    // ── Category CRUD ──

    public function createCategory()
    {
        return view('admin.gallery.create-category');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        GalleryCategory::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', __('messages.gallery.category_created'));
    }

    public function editCategory(GalleryCategory $category)
    {
        return view('admin.gallery.edit-category', compact('category'));
    }

    public function updateCategory(Request $request, GalleryCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $category->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', __('messages.gallery.category_updated'));
    }

    public function destroyCategory(GalleryCategory $category)
    {
        // Delete all associated image files
        foreach ($category->images as $image) {
            Storage::disk('public')->delete($image->image);
        }
        $category->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', __('messages.gallery.category_deleted'));
    }

    // ── Image CRUD ──

    public function createImage(Request $request)
    {
        $categories = GalleryCategory::orderBy('sort_order')->get();
        $selectedCategoryId = $request->query('category');

        return view('admin.gallery.create-image', compact('categories', 'selectedCategoryId'));
    }

    public function storeImage(Request $request)
    {
        $validated = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:4096',
            'caption' => 'nullable|string|max:255',
            'caption_en' => 'nullable|string|max:255',
            'show_on_home' => 'boolean',
        ]);

        $showOnHome = $request->has('show_on_home');
        $maxSort = GalleryImage::where('gallery_category_id', $validated['gallery_category_id'])->max('sort_order') ?? 0;

        foreach ($request->file('images') as $file) {
            $path = $file->store('gallery', 'public');
            GalleryImage::create([
                'gallery_category_id' => $validated['gallery_category_id'],
                'image' => $path,
                'caption' => $validated['caption'] ?? null,
                'caption_en' => $validated['caption_en'] ?? null,
                'sort_order' => ++$maxSort,
                'show_on_home' => $showOnHome,
            ]);
        }

        return redirect()->route('admin.gallery.index', ['category' => $validated['gallery_category_id']])
            ->with('success', __('messages.gallery.images_uploaded'));
    }

    public function editImage(GalleryImage $image)
    {
        $categories = GalleryCategory::orderBy('sort_order')->get();
        return view('admin.gallery.edit-image', compact('image', 'categories'));
    }

    public function updateImage(Request $request, GalleryImage $image)
    {
        $validated = $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'image' => 'nullable|image|max:4096',
            'caption' => 'nullable|string|max:255',
            'caption_en' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'show_on_home' => 'boolean',
        ]);

        $validated['show_on_home'] = $request->has('show_on_home');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($image->image);
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        } else {
            unset($validated['image']);
        }

        $image->update($validated);

        return redirect()->route('admin.gallery.index', ['category' => $image->gallery_category_id])
            ->with('success', __('messages.gallery.image_updated'));
    }

    public function destroyImage(GalleryImage $image)
    {
        $categoryId = $image->gallery_category_id;
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return redirect()->route('admin.gallery.index', ['category' => $categoryId])
            ->with('success', __('messages.gallery.image_deleted'));
    }

    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:gallery_images,id',
        ]);

        foreach ($validated['order'] as $index => $id) {
            GalleryImage::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
