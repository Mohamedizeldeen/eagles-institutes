<div class="space-y-5">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">عنوان المقال <span class="text-red-500">*</span></label>
        <input type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('title') border-red-500 @enderror">
        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">ملخص المقال</label>
        <textarea name="excerpt" id="excerpt" rows="2" maxlength="500"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
    </div>

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">محتوى المقال <span class="text-red-500">*</span></label>
        <textarea name="content" id="content" rows="12" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('content') border-red-500 @enderror">{{ old('content', $article->content ?? '') }}</textarea>
        @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">صورة المقال</label>
        @if(isset($article) && $article->image)
            <div class="mb-2">
                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-32 h-20 object-cover rounded-lg">
            </div>
        @endif
        <input type="file" name="image" id="image" accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
    </div>

    <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published ?? false) ? 'checked' : '' }}
            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span class="text-sm text-gray-700">نشر المقال</span>
    </label>
</div>
