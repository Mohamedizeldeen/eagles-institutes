<div class="space-y-5">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.article_title') }} <span class="text-red-500">*</span></label>
        <input type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('title') border-red-500 @enderror">
        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="title_en" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.title_en') }}</label>
        <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $article->title_en ?? '') }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('title_en') border-red-500 @enderror">
        @error('title_en')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.slug') }}</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $article->slug ?? '') }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('slug') border-red-500 @enderror" dir="ltr">
        @error('slug')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.excerpt') }}</label>
        <textarea name="excerpt" id="excerpt" rows="2" maxlength="500"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
    </div>

    <div>
        <label for="excerpt_en" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.excerpt_en') }}</label>
        <textarea name="excerpt_en" id="excerpt_en" rows="2" maxlength="500"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('excerpt_en', $article->excerpt_en ?? '') }}</textarea>
    </div>

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.content') }} <span class="text-red-500">*</span></label>
        <textarea name="content" id="content" rows="12" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('content') border-red-500 @enderror">{{ old('content', $article->content ?? '') }}</textarea>
        @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="content_en" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.content_en') }}</label>
        <textarea name="content_en" id="content_en" rows="12"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('content_en') border-red-500 @enderror">{{ old('content_en', $article->content_en ?? '') }}</textarea>
        @error('content_en')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.image') }}</label>
        @if(isset($article) && $article->image)
            <div class="mb-2">
                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->localized_title }}" class="w-32 h-20 object-cover rounded-lg">
            </div>
        @endif
        <input type="file" name="image" id="image" accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
    </div>

    <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published ?? false) ? 'checked' : '' }}
            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-sm text-gray-700">{{ __('messages.articles.publish_article') }}</span>
    </label>

    <div>
        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.articles.published_at') }}</label>
        <input type="date" name="published_at" id="published_at" value="{{ old('published_at', isset($article) && $article->published_at ? $article->published_at->format('Y-m-d') : '') }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
    </div>
</div>
