@extends('layouts.admin')
@section('title', $course->localized_name)
@section('page-title', __('messages.courses.course_details') . ': ' . $course->localized_name)

@section('content')
@php
    $payColors = ['مدفوع' => 'bg-green-100 text-green-700', 'جزئي' => 'bg-yellow-100 text-yellow-700', 'غير مدفوع' => 'bg-red-100 text-red-700'];
    $payLabels = ['مدفوع' => __('messages.enrollments.paid'), 'جزئي' => __('messages.enrollments.partial'), 'غير مدفوع' => __('messages.enrollments.unpaid')];
    $statusColors = ['مسجل' => 'bg-blue-100 text-blue-700', 'مكتمل' => 'bg-green-100 text-green-700', 'منسحب' => 'bg-red-100 text-red-700', 'مؤجل' => 'bg-yellow-100 text-yellow-700'];
    $statusLabels = ['مسجل' => __('messages.enrollments.registered'), 'مكتمل' => __('messages.enrollments.completed'), 'منسحب' => __('messages.enrollments.withdrawn'), 'مؤجل' => __('messages.enrollments.postponed')];
@endphp
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Course Information --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-5">
            @if($course->image)
                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->localized_name }}" class="w-full h-48 object-cover rounded-lg mb-4">
            @endif
            <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $course->localized_name }}</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.courses.level') }}:</span><span class="font-medium">{{ $course->localized_level }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.courses.price') }}:</span><span class="font-medium">{{ number_format($course->price, 2) }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.courses.duration') }}:</span><span class="font-medium">{{ $course->duration_hours }} {{ __('messages.courses.hours') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.courses.max_students') }}:</span><span class="font-medium">{{ $course->max_students ?? __('messages.students.not_specified') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.courses.start_date') }}:</span><span class="font-medium">{{ $course->start_date?->format('Y/m/d') ?? '-' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.courses.end_date') }}:</span><span class="font-medium">{{ $course->end_date?->format('Y/m/d') ?? '-' }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.status') }}:</span>
                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $course->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $course->is_active ? __('messages.courses.active_status') : __('messages.courses.inactive_status') }}
                    </span>
                </div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.courses.enrolled_students') }}:</span><span class="font-medium">{{ $course->enrollments->count() }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.courses.revenue') }}:</span><span class="font-medium">{{ number_format($course->totalRevenue(), 2) }}</span></div>
            </div>
            @if($course->localized_description)
                <div class="mt-4 pt-4 border-t">
                    <h3 class="font-medium text-gray-700 mb-2">{{ __('messages.courses.description') }}:</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $course->localized_description }}</p>
                </div>
            @endif
            <div class="mt-4 pt-4 border-t flex gap-2">
                @admin
                <a href="{{ route('admin.courses.edit', $course) }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-600 transition">{{ __('messages.edit') }}</a>
                @endadmin
                <a href="{{ route('admin.enrollments.create') }}?course_id={{ $course->id }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition">{{ __('messages.enrollments.add') }}</a>
            </div>
        </div>
    </div>

    {{-- Enrolled Students --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-5 border-b border-gray-100">
                <h2 class="font-bold text-gray-800">{{ __('messages.courses.enrolled_students') }} ({{ $course->enrollments->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.student') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.amount_paid') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.payment_status') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.status') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.enrolled_at') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($course->enrollments as $enrollment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.students.show', $enrollment->student) }}" class="text-blue-600 hover:text-blue-800 font-medium">{{ $enrollment->student->localized_name }}</a>
                                </td>
                                <td class="px-4 py-3">{{ number_format($enrollment->amount_paid, 2) }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $payColors[$enrollment->payment_status] ?? '' }}">{{ $payLabels[$enrollment->payment_status] ?? $enrollment->payment_status }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $statusColors[$enrollment->status] ?? '' }}">{{ $statusLabels[$enrollment->status] ?? $enrollment->status }}</span>
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $enrollment->enrolled_at->format('Y/m/d') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-8 text-gray-500">{{ __('messages.courses.no_enrolled') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
