@extends('layouts.admin')
@section('title', 'إصدار شهادة جديدة')
@section('page-title', 'إصدار شهادة جديدة')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        @if($completedEnrollments->isEmpty() && !$enrollment)
            <div class="text-center py-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <p>لا توجد دورات مكتملة بدون شهادات</p>
                <p class="text-sm mt-1">يجب أن يكمل الطالب دورة أولاً قبل إصدار الشهادة</p>
            </div>
        @else
            <form action="{{ route('admin.certificates.store') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="enrollment_id" class="block text-sm font-medium text-gray-700 mb-1">التسجيل المكتمل <span class="text-red-500">*</span></label>
                        <select name="enrollment_id" id="enrollment_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition @error('enrollment_id') border-red-500 @enderror">
                            <option value="">اختر التسجيل</option>
                            @if($enrollment)
                                <option value="{{ $enrollment->id }}" selected>{{ $enrollment->student->name }} - {{ $enrollment->course->name }}</option>
                            @endif
                            @foreach($completedEnrollments as $enr)
                                <option value="{{ $enr->id }}" {{ old('enrollment_id') == $enr->id ? 'selected' : '' }}>
                                    {{ $enr->student->name }} - {{ $enr->course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('enrollment_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="grade" class="block text-sm font-medium text-gray-700 mb-1">التقدير</label>
                            <input type="text" name="grade" id="grade" value="{{ old('grade') }}" placeholder="مثال: ممتاز، جيد جداً"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label for="issued_at" class="block text-sm font-medium text-gray-700 mb-1">تاريخ الإصدار <span class="text-red-500">*</span></label>
                            <input type="date" name="issued_at" id="issued_at" value="{{ old('issued_at', date('Y-m-d')) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" dir="ltr">
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">ملاحظات</label>
                        <textarea name="notes" id="notes" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                    <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">إصدار الشهادة</button>
                    <a href="{{ route('admin.certificates.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">إلغاء</a>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
