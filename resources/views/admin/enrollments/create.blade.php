@extends('layouts.admin')
@section('title', 'تسجيل طالب في دورة')
@section('page-title', 'تسجيل طالب في دورة')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.enrollments.store') }}" method="POST">
            @csrf
            <div class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">الطالب <span class="text-red-500">*</span></label>
                        <select name="student_id" id="student_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition @error('student_id') border-red-500 @enderror">
                            <option value="">اختر الطالب</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }} ({{ $student->id_number }})</option>
                            @endforeach
                        </select>
                        @error('student_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">الدورة <span class="text-red-500">*</span></label>
                        <select name="course_id" id="course_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition @error('course_id') border-red-500 @enderror">
                            <option value="">اختر الدورة</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" data-price="{{ $course->price }}" {{ old('course_id', request('course_id')) == $course->id ? 'selected' : '' }}>{{ $course->name }} ({{ number_format($course->price, 2) }})</option>
                            @endforeach
                        </select>
                        @error('course_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label for="amount_paid" class="block text-sm font-medium text-gray-700 mb-1">المبلغ المدفوع <span class="text-red-500">*</span></label>
                        <input type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', 0) }}" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" dir="ltr">
                    </div>
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">الخصم</label>
                        <input type="number" name="discount" id="discount" value="{{ old('discount', 0) }}" step="0.01" min="0"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" dir="ltr">
                    </div>
                    <div>
                        <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">حالة الدفع <span class="text-red-500">*</span></label>
                        <select name="payment_status" id="payment_status" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                            <option value="مدفوع" {{ old('payment_status') === 'مدفوع' ? 'selected' : '' }}>مدفوع</option>
                            <option value="جزئي" {{ old('payment_status') === 'جزئي' ? 'selected' : '' }}>جزئي</option>
                            <option value="غير مدفوع" {{ old('payment_status', 'غير مدفوع') === 'غير مدفوع' ? 'selected' : '' }}>غير مدفوع</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="enrolled_at" class="block text-sm font-medium text-gray-700 mb-1">تاريخ التسجيل <span class="text-red-500">*</span></label>
                    <input type="date" name="enrolled_at" id="enrolled_at" value="{{ old('enrolled_at', date('Y-m-d')) }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition max-w-xs" dir="ltr">
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">ملاحظات</label>
                    <textarea name="notes" id="notes" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">تسجيل</button>
                <a href="{{ route('admin.enrollments.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
