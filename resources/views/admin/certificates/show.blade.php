@extends('layouts.admin')
@section('title', __('messages.certificates.certificate_details'))
@section('page-title', __('messages.certificates.certificate_details'))

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="space-y-4 text-sm">
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">{{ __('messages.certificates.certificate_number') }}:</span><span class="font-mono" dir="ltr">{{ $certificate->certificate_number }}</span></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">{{ __('messages.enrollments.student') }}:</span><a href="{{ route('admin.students.show', $certificate->student) }}" class="text-blue-600 hover:text-blue-800">{{ $certificate->student->localized_name }}</a></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">{{ __('messages.enrollments.course') }}:</span><a href="{{ route('admin.courses.show', $certificate->course) }}" class="text-blue-600 hover:text-blue-800">{{ $certificate->course->localized_name }}</a></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">{{ __('messages.courses.level') }}:</span><span>{{ $certificate->course->level }}</span></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">{{ __('messages.certificates.grade') }}:</span><span>{{ $certificate->grade ? __('messages.certificates.grades.' . $certificate->grade) : '-' }}</span></div>
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">{{ __('messages.certificates.issued_at') }}:</span><span>{{ $certificate->issued_at->format('Y/m/d') }}</span></div>
            @if($certificate->notes)
            <div class="flex justify-between py-2 border-b"><span class="text-gray-500 font-medium">{{ __('messages.notes') }}:</span><span>{{ $certificate->notes }}</span></div>
            @endif
        </div>
        <div class="flex gap-3 mt-6 pt-6 border-t">
            <a href="{{ route('admin.certificates.print', $certificate) }}" target="_blank" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition">{{ __('messages.certificates.print') }}</a>
            <a href="{{ route('admin.certificates.index') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2">{{ __('messages.back') }}</a>
        </div>
    </div>
</div>
@endsection
