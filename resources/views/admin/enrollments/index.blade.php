@extends('layouts.admin')
@section('title', __('messages.enrollments.title'))
@section('page-title', __('messages.enrollments.title'))

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form action="{{ route('admin.enrollments.index') }}" method="GET" class="flex gap-3 items-center flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.enrollments.search_placeholder') }}"
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none w-48">
        <select name="course_id" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">{{ __('messages.enrollments.all_courses') }}</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->localized_name }}</option>
            @endforeach
        </select>
        <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">{{ __('messages.enrollments.all_statuses') }}</option>
            <option value="مسجل" {{ request('status') === 'مسجل' ? 'selected' : '' }}>{{ __('messages.enrollments.registered') }}</option>
            <option value="مكتمل" {{ request('status') === 'مكتمل' ? 'selected' : '' }}>{{ __('messages.enrollments.completed') }}</option>
            <option value="منسحب" {{ request('status') === 'منسحب' ? 'selected' : '' }}>{{ __('messages.enrollments.withdrawn') }}</option>
            <option value="مؤجل" {{ request('status') === 'مؤجل' ? 'selected' : '' }}>{{ __('messages.enrollments.postponed') }}</option>
        </select>
        <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300 transition">{{ __('messages.search') }}</button>
    </form>
    <a href="{{ route('admin.enrollments.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        {{ __('messages.enrollments.new_enrollment') }}
    </a>
</div>

@php
    $payColors = ['مدفوع' => 'bg-green-100 text-green-700', 'جزئي' => 'bg-yellow-100 text-yellow-700', 'غير مدفوع' => 'bg-red-100 text-red-700'];
    $payLabels = ['مدفوع' => __('messages.enrollments.paid'), 'جزئي' => __('messages.enrollments.partial'), 'غير مدفوع' => __('messages.enrollments.unpaid')];
    $statusColors = ['مسجل' => 'bg-blue-100 text-blue-700', 'مكتمل' => 'bg-green-100 text-green-700', 'منسحب' => 'bg-red-100 text-red-700', 'مؤجل' => 'bg-yellow-100 text-yellow-700'];
    $statusLabels = ['مسجل' => __('messages.enrollments.registered'), 'مكتمل' => __('messages.enrollments.completed'), 'منسحب' => __('messages.enrollments.withdrawn'), 'مؤجل' => __('messages.enrollments.postponed')];
@endphp

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">#</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.student') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.course') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.amount') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.payment_status') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.status') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.date') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($enrollments as $enrollment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $enrollment->id }}</td>
                        <td class="px-4 py-3 font-medium">
                            <a href="{{ route('admin.students.show', $enrollment->student) }}" class="text-blue-600 hover:text-blue-800">{{ $enrollment->student->localized_name }}</a>
                        </td>
                        <td class="px-4 py-3">{{ $enrollment->course->localized_name }}</td>
                        <td class="px-4 py-3">{{ number_format($enrollment->amount_paid, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs rounded-full {{ $payColors[$enrollment->payment_status] ?? '' }}">{{ $payLabels[$enrollment->payment_status] ?? $enrollment->payment_status }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs rounded-full {{ $statusColors[$enrollment->status] ?? '' }}">{{ $statusLabels[$enrollment->status] ?? $enrollment->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $enrollment->enrolled_at->format('Y/m/d') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                @admin
                                <a href="{{ route('admin.enrollments.edit', $enrollment) }}" class="text-amber-600 hover:text-amber-800" title="{{ __('messages.edit') }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                @if($enrollment->status === 'مسجل')
                                    <form action="{{ route('admin.enrollments.complete', $enrollment) }}" method="POST" onsubmit="return confirm('{{ __('messages.enrollments.complete_course') }}?')" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800" title="{{ __('messages.enrollments.complete_course') }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </button>
                                    </form>
                                @endif
                                @if($enrollment->status === 'مكتمل' && !$enrollment->certificate)
                                    <a href="{{ route('admin.certificates.create') }}?enrollment_id={{ $enrollment->id }}" class="text-purple-600 hover:text-purple-800" title="{{ __('messages.certificates.add') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                    </a>
                                @endif
                                @endadmin
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center py-8 text-gray-500">{{ __('messages.enrollments.no_enrollments') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">{{ $enrollments->withQueryString()->links() }}</div>
</div>
@endsection
