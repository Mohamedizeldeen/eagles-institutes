@extends('layouts.app')

@section('title', $course->localized_name)

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a] text-white py-16 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('public.courses') }}" class="inline-flex items-center gap-2 text-blue-300 hover:text-white mb-6 transition-colors font-medium">
                    <svg class="w-5 h-5 {{ $isRtl ? '' : 'rotate-180' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    {{ __('messages.public.back_to_courses') }}
                </a>
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center px-4 py-1.5 text-sm font-bold rounded-full
                        @if($course->level === 'مبتدئ') bg-emerald-500/20 text-emerald-200 ring-1 ring-emerald-400/30
                        @elseif($course->level === 'متوسط') bg-amber-500/20 text-amber-200 ring-1 ring-amber-400/30
                        @else bg-rose-500/20 text-rose-200 ring-1 ring-rose-400/30
                        @endif">
                        {{ $course->localized_level }}
                    </span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold mb-4">{{ $course->localized_name }}</h1>
            </div>
        </div>
    </section>

    {{-- Course Content --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Main Content --}}
                    <div class="lg:col-span-2 space-y-8">
                        @if($course->image)
                            <div class="rounded-3xl overflow-hidden shadow-lg">
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->localized_name }}" class="w-full h-80 object-cover">
                            </div>
                        @endif

                        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                            <h2 class="text-2xl font-extrabold text-gray-900 mb-4">{{ __('messages.courses.about_course') }}</h2>
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                {!! nl2br(e($course->localized_description)) !!}
                            </div>
                        </div>

                        {{-- What You'll Learn --}}
                        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">{{ __('messages.courses.what_you_learn') }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @php
                                    $levelKey = match($course->level) {
                                        'مبتدئ' => 'beginner',
                                        'متوسط' => 'intermediate',
                                        'متقدم' => 'advanced',
                                        default => 'beginner'
                                    };
                                    $learnItems = __('messages.learn.' . $levelKey);
                                @endphp
                                @if(is_array($learnItems))
                                    @foreach($learnItems as $item)
                                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                                            <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                            </div>
                                            <span class="text-gray-700 font-medium">{{ $item }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <div class="space-y-6">
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 sticky top-24">
                            <div class="text-center mb-6 pb-6 border-b border-gray-100">
                                <div class="text-4xl font-extrabold text-gray-900 mb-1">{{ number_format($course->price) }}</div>
                                <span class="text-gray-400 font-medium">{{ __('messages.courses.sar') }}</span>
                            </div>

                            <div class="space-y-0 mb-6">
                                <div class="flex items-center justify-between py-4 border-b border-gray-50">
                                    <span class="text-gray-500 flex items-center gap-2 text-sm">
                                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ __('messages.courses.duration_label') }}
                                    </span>
                                    <span class="font-bold text-gray-900">{{ $course->duration_hours }} {{ __('messages.courses.hours') }}</span>
                                </div>
                                <div class="flex items-center justify-between py-4 border-b border-gray-50">
                                    <span class="text-gray-500 flex items-center gap-2 text-sm">
                                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        {{ __('messages.courses.level_label') }}
                                    </span>
                                    <span class="font-bold text-gray-900">{{ $course->localized_level }}</span>
                                </div>
                                @if($course->start_date)
                                <div class="flex items-center justify-between py-4 border-b border-gray-50">
                                    <span class="text-gray-500 flex items-center gap-2 text-sm">
                                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ __('messages.courses.start_date_label') }}
                                    </span>
                                    <span class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($course->start_date)->format('Y/m/d') }}</span>
                                </div>
                                @endif
                                @if($course->end_date)
                                <div class="flex items-center justify-between py-4 border-b border-gray-50">
                                    <span class="text-gray-500 flex items-center gap-2 text-sm">
                                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ __('messages.courses.end_date_label') }}
                                    </span>
                                    <span class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($course->end_date)->format('Y/m/d') }}</span>
                                </div>
                                @endif
                                @if($course->max_students)
                                <div class="flex items-center justify-between py-4">
                                    <span class="text-gray-500 flex items-center gap-2 text-sm">
                                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ __('messages.courses.max_students_label') }}
                                    </span>
                                    <span class="font-bold text-gray-900">{{ $course->max_students }} {{ __('messages.courses.student_unit') }}</span>
                                </div>
                                @endif
                            </div>

                            <a href="{{ route('public.contact') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-4 rounded-2xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/25 text-lg">
                                {{ __('messages.courses.register_now') }}
                            </a>
                            <p class="text-center text-sm text-gray-400 mt-3">{{ __('messages.courses.contact_to_register') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
