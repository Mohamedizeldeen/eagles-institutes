<div class="space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.name') }} <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $course->name ?? '') }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('name') border-red-500 @enderror">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="name_en" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.name_en') }}</label>
            <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $course->name_en ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('name_en') border-red-500 @enderror" dir="ltr">
            @error('name_en')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="level" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.level') }} <span class="text-red-500">*</span></label>
        <select name="level" id="level" required
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            <option value="">{{ __('messages.courses.select_level') }}</option>
            <option value="مبتدئ" {{ old('level', $course->level ?? '') === 'مبتدئ' ? 'selected' : '' }}>{{ __('messages.courses.beginner') }}</option>
            <option value="متوسط" {{ old('level', $course->level ?? '') === 'متوسط' ? 'selected' : '' }}>{{ __('messages.courses.intermediate') }}</option>
            <option value="متقدم" {{ old('level', $course->level ?? '') === 'متقدم' ? 'selected' : '' }}>{{ __('messages.courses.advanced') }}</option>
        </select>
        @error('level')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.description') }}</label>
        <textarea name="description" id="description" rows="4"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('description', $course->description ?? '') }}</textarea>
    </div>

    <div>
        <label for="description_en" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.description_en') }}</label>
        <textarea name="description_en" id="description_en" rows="4" dir="ltr"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('description_en', $course->description_en ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.price') }} <span class="text-red-500">*</span></label>
            <input type="number" name="price" id="price" value="{{ old('price', $course->price ?? 0) }}" step="0.01" min="0" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
            @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="duration_hours" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.duration') }} <span class="text-red-500">*</span></label>
            <input type="number" name="duration_hours" id="duration_hours" value="{{ old('duration_hours', $course->duration_hours ?? '') }}" min="1" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
            @error('duration_hours')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="max_students" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.max_students') }}</label>
            <input type="number" name="max_students" id="max_students" value="{{ old('max_students', $course->max_students ?? '') }}" min="1"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.start_date') }}</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', isset($course) && $course->start_date ? $course->start_date->format('Y-m-d') : '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.end_date') }}</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', isset($course) && $course->end_date ? $course->end_date->format('Y-m-d') : '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
        </div>
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.courses.image') }}</label>
        @if(isset($course) && $course->image)
            <div class="mb-2">
                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->localized_name }}" class="w-32 h-20 object-cover rounded-lg">
            </div>
        @endif
        <input type="file" name="image" id="image" accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
    </div>

    <div class="flex items-center gap-6">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $course->is_active ?? true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm text-gray-700">{{ __('messages.courses.course_active') }}</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="show_on_website" value="1" {{ old('show_on_website', $course->show_on_website ?? true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm text-gray-700">{{ __('messages.courses.show_website') }}</span>
        </label>
    </div>
</div>
