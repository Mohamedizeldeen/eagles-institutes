<div class="space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">الاسم الكامل <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $student->name ?? '') }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('name') border-red-500 @enderror">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="id_number" class="block text-sm font-medium text-gray-700 mb-1">رقم الهوية <span class="text-red-500">*</span></label>
            <input type="text" name="id_number" id="id_number" value="{{ old('id_number', $student->id_number ?? '') }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('id_number') border-red-500 @enderror" dir="ltr">
            @error('id_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف <span class="text-red-500">*</span></label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone ?? '') }}" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('phone') border-red-500 @enderror" dir="ltr">
            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" value="{{ old('email', $student->email ?? '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">الجنس</label>
            <select name="gender" id="gender"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                <option value="">غير محدد</option>
                <option value="ذكر" {{ old('gender', $student->gender ?? '') === 'ذكر' ? 'selected' : '' }}>ذكر</option>
                <option value="أنثى" {{ old('gender', $student->gender ?? '') === 'أنثى' ? 'selected' : '' }}>أنثى</option>
            </select>
        </div>
        <div>
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">تاريخ الميلاد</label>
            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', isset($student) && $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : '') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" dir="ltr">
        </div>
    </div>

    <div>
        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
        <textarea name="address" id="address" rows="2"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('address', $student->address ?? '') }}</textarea>
    </div>

    <div>
        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">ملاحظات</label>
        <textarea name="notes" id="notes" rows="2"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('notes', $student->notes ?? '') }}</textarea>
    </div>

    @if(isset($student))
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $student->is_active) ? 'checked' : '' }}
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm text-gray-700">الطالب نشط</span>
        </label>
    @endif
</div>
