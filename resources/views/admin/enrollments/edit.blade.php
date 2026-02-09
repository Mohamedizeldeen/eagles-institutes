@extends('layouts.admin')
@section('title', 'تعديل التسجيل')
@section('page-title', 'تعديل التسجيل')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="bg-blue-50 rounded-lg p-4 mb-6">
            <p class="text-sm text-blue-800"><strong>الطالب:</strong> {{ $enrollment->student->name }} | <strong>الدورة:</strong> {{ $enrollment->course->name }}</p>
        </div>
        <form action="{{ route('admin.enrollments.update', $enrollment) }}" method="POST">
            @csrf @method('PUT')
            <div class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label for="amount_paid" class="block text-sm font-medium text-gray-700 mb-1">المبلغ المدفوع</label>
                        <input type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', $enrollment->amount_paid) }}" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" dir="ltr">
                    </div>
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">الخصم</label>
                        <input type="number" name="discount" id="discount" value="{{ old('discount', $enrollment->discount) }}" step="0.01" min="0"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" dir="ltr">
                    </div>
                    <div>
                        <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">حالة الدفع</label>
                        <select name="payment_status" id="payment_status" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                            <option value="مدفوع" {{ old('payment_status', $enrollment->payment_status) === 'مدفوع' ? 'selected' : '' }}>مدفوع</option>
                            <option value="جزئي" {{ old('payment_status', $enrollment->payment_status) === 'جزئي' ? 'selected' : '' }}>جزئي</option>
                            <option value="غير مدفوع" {{ old('payment_status', $enrollment->payment_status) === 'غير مدفوع' ? 'selected' : '' }}>غير مدفوع</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">حالة التسجيل</label>
                        <select name="status" id="status" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                            <option value="مسجل" {{ old('status', $enrollment->status) === 'مسجل' ? 'selected' : '' }}>مسجل</option>
                            <option value="مكتمل" {{ old('status', $enrollment->status) === 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
                            <option value="منسحب" {{ old('status', $enrollment->status) === 'منسحب' ? 'selected' : '' }}>منسحب</option>
                            <option value="مؤجل" {{ old('status', $enrollment->status) === 'مؤجل' ? 'selected' : '' }}>مؤجل</option>
                        </select>
                    </div>
                    <div>
                        <label for="completed_at" class="block text-sm font-medium text-gray-700 mb-1">تاريخ الإكمال</label>
                        <input type="date" name="completed_at" id="completed_at" value="{{ old('completed_at', $enrollment->completed_at?->format('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" dir="ltr">
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">ملاحظات</label>
                    <textarea name="notes" id="notes" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('notes', $enrollment->notes) }}</textarea>
                </div>
            </div>

            <div class="flex items-center gap-3 mt-6 pt-6 border-t">
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg hover:bg-blue-800 transition font-medium">تحديث</button>
                <a href="{{ route('admin.enrollments.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
