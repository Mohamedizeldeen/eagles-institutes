@extends('layouts.admin')
@section('title', $student->name)
@section('page-title', 'بيانات الطالب: ' . $student->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $student->name }}</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">رقم الهوية:</span><span class="font-medium" dir="ltr">{{ $student->id_number }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">الهاتف:</span><span class="font-medium" dir="ltr">{{ $student->phone }}</span></div>
                @if($student->email)
                <div class="flex justify-between"><span class="text-gray-500">البريد:</span><span class="font-medium text-xs" dir="ltr">{{ $student->email }}</span></div>
                @endif
                @if($student->gender)
                <div class="flex justify-between"><span class="text-gray-500">الجنس:</span><span class="font-medium">{{ $student->gender }}</span></div>
                @endif
                @if($student->date_of_birth)
                <div class="flex justify-between"><span class="text-gray-500">تاريخ الميلاد:</span><span class="font-medium">{{ $student->date_of_birth->format('Y/m/d') }}</span></div>
                @endif
                @if($student->address)
                <div class="flex justify-between"><span class="text-gray-500">العنوان:</span><span class="font-medium">{{ $student->address }}</span></div>
                @endif
                <div class="flex justify-between"><span class="text-gray-500">الحالة:</span>
                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $student->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $student->is_active ? 'نشط' : 'غير نشط' }}
                    </span>
                </div>
                <div class="flex justify-between"><span class="text-gray-500">تاريخ التسجيل:</span><span class="font-medium">{{ $student->created_at->format('Y/m/d') }}</span></div>
            </div>
            <div class="mt-4 pt-4 border-t flex gap-2">
                <a href="{{ route('admin.students.edit', $student) }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-600 transition">تعديل</a>
                <a href="{{ route('admin.enrollments.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition">تسجيل في دورة</a>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        {{-- الدورات المسجل فيها --}}
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-5 border-b border-gray-100">
                <h2 class="font-bold text-gray-800">الدورات ({{ $student->enrollments->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">الدورة</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">المبلغ</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">حالة الدفع</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">الحالة</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($student->enrollments as $enrollment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3"><a href="{{ route('admin.courses.show', $enrollment->course) }}" class="text-blue-600 hover:text-blue-800">{{ $enrollment->course->name }}</a></td>
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
                            <tr><td colspan="5" class="text-center py-8 text-gray-500">لا توجد دورات مسجلة</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- الشهادات --}}
        @if($student->certificates->count() > 0)
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-5 border-b border-gray-100">
                <h2 class="font-bold text-gray-800">الشهادات ({{ $student->certificates->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">رقم الشهادة</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">الدورة</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">التقدير</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">تاريخ الإصدار</th>
                            <th class="text-right px-4 py-3 font-medium text-gray-600">طباعة</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($student->certificates as $cert)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-mono text-xs" dir="ltr">{{ $cert->certificate_number }}</td>
                                <td class="px-4 py-3">{{ $cert->course->name }}</td>
                                <td class="px-4 py-3">{{ $cert->grade ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $cert->issued_at->format('Y/m/d') }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.certificates.print', $cert) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs">طباعة</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
