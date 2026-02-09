@extends('layouts.app')

@section('title', 'من نحن')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-bl from-[#db4047] to-[#112c71] text-gray-200 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">من نحن</h1>
            <p class="text-xl text-primary-100 max-w-2xl mx-auto">تعرف على معهد النسور للغة الإنجليزية</p>
        </div>
    </section>

    {{-- About Content --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">قصتنا</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-4">
                            معهد النسور للغة الإنجليزية يُعد من المعاهد الرائدة في تعليم اللغة الإنجليزية. نسعى دائماً لتقديم أعلى مستويات التعليم والتدريب لطلابنا من خلال مناهج حديثة ومدرسين مؤهلين.
                        </p>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            نؤمن بأن تعلم اللغة الإنجليزية هو مفتاح النجاح في عالم اليوم، ولذلك نحرص على توفير بيئة تعليمية محفزة تساعد الطلاب على تحقيق أهدافهم اللغوية.
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl p-12 flex items-center justify-center">
                        <div class="text-center">
                            <img src="{{ asset('images/logo.png') }}" alt="معهد النسور للغة الإنجليزية" class="w-32 h-auto mx-auto mb-4">
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
                    <div class="bg-gray-50 rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold text-primary-600 mb-2">3</div>
                        <div class="text-gray-600 font-semibold">مستويات تعليمية</div>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold text-primary-600 mb-2">+100</div>
                        <div class="text-gray-600 font-semibold">طالب وطالبة</div>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold text-primary-600 mb-2">+10</div>
                        <div class="text-gray-600 font-semibold">دورة تدريبية</div>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-6 text-center">
                        <div class="text-4xl font-bold text-primary-600 mb-2">+50</div>
                        <div class="text-gray-600 font-semibold">شهادة صادرة</div>
                    </div>
                </div>

                {{-- Values --}}
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">قيمنا</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">الابتكار</h3>
                            <p class="text-gray-600">نستخدم أحدث الأساليب والتقنيات في تعليم اللغة الإنجليزية</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">الالتزام</h3>
                            <p class="text-gray-600">نلتزم بتقديم أفضل تجربة تعليمية لكل طالب</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">التميز</h3>
                            <p class="text-gray-600">نسعى دائماً للتميز في كل ما نقدمه من خدمات تعليمية</p>
                        </div>
                    </div>
                </div>

                {{-- Mission & Vision --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-primary-50 rounded-2xl p-8 border border-primary-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-primary-600 text-white rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-primary-800">رسالتنا</h3>
                        </div>
                        <p class="text-primary-700 text-lg leading-relaxed">
                            تمكين الأفراد من إتقان اللغة الإنجليزية من خلال برامج تعليمية متميزة تُعدّهم للنجاح في الحياة المهنية والأكاديمية.
                        </p>
                    </div>
                    <div class="bg-yellow-50 rounded-2xl p-8 border border-yellow-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-yellow-500 text-white rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-yellow-800">رؤيتنا</h3>
                        </div>
                        <p class="text-yellow-700 text-lg leading-relaxed">
                            أن نكون المعهد الأول والأفضل في تعليم اللغة الإنجليزية، وأن نُخرّج أجيالاً قادرة على التواصل بالإنجليزية بثقة واحترافية.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
