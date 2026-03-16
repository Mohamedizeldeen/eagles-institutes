@extends('layouts.admin')
@section('title', __('messages.gallery.upload_images'))
@section('page-title', __('messages.gallery.upload_images'))

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.gallery.images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-5">
                <div>
                    <label for="gallery_category_id" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.category') }} <span class="text-red-500">*</span></label>
                    <select name="gallery_category_id" id="gallery_category_id" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('gallery_category_id') border-red-500 @enderror">
                        <option value="">{{ __('messages.gallery.select_category') }}</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('gallery_category_id', $selectedCategoryId) == $cat->id ? 'selected' : '' }}>{{ $cat->localized_name }}</option>
                        @endforeach
                    </select>
                    @error('gallery_category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.images') }} <span class="text-red-500">*</span></label>
                    <input type="file" name="images[]" id="images" accept="image/*" multiple required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition @error('images') border-red-500 @enderror @error('images.*') border-red-500 @enderror">
                    <p class="text-xs text-gray-400 mt-1">{{ __('messages.gallery.multi_upload_hint') }}</p>
                    @error('images')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    @error('images.*')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="caption" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.caption') }}</label>
                    <input type="text" name="caption" id="caption" value="{{ old('caption') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="caption_en" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.gallery.caption_en') }}</label>
                    <input type="text" name="caption_en" id="caption_en" value="{{ old('caption_en') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home') ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">{{ __('messages.gallery.show_on_home') }}</span>
                </label>
            </div>
            <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">{{ __('messages.gallery.upload') }}</button>
                <a href="{{ route('admin.gallery.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">{{ __('messages.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
