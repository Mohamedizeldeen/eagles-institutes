@extends('layouts.admin')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم')

@section('content')
{{-- بطاقات الإحصائيات --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-5 border-r-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">إجمالي الطلاب</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['total_students']) }}</p>
                <p class="text-xs text-green-600 mt-1">{{ $stats['active_students'] }} نشط</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 border-r-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">الدورات النشطة</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['active_courses']) }}</p>
                <p class="text-xs text-gray-500 mt-1">من {{ $stats['total_courses'] }} دورة</p>
            </div>
            <div class="bg-green-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 border-r-4 border-amber-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">التسجيلات النشطة</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['active_enrollments']) }}</p>
                <p class="text-xs text-gray-500 mt-1">من {{ $stats['total_enrollments'] }} تسجيل</p>
            </div>
            <div class="bg-amber-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-5 border-r-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">الإيرادات الشهرية</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($stats['monthly_revenue'], 2) }}</p>
                <p class="text-xs text-gray-500 mt-1">الإجمالي: {{ number_format($stats['total_revenue'], 2) }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- آخر التسجيلات --}}
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-bold text-gray-800">آخر التسجيلات</h2>
            <a href="{{ route('admin.enrollments.index') }}" class="text-sm text-blue-600 hover:text-blue-800">عرض الكل</a>
        </div>
        <div class="p-5">
            @forelse($recentEnrollments as $enrollment)
                <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <div>
                        <p class="font-medium text-gray-800">{{ $enrollment->student->name }}</p>
                        <p class="text-sm text-gray-500">{{ $enrollment->course->name }}</p>
                    </div>
                    <div class="text-left">
                        <span class="inline-block px-2 py-1 text-xs rounded-full
                            {{ $enrollment->status === 'مسجل' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $enrollment->status === 'مكتمل' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $enrollment->status === 'منسحب' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $enrollment->status === 'مؤجل' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        ">{{ $enrollment->status }}</span>
                        <p class="text-xs text-gray-400 mt-1">{{ $enrollment->enrolled_at->format('Y/m/d') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">لا توجد تسجيلات حتى الآن</p>
            @endforelse
        </div>
    </div>

    {{-- آخر الطلاب --}}
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-bold text-gray-800">آخر الطلاب المسجلين</h2>
            <a href="{{ route('admin.students.index') }}" class="text-sm text-blue-600 hover:text-blue-800">عرض الكل</a>
        </div>
        <div class="p-5">
            @forelse($recentStudents as $student)
                <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <div>
                        <p class="font-medium text-gray-800">{{ $student->name }}</p>
                        <p class="text-sm text-gray-500">{{ $student->phone }}</p>
                    </div>
                    <p class="text-xs text-gray-400">{{ $student->created_at->format('Y/m/d') }}</p>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">لا يوجد طلاب حتى الآن</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
