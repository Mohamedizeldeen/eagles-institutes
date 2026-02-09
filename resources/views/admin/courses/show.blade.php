@extends('layouts.admin')
@section('title', $course->name)
@section('page-title', 'تفاصيل الدورة: ' . $course->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- معلومات الدورة --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-5">
            @if($course->image)
                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
            @endif
            <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $course->name }}</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">المستوى:</span><span class="font-medium">{{ $course->level }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">السعر:</span><span class="font-medium">{{ number_format($course->price, 2) }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">المدة:</span><span class="font-medium">{{ $course->duration_hours }} ساعة</span></div>
                <div class="flex justify-between"><span class="text-gray-500">الحد الأقصى:</span><span class="font-medium">{{ $course->max_students ?? 'غير محدد' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">تاريخ البداية:</span><span class="font-medium">{{ $course->start_date?->format('Y/m/d') ?? '-' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">تاريخ النهاية:</span><span class="font-medium">{{ $course->end_date?->format('Y/m/d') ?? '-' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">الحالة:</span>
                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $course->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $course->is_active ? 'نشطة' : 'متوقفة' }}
                    </span>
                </div>
                <div class="flex justify-between"><span class="text-gray-500">عدد المسجلين:</span><span class="font-medium">{{ $course->enrollments->count() }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">الإيرادات:</span><span class="font-medium">{{ number_format($course->totalRevenue(), 2) }}</span></div>
            </div>
            @if($course->description)
                <div class="mt-4 pt-4 border-t">
                    <h3 class="font-medium text-gray-700 mb-2">الوصف:</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $course->description }}</p>
                </div>
            @endif
            <div class="mt-4 pt-4 border-t flex gap-2">
                <a href="{{ route('admin.courses.edit', $course) }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-600 transition">تعديل</a>
                <a href="{{ route('admin.enrollments.create') }}?course_id={{ $course->id }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition">تسجيل طالب</a>
            </div>
        </div>
    </div>

    {{-- الطلاب المسجلين --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-5 border-b border-gray-100">
                <h2 class="font-bold text-gray-800">الطلاب المسجلين ({{ $course->enrollments->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">الطالب</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">المبلغ المدفوع</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">حالة الدفع</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">الحالة</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">تاريخ التسجيل</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($course->enrollments as $enrollment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.students.show', $enrollment->student) }}" class="text-blue-600 hover:text-blue-800 font-medium">{{ $enrollment->student->name }}</a>
                                </td>
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
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-8 text-gray-500">لا يوجد طلاب مسجلين</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
