@extends('layouts.app')

@section('title', $course->name)

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-bl from-[#db4047] to-[#112c71] text-gray-200  py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('public.courses') }}" class="inline-flex items-center gap-2 text-primary-200 hover:text-white mb-6 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    العودة للدورات
                </a>
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-block px-4 py-1.5 text-sm font-semibold rounded-full
                        @if($course->level === 'مبتدئ') bg-green-500/20 text-green-200 border border-green-400/30
                        @elseif($course->level === 'متوسط') bg-yellow-500/20 text-yellow-200 border border-yellow-400/30
                        @else bg-red-500/20 text-red-200 border border-red-400/30
                        @endif">
                        {{ $course->level }}
                    </span>
                </div>
                <h1 class="text-4xl font-bold mb-4">{{ $course->name }}</h1>
            </div>
        </div>
    </section>

    {{-- Course Content --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Main Content --}}
                    <div class="lg:col-span-2 space-y-8">
                        @if($course->image)
                            <div class="rounded-2xl overflow-hidden shadow-md">
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-80 object-cover">
                            </div>
                        @endif

                        <div class="bg-white rounded-2xl p-8 shadow-sm">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">عن الدورة</h2>
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                {!! nl2br(e($course->description)) !!}
                            </div>
                        </div>

                        {{-- What You'll Learn --}}
                        <div class="bg-white rounded-2xl p-8 shadow-sm">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">ماذا ستتعلم</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($course->level === 'مبتدئ')
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">الحروف الأبجدية والأرقام</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">المفردات الأساسية اليومية</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">القواعد الأساسية وتركيب الجمل</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">المحادثات البسيطة والتعريف بالنفس</span></div>
                                @elseif($course->level === 'متوسط')
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">القواعد المتقدمة والأزمنة</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">مهارات المحادثة والاستماع</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">الكتابة والقراءة بطلاقة</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">توسيع المفردات والمصطلحات</span></div>
                                @else
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">إنجليزية الأعمال والمراسلات</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">مهارات العرض والتقديم</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">الكتابة الأكاديمية والبحثية</span></div>
                                    <div class="flex items-start gap-3"><svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span class="text-gray-600">الطلاقة في المحادثة والنقاش</span></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <div class="space-y-6">
                        <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-4">
                            <div class="text-center mb-6">
                                <div class="text-4xl font-bold text-primary-600 mb-1">{{ number_format($course->price) }}</div>
                                <span class="text-gray-500">ريال سعودي</span>
                            </div>

                            <div class="space-y-4 mb-6">
                                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        المدة
                                    </span>
                                    <span class="font-semibold text-gray-800">{{ $course->duration_hours }} ساعة</span>
                                </div>
                                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        المستوى
                                    </span>
                                    <span class="font-semibold text-gray-800">{{ $course->level }}</span>
                                </div>
                                @if($course->start_date)
                                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        تاريخ البدء
                                    </span>
                                    <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($course->start_date)->format('Y/m/d') }}</span>
                                </div>
                                @endif
                                @if($course->end_date)
                                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        تاريخ الانتهاء
                                    </span>
                                    <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($course->end_date)->format('Y/m/d') }}</span>
                                </div>
                                @endif
                                @if($course->max_students)
                                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        الحد الأقصى
                                    </span>
                                    <span class="font-semibold text-gray-800">{{ $course->max_students }} طالب</span>
                                </div>
                                @endif
                            </div>

                            <a href="{{ route('public.contact') }}" class="block w-full bg-primary-600 hover:bg-primary-700 text-white text-center font-bold py-3 rounded-xl transition-colors duration-300">
                                سجّل الآن
                            </a>
                            <p class="text-center text-sm text-gray-500 mt-3">تواصل معنا للتسجيل والدفع</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
