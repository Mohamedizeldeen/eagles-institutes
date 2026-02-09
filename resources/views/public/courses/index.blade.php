@extends('layouts.app')

@section('title', 'الدورات التدريبية')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-bl from-[#db4047] to-[#112c71] text-gray-200 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">الدورات التدريبية</h1>
            <p class="text-xl text-primary-100 max-w-2xl mx-auto">اكتشف مجموعة متنوعة من الدورات التدريبية المصممة لتناسب جميع المستويات</p>
        </div>
    </section>

    {{-- Filters --}}
    <section class="bg-white border-b shadow-sm sticky top-0 z-20">
        <div class="container mx-auto px-4 py-4">
            <form method="GET" action="{{ route('public.courses') }}" class="flex flex-col sm:flex-row gap-4 items-center justify-center">
                <div class="flex gap-2 flex-wrap justify-center">
                    <a href="{{ route('public.courses') }}" class="px-4 py-2 rounded-lg font-semibold text-sm transition-colors {{ !request('level') ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        الكل
                    </a>
                    <a href="{{ route('public.courses', ['level' => 'مبتدئ']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm transition-colors {{ request('level') === 'مبتدئ' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        مبتدئ
                    </a>
                    <a href="{{ route('public.courses', ['level' => 'متوسط']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm transition-colors {{ request('level') === 'متوسط' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        متوسط
                    </a>
                    <a href="{{ route('public.courses', ['level' => 'متقدم']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm transition-colors {{ request('level') === 'متقدم' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        متقدم
                    </a>
                </div>
            </form>
        </div>
    </section>

    {{-- Courses Grid --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
                            @if($course->image)
                                <div class="h-52 overflow-hidden">
                                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="h-52 bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                        @if($course->level === 'مبتدئ') bg-green-100 text-green-700
                                        @elseif($course->level === 'متوسط') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ $course->level }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $course->duration_hours }} ساعة</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-primary-600 transition-colors">{{ $course->name }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $course->description }}</p>

                                @if($course->start_date)
                                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>يبدأ في: {{ \Carbon\Carbon::parse($course->start_date)->format('Y/m/d') }}</span>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <span class="text-2xl font-bold text-primary-600">{{ number_format($course->price) }} <span class="text-sm text-gray-500">ر.س</span></span>
                                    <a href="{{ route('public.courses.show', $course) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2 rounded-lg font-semibold transition-colors">
                                        التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $courses->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-500 mb-2">لا توجد دورات حالياً</h3>
                    <p class="text-gray-400">تابعنا لمعرفة آخر الدورات المتاحة</p>
                </div>
            @endif
        </div>
    </section>
@endsection
