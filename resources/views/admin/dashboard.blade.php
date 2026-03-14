@extends('layouts.admin')
@section('title', __('messages.dashboard.title'))
@section('page-title', __('messages.dashboard.title'))

@push('styles')
<style>
    .stat-card-gradient-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stat-card-gradient-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .stat-card-gradient-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .stat-card-gradient-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .chart-card { background: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); }
    .quick-action-btn { transition: all 0.3s cubic-bezier(0.4,0,0.2,1); }
    .quick-action-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.12); }
</style>
@endpush

@section('content')
{{-- Welcome Banner --}}
<div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-2xl p-6 mb-8 text-white relative overflow-hidden">
    <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-64 h-64 bg-white/5 rounded-full -translate-y-32 {{ $isRtl ? '-translate-x-32' : 'translate-x-32' }}"></div>
    <div class="absolute bottom-0 {{ $isRtl ? 'right-0' : 'left-0' }} w-48 h-48 bg-white/5 rounded-full translate-y-24 {{ $isRtl ? 'translate-x-24' : '-translate-x-24' }}"></div>
    <div class="relative z-10">
        <h2 class="text-2xl font-bold mb-1">{{ __('messages.welcome') }}{{ auth()->user()->localized_name ? ', ' . auth()->user()->localized_name : '' }} 👋</h2>
        <p class="text-blue-100 text-sm">{{ __('messages.site.description') }}</p>
    </div>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    {{-- Total Students --}}
    <div class="stat-card stat-card-gradient-1 rounded-2xl p-5 text-white relative overflow-hidden">
        <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-20 h-20 bg-white/10 rounded-full -translate-y-4 {{ $isRtl ? '-translate-x-4' : 'translate-x-4' }}"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-extrabold">{{ number_format($stats['total_students']) }}</p>
            <p class="text-sm text-white/80 mt-1">{{ __('messages.dashboard.total_students') }}</p>
            <p class="text-xs text-white/60 mt-0.5">{{ $stats['active_students'] }} {{ __('messages.dashboard.active_students') }}</p>
        </div>
    </div>

    {{-- Active Courses --}}
    <div class="stat-card stat-card-gradient-3 rounded-2xl p-5 text-white relative overflow-hidden">
        <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-20 h-20 bg-white/10 rounded-full -translate-y-4 {{ $isRtl ? '-translate-x-4' : 'translate-x-4' }}"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            </div>
            <p class="text-3xl font-extrabold">{{ $stats['active_courses'] }}</p>
            <p class="text-sm text-white/80 mt-1">{{ __('messages.dashboard.active_courses') }}</p>
            <p class="text-xs text-white/60 mt-0.5">{{ $stats['total_courses'] }} {{ __('messages.dashboard.of_courses') }}</p>
        </div>
    </div>

    {{-- Active Enrollments --}}
    <div class="stat-card stat-card-gradient-2 rounded-2xl p-5 text-white relative overflow-hidden">
        <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-20 h-20 bg-white/10 rounded-full -translate-y-4 {{ $isRtl ? '-translate-x-4' : 'translate-x-4' }}"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <p class="text-3xl font-extrabold">{{ $stats['active_enrollments'] }}</p>
            <p class="text-sm text-white/80 mt-1">{{ __('messages.dashboard.active_enrollments') }}</p>
            <p class="text-xs text-white/60 mt-0.5">{{ $stats['total_enrollments'] }} {{ __('messages.dashboard.of_enrollments') }}</p>
        </div>
    </div>

    {{-- Monthly Revenue --}}
    <div class="stat-card stat-card-gradient-4 rounded-2xl p-5 text-white relative overflow-hidden">
        <div class="absolute top-0 {{ $isRtl ? 'left-0' : 'right-0' }} w-20 h-20 bg-white/10 rounded-full -translate-y-4 {{ $isRtl ? '-translate-x-4' : 'translate-x-4' }}"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-extrabold">{{ number_format($stats['monthly_revenue'], 0) }}</p>
            <p class="text-sm text-white/80 mt-1">{{ __('messages.dashboard.monthly_revenue') }}</p>
            <p class="text-xs text-white/60 mt-0.5">{{ __('messages.dashboard.total_revenue') }}: {{ number_format($stats['total_revenue'], 0) }}</p>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ __('messages.dashboard.quick_actions') }}</h3>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <a href="{{ route('admin.students.create') }}" class="quick-action-btn bg-white rounded-xl p-5 flex items-center gap-4 border border-gray-100 hover:border-blue-200 group">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">{{ __('messages.dashboard.register_new_student') }}</p>
                <p class="text-xs text-gray-500">{{ __('messages.students.title') }}</p>
            </div>
        </a>
        <a href="{{ route('admin.enrollments.create') }}" class="quick-action-btn bg-white rounded-xl p-5 flex items-center gap-4 border border-gray-100 hover:border-green-200 group">
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center group-hover:bg-green-100 transition">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">{{ __('messages.dashboard.enroll_in_course') }}</p>
                <p class="text-xs text-gray-500">{{ __('messages.enrollments.title') }}</p>
            </div>
        </a>
        <a href="{{ route('admin.certificates.create') }}" class="quick-action-btn bg-white rounded-xl p-5 flex items-center gap-4 border border-gray-100 hover:border-purple-200 group">
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center group-hover:bg-purple-100 transition">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">{{ __('messages.dashboard.print_certificate') }}</p>
                <p class="text-xs text-gray-500">{{ __('messages.certificates.title') }}</p>
            </div>
        </a>
    </div>
</div>

{{-- Charts Row --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    {{-- Enrollment Trends Chart --}}
    <div class="chart-card p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">{{ __('messages.dashboard.enrollment_trends') }}</h3>
        <div class="h-64">
            <canvas id="enrollmentChart"></canvas>
        </div>
    </div>

    {{-- Revenue Overview Chart --}}
    <div class="chart-card p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">{{ __('messages.dashboard.revenue_overview') }}</h3>
        <div class="h-64">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    {{-- Course Distribution Chart --}}
    <div class="chart-card p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">{{ __('messages.dashboard.course_distribution') }}</h3>
        <div class="h-64 flex items-center justify-center">
            <canvas id="courseDistChart"></canvas>
        </div>
    </div>

    {{-- Payment Overview Chart --}}
    <div class="chart-card p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">{{ __('messages.dashboard.payment_overview') }}</h3>
        <div class="h-64 flex items-center justify-center">
            <canvas id="paymentChart"></canvas>
        </div>
    </div>
</div>

{{-- Recent Data --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Recent Enrollments --}}
    <div class="chart-card overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800">{{ __('messages.dashboard.recent_enrollments') }}</h3>
            <a href="{{ route('admin.enrollments.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">{{ __('messages.dashboard.view_all') }} &rarr;</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentEnrollments as $enrollment)
                <div class="px-5 py-4 flex items-center justify-between hover:bg-gray-50/50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center text-blue-700 text-sm font-bold">
                            {{ mb_substr($enrollment->student->localized_name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $enrollment->student->localized_name }}</p>
                            <p class="text-xs text-gray-500">{{ $enrollment->course->localized_name }}</p>
                        </div>
                    </div>
                    <div class="{{ $textAlign === 'right' ? 'text-left' : 'text-right' }}">
                        @php
                            $statusColors = [
                                'مسجل' => 'bg-blue-100 text-blue-700',
                                'مكتمل' => 'bg-green-100 text-green-700',
                                'منسحب' => 'bg-red-100 text-red-700',
                                'مؤجل' => 'bg-yellow-100 text-yellow-700',
                            ];
                            $statusLabels = [
                                'مسجل' => __('messages.enrollments.registered'),
                                'مكتمل' => __('messages.enrollments.completed'),
                                'منسحب' => __('messages.enrollments.withdrawn'),
                                'مؤجل' => __('messages.enrollments.postponed'),
                            ];
                        @endphp
                        <span class="inline-block px-2.5 py-1 text-xs rounded-full font-medium {{ $statusColors[$enrollment->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $statusLabels[$enrollment->status] ?? $enrollment->status }}
                        </span>
                        <p class="text-xs text-gray-400 mt-1">{{ $enrollment->enrolled_at->format('Y/m/d') }}</p>
                    </div>
                </div>
            @empty
                <div class="px-5 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <p class="text-sm">{{ __('messages.dashboard.no_enrollments') }}</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Recent Students --}}
    <div class="chart-card overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800">{{ __('messages.dashboard.recent_students') }}</h3>
            <a href="{{ route('admin.students.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">{{ __('messages.dashboard.view_all') }} &rarr;</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentStudents as $student)
                <div class="px-5 py-4 flex items-center justify-between hover:bg-gray-50/50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center text-purple-700 text-sm font-bold">
                            {{ mb_substr($student->localized_name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $student->localized_name }}</p>
                            <p class="text-xs text-gray-500" dir="ltr">{{ $student->phone }}</p>
                        </div>
                    </div>
                    <div class="{{ $textAlign === 'right' ? 'text-left' : 'text-right' }}">
                        <span class="inline-block px-2.5 py-1 text-xs rounded-full font-medium {{ $student->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $student->is_active ? __('messages.active') : __('messages.inactive') }}
                        </span>
                        <p class="text-xs text-gray-400 mt-1">{{ $student->created_at->format('Y/m/d') }}</p>
                    </div>
                </div>
            @empty
                <div class="px-5 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <p class="text-sm">{{ __('messages.dashboard.no_students') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isRtl = document.documentElement.dir === 'rtl';
    Chart.defaults.font.family = isRtl ? 'Cairo' : 'Inter';

    // Month labels from translation
    const allMonths = @json(array_map(fn($i) => __("messages.months.$i"), range(0, 11)));
    const monthIndices = @json($monthLabels);
    const monthLabels = monthIndices.map(m => allMonths[m - 1]);

    // Enrollment Trends - Line Chart
    new Chart(document.getElementById('enrollmentChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: '{{ __("messages.enrollments.title") }}',
                data: @json($monthlyEnrollments),
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 5,
                pointBackgroundColor: '#6366f1',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Revenue Overview - Bar Chart
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: '{{ __("messages.dashboard.monthly_revenue") }}',
                data: @json($monthlyRevenue),
                backgroundColor: [
                    'rgba(99, 102, 241, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(192, 132, 252, 0.8)',
                    'rgba(126, 34, 206, 0.8)',
                    'rgba(79, 70, 229, 0.8)',
                ],
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Course Distribution - Doughnut
    const levelLabels = @json($levelDistribution);
    const levelTranslations = {
        'مبتدئ': '{{ __("messages.courses.beginner") }}',
        'متوسط': '{{ __("messages.courses.intermediate") }}',
        'متقدم': '{{ __("messages.courses.advanced") }}'
    };
    new Chart(document.getElementById('courseDistChart'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(levelLabels).map(k => levelTranslations[k] || k),
            datasets: [{
                data: Object.values(levelLabels),
                backgroundColor: ['#6366f1', '#f59e0b', '#10b981'],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyleWidth: 10 } }
            }
        }
    });

    // Payment Breakdown - Doughnut
    const paymentLabels = @json($paymentBreakdown);
    const paymentTranslations = {
        'مدفوع': '{{ __("messages.enrollments.paid") }}',
        'جزئي': '{{ __("messages.enrollments.partial") }}',
        'غير مدفوع': '{{ __("messages.enrollments.unpaid") }}'
    };
    new Chart(document.getElementById('paymentChart'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(paymentLabels).map(k => paymentTranslations[k] || k),
            datasets: [{
                data: Object.values(paymentLabels),
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyleWidth: 10 } }
            }
        }
    });
});
</script>
@endpush
