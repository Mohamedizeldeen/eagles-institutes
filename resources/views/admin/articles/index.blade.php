@extends('layouts.admin')
@section('title', 'إدارة المقالات')
@section('page-title', 'إدارة المقالات')

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form action="{{ route('admin.articles.index') }}" method="GET" class="flex gap-3 items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث بالعنوان..."
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none w-48">
        <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">كل الحالات</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>منشور</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>مسودة</option>
        </select>
        <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300 transition">بحث</button>
    </form>
    <a href="{{ route('admin.articles.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        مقال جديد
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">#</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">العنوان</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الكاتب</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الحالة</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">تاريخ النشر</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($articles as $article)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $article->id }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ Str::limit($article->title, 50) }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $article->author->name }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs rounded-full {{ $article->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $article->is_published ? 'منشور' : 'مسودة' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $article->published_at?->format('Y/m/d') ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                @if($article->is_published)
                                    <a href="{{ route('public.articles.show', $article->slug) }}" target="_blank" class="text-green-600 hover:text-green-800" title="عرض في الموقع">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                @endif
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-amber-600 hover:text-amber-800" title="تعديل">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="حذف">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-8 text-gray-500">لا توجد مقالات</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $articles->withQueryString()->links() }}</div>
</div>
@endsection
