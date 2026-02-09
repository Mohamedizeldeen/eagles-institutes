@extends('layouts.admin')
@section('title', 'التقارير المالية')
@section('page-title', 'التقارير المالية')

@section('content')
{{-- فلتر السنة --}}
<div class="mb-6">
    <form action="{{ route('admin.reports.index') }}" method="GET" class="flex gap-3 items-center">
        <label class="text-sm text-gray-600">السنة:</label>
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
        <p class="text-sm text-gray-500">إجمالي الإيرادات</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_revenue'], 2) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">إيرادات {{ $year }}</p>
        <p class="text-2xl font-bold text-blue-700 mt-1">{{ number_format($stats['yearly_revenue'], 2) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">إجمالي التسجيلات</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_enrollments'] }}</p>
        <p class="text-xs text-green-600 mt-1">{{ $stats['completed_enrollments'] }} مكتمل</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5">
        <p class="text-sm text-gray-500">طلاب جدد هذا الشهر</p>
        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['new_students_this_month'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    {{-- الإيرادات الشهرية --}}
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-5 border-b border-gray-100">
            <h2 class="font-bold text-gray-800">الإيرادات الشهرية - {{ $year }}</h2>
        </div>
        <div class="p-5">
            @php
                $months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
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
            <h2 class="font-bold text-gray-800">حالة الدفع</h2>
        </div>
        <div class="p-5">
            <div class="space-y-4">
                @foreach($paymentStats as $status => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">{{ $status }}</span>
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

            <h3 class="font-medium text-gray-700 mb-3">التسجيلات حسب المستوى</h3>
            <div class="space-y-3">
                @foreach($levelStats as $level => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">{{ $level }}</span>
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
        <h2 class="font-bold text-gray-800">إيرادات الدورات</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الدورة</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">المستوى</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">السعر</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">عدد الطلاب</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-600">الإيرادات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($courseRevenue as $course)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $course->name }}</td>
                        <td class="px-4 py-3">{{ $course->level }}</td>
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
