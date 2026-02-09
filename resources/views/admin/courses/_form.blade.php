<div class="space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">اسم الدورة <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $course->name ?? '') }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('name') border-red-500 @enderror">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="level" class="block text-sm font-medium text-gray-700 mb-1">المستوى <span class="text-red-500">*</span></label>
            <select name="level" id="level" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                <option value="">اختر المستوى</option>
                <option value="مبتدئ" {{ old('level', $course->level ?? '') === 'مبتدئ' ? 'selected' : '' }}>مبتدئ</option>
                <option value="متوسط" {{ old('level', $course->level ?? '') === 'متوسط' ? 'selected' : '' }}>متوسط</option>
                <option value="متقدم" {{ old('level', $course->level ?? '') === 'متقدم' ? 'selected' : '' }}>متقدم</option>
            </select>
            @error('level')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">وصف الدورة</label>
        <textarea name="description" id="description" rows="4"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('description', $course->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">السعر <span class="text-red-500">*</span></label>
            <input type="number" name="price" id="price" value="{{ old('price', $course->price ?? 0) }}" step="0.01" min="0" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
            @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="duration_hours" class="block text-sm font-medium text-gray-700 mb-1">المدة (ساعات) <span class="text-red-500">*</span></label>
            <input type="number" name="duration_hours" id="duration_hours" value="{{ old('duration_hours', $course->duration_hours ?? '') }}" min="1" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
            @error('duration_hours')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="max_students" class="block text-sm font-medium text-gray-700 mb-1">الحد الأقصى للطلاب</label>
            <input type="number" name="max_students" id="max_students" value="{{ old('max_students', $course->max_students ?? '') }}" min="1"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">تاريخ البداية</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', isset($course) && $course->start_date ? $course->start_date->format('Y-m-d') : '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">تاريخ النهاية</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', isset($course) && $course->end_date ? $course->end_date->format('Y-m-d') : '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
        </div>
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">صورة الدورة</label>
        @if(isset($course) && $course->image)
            <div class="mb-2">
                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->name }}" class="w-32 h-20 object-cover rounded-lg">
            </div>
        @endif
        <input type="file" name="image" id="image" accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
    </div>

    <div class="flex items-center gap-6">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $course->is_active ?? true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm text-gray-700">الدورة نشطة</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="show_on_website" value="1" {{ old('show_on_website', $course->show_on_website ?? true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm text-gray-700">عرض في الموقع</span>
        </label>
    </div>
</div>
