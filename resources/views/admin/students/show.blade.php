@extends('layouts.admin')
@section('title', $student->localized_name)
@section('page-title', __('messages.students.student_data') . ': ' . $student->localized_name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $student->localized_name }}</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.students.id_number') }}:</span><span class="font-medium" dir="ltr">{{ $student->id_number }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.students.phone') }}:</span><span class="font-medium" dir="ltr">{{ $student->phone }}</span></div>
                @if($student->email)
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.students.email') }}:</span><span class="font-medium text-xs" dir="ltr">{{ $student->email }}</span></div>
                @endif
                @if($student->gender)
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.students.gender') }}:</span><span class="font-medium">{{ $student->gender === 'ذكر' ? __('messages.students.male') : __('messages.students.female') }}</span></div>
                @endif
                @if($student->date_of_birth)
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.students.date_of_birth') }}:</span><span class="font-medium">{{ $student->date_of_birth->format('Y/m/d') }}</span></div>
                @endif
                @if($student->address)
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.students.address') }}:</span><span class="font-medium">{{ $student->localized_address }}</span></div>
                @endif
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.status') }}:</span>
                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $student->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $student->is_active ? __('messages.active') : __('messages.inactive') }}
                    </span>
                </div>
                <div class="flex justify-between"><span class="text-gray-500">{{ __('messages.students.registration_date') }}:</span><span class="font-medium">{{ $student->created_at->format('Y/m/d') }}</span></div>
            </div>
            <div class="mt-4 pt-4 border-t flex gap-2">
                @admin
                <a href="{{ route('admin.students.edit', $student) }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-600 transition">{{ __('messages.edit') }}</a>
                @endadmin
                <a href="{{ route('admin.enrollments.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition">{{ __('messages.enrollments.add') }}</a>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-5 border-b border-gray-100">
                <h2 class="font-bold text-gray-800">{{ __('messages.students.enrolled_courses') }} ({{ $student->enrollments->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.course') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.amount') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.payment_status') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.status') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.date') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($student->enrollments as $enrollment)
                            @php
                                $payColors = ['مدفوع' => 'bg-green-100 text-green-700', 'جزئي' => 'bg-yellow-100 text-yellow-700', 'غير مدفوع' => 'bg-red-100 text-red-700'];
                                $payLabels = ['مدفوع' => __('messages.enrollments.paid'), 'جزئي' => __('messages.enrollments.partial'), 'غير مدفوع' => __('messages.enrollments.unpaid')];
                                $statusColors = ['مسجل' => 'bg-blue-100 text-blue-700', 'مكتمل' => 'bg-green-100 text-green-700', 'منسحب' => 'bg-red-100 text-red-700', 'مؤجل' => 'bg-yellow-100 text-yellow-700'];
                                $statusLabels = ['مسجل' => __('messages.enrollments.registered'), 'مكتمل' => __('messages.enrollments.completed'), 'منسحب' => __('messages.enrollments.withdrawn'), 'مؤجل' => __('messages.enrollments.postponed')];
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3"><a href="{{ route('admin.courses.show', $enrollment->course) }}" class="text-blue-600 hover:text-blue-800">{{ $enrollment->course->localized_name }}</a></td>
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
                            <tr><td colspan="5" class="text-center py-8 text-gray-500">{{ __('messages.students.no_enrolled_courses') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($student->certificates->count() > 0)
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-5 border-b border-gray-100">
                <h2 class="font-bold text-gray-800">{{ __('messages.certificates.title') }} ({{ $student->certificates->count() }})</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.certificates.certificate_number') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.enrollments.course') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.certificates.grade') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.certificates.issued_at') }}</th>
                            <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.print') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($student->certificates as $cert)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-mono text-xs" dir="ltr">{{ $cert->certificate_number }}</td>
                                <td class="px-4 py-3">{{ $cert->course->localized_name }}</td>
                                <td class="px-4 py-3">{{ $cert->grade ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $cert->issued_at->format('Y/m/d') }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.certificates.print', $cert) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs">{{ __('messages.print') }}</a>
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
