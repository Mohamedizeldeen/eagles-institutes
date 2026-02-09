@extends('layouts.admin')
@section('title', 'إدارة التسجيلات')
@section('page-title', 'إدارة التسجيلات')

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form action="{{ route('admin.enrollments.index') }}" method="GET" class="flex gap-3 items-center flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث بالطالب..."
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none w-48">
        <select name="course_id" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">كل الدورات</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
            @endforeach
        </select>
        <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">كل الحالات</option>
            <option value="مسجل" {{ request('status') === 'مسجل' ? 'selected' : '' }}>مسجل</option>
            <option value="مكتمل" {{ request('status') === 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
            <option value="منسحب" {{ request('status') === 'منسحب' ? 'selected' : '' }}>منسحب</option>
            <option value="مؤجل" {{ request('status') === 'مؤجل' ? 'selected' : '' }}>مؤجل</option>
        </select>
        <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300 transition">بحث</button>
    </form>
    <a href="{{ route('admin.enrollments.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        تسجيل جديد
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">#</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الطالب</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الدورة</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">المبلغ</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">حالة الدفع</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الحالة</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">التاريخ</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($enrollments as $enrollment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $enrollment->id }}</td>
                        <td class="px-4 py-3 font-medium">
                            <a href="{{ route('admin.students.show', $enrollment->student) }}" class="text-blue-600 hover:text-blue-800">{{ $enrollment->student->name }}</a>
                        </td>
                        <td class="px-4 py-3">{{ $enrollment->course->name }}</td>
                        <td class="px-4 py-3">{{ number_format($enrollment->amount_paid, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs rounded-full
                                {{ $enrollment->payment_status === 'مدفوع' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $enrollment->payment_status === 'جزئي' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $enrollment->payment_status === 'غير مدفوع' ? 'bg-red-100 text-red-700' : '' }}
                            ">{{ $enrollment->payment_status }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs rounded-full
                                {{ $enrollment->status === 'مسجل' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $enrollment->status === 'مكتمل' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $enrollment->status === 'منسحب' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $enrollment->status === 'مؤجل' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            ">{{ $enrollment->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $enrollment->enrolled_at->format('Y/m/d') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.enrollments.edit', $enrollment) }}" class="text-amber-600 hover:text-amber-800" title="تعديل">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                @if($enrollment->status === 'مسجل')
                                    <form action="{{ route('admin.enrollments.complete', $enrollment) }}" method="POST" onsubmit="return confirm('تأكيد إكمال الدورة؟')" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800" title="إكمال">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </button>
                                    </form>
                                @endif
                                @if($enrollment->status === 'مكتمل' && !$enrollment->certificate)
                                    <a href="{{ route('admin.certificates.create') }}?enrollment_id={{ $enrollment->id }}" class="text-purple-600 hover:text-purple-800" title="إصدار شهادة">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center py-8 text-gray-500">لا توجد تسجيلات</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $enrollments->withQueryString()->links() }}</div>
</div>
@endsection
