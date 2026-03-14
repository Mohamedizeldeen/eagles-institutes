@extends('layouts.app')

@section('title', __('messages.courses.title'))

@push('styles')
<style>
    .card-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .card-hover:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); }
</style>
@endpush

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a] text-white py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block text-sm font-bold tracking-widest text-blue-300 uppercase mb-3">{{ __('messages.courses.title') }}</span>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4">{{ __('messages.public.our_courses') }}</h1>
            <p class="text-xl text-blue-100/70 max-w-2xl mx-auto">{{ __('messages.public.our_courses_desc') }}</p>
        </div>
    </section>

    {{-- Filters --}}
    <section class="bg-white border-b border-gray-100 shadow-sm sticky top-[80px] z-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex gap-2 flex-wrap justify-center">
                <a href="{{ route('public.courses') }}" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 {{ !request('level') ? 'bg-gray-900 text-white shadow-lg' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ __('messages.all') }}
                </a>
                <a href="{{ route('public.courses', ['level' => 'مبتدئ']) }}" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 {{ request('level') === 'مبتدئ' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/30' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ __('messages.courses.beginner') }}
                </a>
                <a href="{{ route('public.courses', ['level' => 'متوسط']) }}" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 {{ request('level') === 'متوسط' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/30' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ __('messages.courses.intermediate') }}
                </a>
                <a href="{{ route('public.courses', ['level' => 'متقدم']) }}" class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 {{ request('level') === 'متقدم' ? 'bg-rose-600 text-white shadow-lg shadow-rose-500/30' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ __('messages.courses.advanced') }}
                </a>
            </div>
        </div>
    </section>

    {{-- Courses Grid --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="card-hover bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100 group">
                            @if($course->image)
                                <div class="h-56 overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->localized_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                </div>
                            @else
                                <div class="h-56 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700 flex items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>
                                    <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full
                                        @if($course->level === 'مبتدئ') bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200
                                        @elseif($course->level === 'متوسط') bg-amber-50 text-amber-700 ring-1 ring-amber-200
                                        @else bg-rose-50 text-rose-700 ring-1 ring-rose-200
                                        @endif">
                                        {{ $course->localized_level }}
                                    </span>
                                    <span class="text-sm text-gray-400 font-medium">{{ $course->duration_hours }} {{ __('messages.courses.hours') }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $course->localized_name }}</h3>
                                <p class="text-gray-500 mb-4 line-clamp-2 text-sm leading-relaxed">{{ $course->localized_description }}</p>

                                @if($course->start_date)
                                    <div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span>{{ __('messages.courses.starts_on') }}: {{ \Carbon\Carbon::parse($course->start_date)->format('Y/m/d') }}</span>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <span class="text-2xl font-extrabold text-gray-900">{{ number_format($course->price) }}</span>
                                        <span class="text-sm text-gray-400 {{ $isRtl ? 'mr-1' : 'ml-1' }}">{{ __('messages.courses.currency') }}</span>
                                    </div>
                                    <a href="{{ route('public.courses.show', $course) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/25">
                                        {{ __('messages.details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $courses->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-400 mb-2">{{ __('messages.courses.no_courses_available') }}</h3>
                    <p class="text-gray-400">{{ __('messages.courses.follow_us') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection
