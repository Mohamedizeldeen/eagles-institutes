@extends('layouts.admin')
@section('title', 'تفاصيل الشهادة')
@section('page-title', 'تفاصيل الشهادة')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="space-y-4 text-sm">
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">رقم الشهادة:</span><span class="font-mono" dir="ltr">{{ $certificate->certificate_number }}</span></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">الطالب:</span><a href="{{ route('admin.students.show', $certificate->student) }}" class="text-blue-600 hover:text-blue-800">{{ $certificate->student->name }}</a></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">الدورة:</span><a href="{{ route('admin.courses.show', $certificate->course) }}" class="text-blue-600 hover:text-blue-800">{{ $certificate->course->name }}</a></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">المستوى:</span><span>{{ $certificate->course->level }}</span></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">التقدير:</span><span>{{ $certificate->grade ?? '-' }}</span></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">تاريخ الإصدار:</span><span>{{ $certificate->issued_at->format('Y/m/d') }}</span></div>
            @if($certificate->notes)
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">ملاحظات:</span><span>{{ $certificate->notes }}</span></div>
            @endif
        </div>
        <div class="flex gap-3 mt-6 pt-6 border-t">
            <a href="{{ route('admin.certificates.print', $certificate) }}" target="_blank" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition">طباعة الشهادة</a>
            <a href="{{ route('admin.certificates.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2">العودة</a>
        </div>
    </div>
</div>
@endsection
