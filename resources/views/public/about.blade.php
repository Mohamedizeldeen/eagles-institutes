@extends('layouts.app')

@section('title', __('messages.about.title'))

@push('styles')
<style>
    .card-hover { transition: all 0.4s cubic-bezier(0.4,0,0.2,1); }
    .card-hover:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.12); }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }
    .fade-in-up-d1 { animation: fadeInUp 0.7s 0.1s ease-out forwards; opacity: 0; }
    .fade-in-up-d2 { animation: fadeInUp 0.7s 0.2s ease-out forwards; opacity: 0; }
    @keyframes countUp { from { opacity: 0; transform: scale(0.5); } to { opacity: 1; transform: scale(1); } }
    .count-up { animation: countUp 0.6s ease-out forwards; }
    .count-up-d1 { animation: countUp 0.6s 0.15s ease-out forwards; opacity: 0; }
    .count-up-d2 { animation: countUp 0.6s 0.3s ease-out forwards; opacity: 0; }
    .count-up-d3 { animation: countUp 0.6s 0.45s ease-out forwards; opacity: 0; }
</style>
@endpush

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a] text-white py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="absolute top-10 {{ $isRtl ? 'left-10' : 'right-10' }} w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 {{ $isRtl ? 'right-0' : 'left-0' }} w-64 h-64 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium text-blue-200 mb-6 fade-in-up">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                {{ __('messages.about.title') }}
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 fade-in-up-d1">{{ __('messages.about.title') }}</h1>
            <p class="text-lg text-blue-200 max-w-2xl mx-auto fade-in-up-d2">{{ __('messages.site.description') }}</p>
        </div>
    </section>

    {{-- Our Story --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-full text-sm font-bold text-blue-600 mb-6">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                            {{ __('messages.about.title') }}
                        </div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">{{ __('messages.about.story_title') }}</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-5">
                            {{ __('messages.about.story_p1') }}
                        </p>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            {{ __('messages.about.story_p2') }}
                        </p>
                    </div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 rounded-3xl p-12 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute top-4 {{ $isRtl ? 'left-4' : 'right-4' }} w-20 h-20 bg-blue-200/40 rounded-full blur-xl"></div>
                            <div class="absolute bottom-4 {{ $isRtl ? 'right-4' : 'left-4' }} w-16 h-16 bg-purple-200/40 rounded-full blur-xl"></div>
                            <div class="text-center relative z-10">
                                <img src="{{ asset('images/logo.png') }}" alt="{{ __('messages.site.name') }}" class="w-40 h-auto mx-auto mb-4 drop-shadow-lg">
                                <p class="text-gray-500 font-medium">{{ __('messages.site.name') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="py-16 bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a] text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center count-up">
                        <div class="text-5xl font-extrabold text-white mb-2">3</div>
                        <div class="text-blue-200 font-medium">{{ __('messages.about.stats_levels') }}</div>
                    </div>
                    <div class="text-center count-up-d1">
                        <div class="text-5xl font-extrabold text-white mb-2">+100</div>
                        <div class="text-blue-200 font-medium">{{ __('messages.about.stats_students') }}</div>
                    </div>
                    <div class="text-center count-up-d2">
                        <div class="text-5xl font-extrabold text-white mb-2">+10</div>
                        <div class="text-blue-200 font-medium">{{ __('messages.about.stats_courses') }}</div>
                    </div>
                    <div class="text-center count-up-d3">
                        <div class="text-5xl font-extrabold text-white mb-2">+50</div>
                        <div class="text-blue-200 font-medium">{{ __('messages.about.stats_certs') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-14">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">{{ __('messages.about.values') }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Innovation --}}
                    <div class="card-hover bg-white rounded-3xl p-8 text-center border border-gray-100 shadow-sm">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/25">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-3">{{ __('messages.about.value_innovation') }}</h3>
                        <p class="text-gray-500 leading-relaxed">{{ __('messages.about.value_innovation_desc') }}</p>
                    </div>
                    {{-- Commitment --}}
                    <div class="card-hover bg-white rounded-3xl p-8 text-center border border-gray-100 shadow-sm">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/25">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-3">{{ __('messages.about.value_commitment') }}</h3>
                        <p class="text-gray-500 leading-relaxed">{{ __('messages.about.value_commitment_desc') }}</p>
                    </div>
                    {{-- Excellence --}}
                    <div class="card-hover bg-white rounded-3xl p-8 text-center border border-gray-100 shadow-sm">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-amber-500/25">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-3">{{ __('messages.about.value_excellence') }}</h3>
                        <p class="text-gray-500 leading-relaxed">{{ __('messages.about.value_excellence_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Mission --}}
                    <div class="card-hover bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 border border-blue-100">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/25">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-extrabold text-gray-900">{{ __('messages.about.mission') }}</h3>
                        </div>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            {{ __('messages.about.mission_desc') }}
                        </p>
                    </div>
                    {{-- Vision --}}
                    <div class="card-hover bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl p-8 border border-amber-100">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/25">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-extrabold text-gray-900">{{ __('messages.about.vision') }}</h3>
                        </div>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            {{ __('messages.about.vision_desc') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">{{ __('messages.about.map_title') }}</h2>
            </div>
            <div class="max-w-5xl mx-auto rounded-3xl overflow-hidden shadow-lg border border-gray-200">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.268454681215!2d49.5734375!3d25.4284375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e37970d5121ff95:0x9813c2b7c1268da4!2z15DXnNeR16nXkdee15DXpdeR16nXkiDXntefXnnXkdegXnnXmd14XnXkdeR15DXqdegXnnXmd14XnXkdeR15DXqdegXnnXmd14XnXkdeg15DXndeR16g!5e0!3m2!1sen!2ssd!4v1234567890" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full"></iframe>
            </div>
            <div class="text-center mt-8">
                <a href="https://www.google.com/maps/place/%D9%85%D8%B9%D9%87%D8%AF+%D8%A7%D9%84%D9%86%D8%B3%D9%88%D8%B1+%D9%84%D9%84%D8%BA%D8%A9+%D8%A7%D9%84%D8%A5%D9%86%D8%AC%D9%84%D9%8A%D8%B2%D9%8A%D8%A9%E2%80%AD/@25.4284375,49.5734375,17z" target="_blank" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ __('messages.about.open_maps') }}
                </a>
            </div>
        </div>
    </section>
@endsection
