<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('author');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->published();
            } else {
                $query->where('is_published', false);
            }
        }

        $articles = $query->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']) ?: Str::random(8);
        $validated['created_by'] = auth()->id();
        $validated['is_published'] = $request->has('is_published');

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم إنشاء المقال بنجاح');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($validated['is_published'] && !$article->published_at) {
            $validated['published_at'] = now();
        }
        if (!$validated['is_published']) {
            $validated['published_at'] = null;
        }

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم تحديث المقال بنجاح');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'تم حذف المقال بنجاح');
    }
}
