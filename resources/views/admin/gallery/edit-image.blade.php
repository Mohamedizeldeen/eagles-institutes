@extends('layouts.admin')
@section('title', __('messages.gallery.edit_image'))
@section('page-title', __('messages.gallery.edit_image'))

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.gallery.images.update', $image) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="space-y-5">
                <div>
                    <label for="gallery_category_id" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.category') }} <span class="text-red-500">*</span></label>
                    <select name="gallery_category_id" id="gallery_category_id" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('gallery_category_id', $image->gallery_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->localized_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.current_image') }}</label>
                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->localized_caption }}" class="w-40 h-40 object-cover rounded-lg">
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.replace_image') }}</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="caption" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.caption') }}</label>
                    <input type="text" name="caption" id="caption" value="{{ old('caption', $image->caption) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="caption_en" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.caption_en') }}</label>
                    <input type="text" name="caption_en" id="caption_en" value="{{ old('caption_en', $image->caption_en) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.sort_order') }}</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $image->sort_order) }}" min="0"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home', $image->show_on_home) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">{{ __('messages.gallery.show_on_home') }}</span>
                </label>
            </div>
            <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">{{ __('messages.save') }}</button>
                <a href="{{ route('admin.gallery.index', ['category' => $image->gallery_category_id]) }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">{{ __('messages.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
