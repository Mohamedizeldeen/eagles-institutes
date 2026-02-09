@extends('layouts.app')

@section('title', 'المقالات')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-bl from-[#db4047] to-[#112c71] text-gray-200  py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">المقالات</h1>
            <p class="text-xl text-primary-100 max-w-2xl mx-auto">مقالات ونصائح مفيدة لتعلم اللغة الإنجليزية</p>
        </div>
    </section>

    {{-- Articles Grid --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
                            @if($article->image)
                                <div class="h-52 overflow-hidden">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="h-52 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $article->published_at ? $article->published_at->format('Y/m/d') : $article->created_at->format('Y/m/d') }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-primary-600 transition-colors line-clamp-2">
                                    <a href="{{ route('public.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">{{ $article->excerpt }}</p>
                                <a href="{{ route('public.articles.show', $article->slug) }}" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                                    اقرأ المزيد
                                    <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-500 mb-2">لا توجد مقالات حالياً</h3>
                    <p class="text-gray-400">تابعنا لمعرفة آخر المقالات</p>
                </div>
            @endif
        </div>
    </section>
@endsection
