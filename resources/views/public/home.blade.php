@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-bl from-[#db4047] via-[#b03a3f] to-[#112c71] text-gray-200 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
        </div>
        <div class="container mx-auto px-4 py-20 md:py-32 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-gray-200 text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    تعلّم الإنجليزية مع
                    <span class="text-[#ffffff]">معهد النسور</span>
                </h1>
                <p class="text-gray-200 text-xl md:text-2xl text-primary-100 mb-10 leading-relaxed">
                    نقدم لك أفضل الدورات التدريبية في اللغة الإنجليزية بمستويات متعددة تناسب الجميع
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('public.courses') }}" class="bg-[#db4047] hover:bg-[#b03a3f] text-gray-200 font-bold px-8 py-4 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                        استعرض الدورات
                    </a>
                    <a href="{{ route('public.about') }}" class="border-2 border-gray-300 hover:bg-white text-gray-200 hover:text-[#112c71] font-bold px-8 py-4 rounded-xl text-lg transition-all duration-300">
                        تعرف علينا
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120"><path fill="#ffffff" d="M0,96L48,85.3C96,75,192,53,288,48C384,43,480,53,576,64C672,75,768,85,864,80C960,75,1056,53,1152,42.7C1248,32,1344,32,1392,32L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path></svg>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">لماذا معهد النسور؟</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">نحن نقدم تجربة تعليمية متميزة تجمع بين الجودة والاحترافية</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">مناهج متطورة</h3>
                    <p class="text-gray-600 leading-relaxed">مناهج دراسية حديثة ومحدثة باستمرار لضمان أفضل مستوى تعليمي</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">مدرسون محترفون</h3>
                    <p class="text-gray-600 leading-relaxed">فريق من المدرسين المؤهلين وذوي الخبرة في تعليم اللغة الإنجليزية</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">شهادات معتمدة</h3>
                    <p class="text-gray-600 leading-relaxed">شهادات إتمام دورات معتمدة تُمنح عند إكمال كل مستوى بنجاح</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Courses Section --}}
    @if($featuredCourses->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">دوراتنا التدريبية</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">اختر الدورة المناسبة لمستواك وابدأ رحلة التعلم</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredCourses as $course)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
                        @if($course->image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-2xl font-bold text-primary-600">{{ number_format($course->price) }} <span class="text-sm text-gray-500">ر.س</span></span>
                                <a href="{{ route('public.courses.show', $course) }}" class="text-primary-600 hover:text-primary-800 font-semibold flex items-center gap-1 transition-colors">
                                    التفاصيل
                                    <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('public.courses') }}" class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-xl transition-colors duration-300">
                    عرض جميع الدورات
                    <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Levels Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">مستويات التعلم</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">نقدم ثلاثة مستويات تعليمية مصممة خصيصاً لتناسب احتياجاتك</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="relative bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 text-center border-2 border-green-200 hover:border-green-400 transition-colors">
                    <div class="absolute -top-4 right-1/2 translate-x-1/2 bg-green-500 text-white px-4 py-1 rounded-full text-sm font-bold">المستوى الأول</div>
                    <div class="w-20 h-20 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 mt-4">
                        <span class="text-3xl font-bold">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-green-800 mb-3">مبتدئ</h3>
                    <p class="text-green-700 leading-relaxed">تعلم أساسيات اللغة الإنجليزية من الصفر، الحروف والأرقام والمفردات الأساسية والقواعد البسيطة</p>
                </div>
                <div class="relative bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-8 text-center border-2 border-yellow-200 hover:border-yellow-400 transition-colors">
                    <div class="absolute -top-4 right-1/2 translate-x-1/2 bg-yellow-500 text-white px-4 py-1 rounded-full text-sm font-bold">المستوى الثاني</div>
                    <div class="w-20 h-20 bg-yellow-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 mt-4">
                        <span class="text-3xl font-bold">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-yellow-800 mb-3">متوسط</h3>
                    <p class="text-yellow-700 leading-relaxed">تطوير مهارات المحادثة والكتابة والقراءة، مع التركيز على القواعد المتقدمة والمفردات الأوسع</p>
                </div>
                <div class="relative bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-8 text-center border-2 border-red-200 hover:border-red-400 transition-colors">
                    <div class="absolute -top-4 right-1/2 translate-x-1/2 bg-red-500 text-white px-4 py-1 rounded-full text-sm font-bold">المستوى الثالث</div>
                    <div class="w-20 h-20 bg-red-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 mt-4">
                        <span class="text-3xl font-bold">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-red-800 mb-3">متقدم</h3>
                    <p class="text-red-700 leading-relaxed">إتقان اللغة الإنجليزية للأعمال والأكاديمية، مع مهارات العرض والتقديم والكتابة الاحترافية</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Articles Section --}}
    @if($latestArticles->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">أحدث المقالات</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">نصائح ومقالات مفيدة لتعلم اللغة الإنجليزية</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $article)
                    <article class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
                        @if($article->image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">
                                {{ $article->published_at ? $article->published_at->format('Y/m/d') : $article->created_at->format('Y/m/d') }}
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $article->title }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                            <a href="{{ route('public.articles.show', $article->slug) }}" class="text-primary-600 hover:text-primary-800 font-semibold flex items-center gap-1 transition-colors">
                                اقرأ المزيد
                                <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('public.articles') }}" class="inline-flex items-center gap-2 border-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-primary-800 font-bold px-8 py-3 rounded-xl transition-colors duration-300">
                    عرض جميع المقالات
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-br from-primary-700 to-primary-900 text-gray-700">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">مستعد لبدء رحلة التعلم؟</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">سجّل الآن في إحدى دوراتنا واحصل على تجربة تعليمية مميزة مع معهد النسور</p>
            <a href="{{ route('public.contact') }}" class="inline-flex items-center gap-2 bg-[#db4047] hover:bg-[#b03a3f] text-gray-200 font-bold px-10 py-4 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                تواصل معنا
                <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>
@endsection
