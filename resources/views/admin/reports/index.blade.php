@extends('layouts.admin')
@section('title', __('messages.reports.title'))
@section('page-title', __('messages.reports.title'))

@section('content')
{{-- فلتر السنة --}}
<div class="mb-6">
    <form action="{{ route('admin.reports.index') }}" method="GET" class="flex gap-3 items-center">
        <label class="text-sm text-gray-600">{{ __('messages.reports.year') }}:</label>
        <select name="year" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
    </form>
</div>

{{-- بطاقات الإحصائيات --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">{{ __('messages.reports.total_revenue') }}</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_revenue'], 2) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">{{ __('messages.reports.yearly_revenue', ['year' => $year]) }}</p>
        <p class="text-2xl font-bold text-blue-700 mt-1">{{ number_format($stats['yearly_revenue'], 2) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">{{ __('messages.reports.total_enrollments') }}</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_enrollments'] }}</p>
        <p class="text-xs text-green-600 mt-1">{{ $stats['completed_enrollments'] }} {{ __('messages.reports.completed_label') }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">{{ __('messages.reports.new_students_month') }}</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['new_students_this_month'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    {{-- الإيرادات الشهرية --}}
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-5 border-b border-gray-100">
            <h2 class="font-bold text-gray-800">{{ __('messages.reports.monthly_revenue') }} - {{ $year }}</h2>
        </div>
        <div class="p-5">
            @php
                $months = array_map(fn($i) => __("messages.months.$i"), range(0, 11));
                $maxRevenue = max($monthlyRevenue) ?: 1;
            @endphp
            <div class="space-y-2">
                @for($m = 1; $m <= 12; $m++)
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-500 w-14">{{ $months[$m - 1] }}</span>
                        <div class="flex-1 bg-gray-100 rounded-full h-6 overflow-hidden">
                            <div class="bg-blue-600 h-full rounded-full flex items-center justify-end px-2 text-xs text-white font-medium transition-all"
                                 style="width: {{ ($monthlyRevenue[$m] / $maxRevenue) * 100 }}%; min-width: {{ $monthlyRevenue[$m] > 0 ? '40px' : '0' }}">
                                {{ $monthlyRevenue[$m] > 0 ? number_format($monthlyRevenue[$m], 0) : '' }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    {{-- حالة الدفع --}}
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-5 border-b border-gray-100">
            <h2 class="font-bold text-gray-800">{{ __('messages.reports.payment_stats') }}</h2>
        </div>
        <div class="p-5">
            @php
                $payLabels = [
                    'مدفوع' => __('messages.enrollments.paid'),
                    'جزئي' => __('messages.enrollments.partial'),
                    'غير مدفوع' => __('messages.enrollments.unpaid'),
                ];
            @endphp
            <div class="space-y-4">
                @foreach($paymentStats as $status => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">{{ $payLabels[$status] ?? $status }}</span>
                        <div class="flex items-center gap-3">
                            <div class="w-32 bg-gray-100 rounded-full h-3 overflow-hidden">
                                @php $total = array_sum($paymentStats) ?: 1; @endphp
                                <div class="h-full rounded-full {{ $status === 'مدفوع' ? 'bg-green-500' : ($status === 'جزئي' ? 'bg-yellow-500' : 'bg-red-500') }}"
                                     style="width: {{ ($count / $total) * 100 }}%"></div>
                            </div>
                            <span class="text-sm font-bold text-gray-800">{{ $count }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr class="my-6">

            <h3 class="font-medium text-gray-700 mb-3">{{ __('messages.reports.by_level') }}</h3>
            @php
                $levelLabels = [
                    'مبتدئ' => __('messages.courses.beginner'),
                    'متوسط' => __('messages.courses.intermediate'),
                    'متقدم' => __('messages.courses.advanced'),
                ];
            @endphp
            <div class="space-y-3">
                @foreach($levelStats as $level => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">{{ $levelLabels[$level] ?? $level }}</span>
                        <span class="text-sm font-bold text-gray-800">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- إيرادات كل دورة --}}
<div class="bg-white rounded-xl shadow-sm">
    <div class="p-5 border-b border-gray-100">
        <h2 class="font-bold text-gray-800">{{ __('messages.reports.course_revenue') }}</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.reports.course_name') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.courses.level') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.courses.price') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.reports.students_count') }}</th>
                    <th class="{{ $textAlign === 'right' ? 'text-right' : 'text-left' }} px-4 py-3 font-medium text-gray-600">{{ __('messages.courses.revenue') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($courseRevenue as $course)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $course->localized_name }}</td>
                        <td class="px-4 py-3">{{ $course->localized_level }}</td>
                        <td class="px-4 py-3">{{ number_format($course->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $course->enrollments_count }}</td>
                        <td class="px-4 py-3 font-bold text-green-700">{{ number_format($course->revenue, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
