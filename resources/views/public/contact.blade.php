@extends('layouts.app')

@section('title', __('messages.contact_page.title'))

@push('styles')
<style>
    .card-hover { transition: all 0.4s cubic-bezier(0.4,0,0.2,1); }
    .card-hover:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.12); }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    .fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }
    .fade-in-up-d1 { animation: fadeInUp 0.7s 0.1s ease-out forwards; opacity: 0; }
    .fade-in-up-d2 { animation: fadeInUp 0.7s 0.2s ease-out forwards; opacity: 0; }
    .input-modern { @apply w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 placeholder-gray-400 transition-all duration-300; }
    .input-modern:focus { @apply bg-white border-blue-400 ring-4 ring-blue-500/10 outline-none; }
</style>
@endpush

@section('content')
    {{-- Page Header --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a] text-white py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="absolute top-10 {{ $isRtl ? 'left-10' : 'right-10' }} w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 {{ $isRtl ? 'right-10' : 'left-10' }} w-56 h-56 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium text-blue-200 mb-6 fade-in-up">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                {{ __('messages.contact_page.title') }}
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 fade-in-up-d1">{{ __('messages.contact_page.title') }}</h1>
            <p class="text-lg text-blue-200 max-w-2xl mx-auto fade-in-up-d2">{{ __('messages.contact_page.subtitle') }}</p>
        </div>
    </section>

    {{-- Contact Content --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Contact Info --}}
                    <div class="space-y-5">
                        {{-- Address --}}
                        <div class="card-hover bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-blue-500/25">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-gray-900 mb-1">{{ __('messages.contact_page.address_title') }}</h3>
                                    <p class="text-gray-500 leading-relaxed">{{ __('messages.contact_page.address') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="card-hover bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 text-white rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-emerald-500/25">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-gray-900 mb-1">{{ __('messages.contact_page.phone_title') }}</h3>
                                    <p class="text-gray-500" dir="ltr">0135881133</p>
                                    <p class="text-gray-500" dir="ltr">0562474472</p>
                                    <p class="text-gray-500" dir="ltr">0538886303</p>
                                </div>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="card-hover bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-violet-500 to-purple-600 text-white rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-violet-500/25">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-gray-900 mb-1">{{ __('messages.contact_page.email_title') }}</h3>
                                    <p class="text-gray-500" dir="ltr">info@eagles-institute.com</p>
                                </div>
                            </div>
                        </div>

                        {{-- Hours --}}
                        <div class="card-hover bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 text-white rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-amber-500/25">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-gray-900 mb-1">{{ __('messages.contact_page.hours_title') }}</h3>
                                    <p class="text-gray-500">{{ __('messages.contact_page.hours_weekday') }}</p>
                                    <p class="text-gray-400 text-sm">{{ __('messages.contact_page.hours_weekend') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Social Media --}}
                        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                            <h3 class="font-extrabold text-gray-900 mb-4">{{ __('messages.contact_page.follow_us') }}</h3>
                            <div class="flex gap-3">
                                <a href="https://www.tiktok.com/@eagles_institutes" class="w-11 h-11 bg-gray-100 hover:bg-gray-900 hover:text-white text-gray-600 rounded-xl flex items-center justify-center transition-all duration-300">
                                    <img src="{{ asset('svg/tiktok.svg') }}" alt="TikTok" class="w-5 h-5">
                                </a>
                                <a href="https://www.instagram.com/eagles_institutes" class="w-11 h-11 bg-gray-100 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 text-gray-600 hover:text-white rounded-xl flex items-center justify-center transition-all duration-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                </a>
                                <a href="https://www.snapchat.com/add/mesk12pp" class="w-11 h-11 bg-gray-100 hover:bg-yellow-400 text-gray-600 hover:text-black rounded-xl flex items-center justify-center transition-all duration-300">
                                    <img src="{{ asset('svg/snapchat.svg') }}" alt="Snapchat" class="w-5 h-5">
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Form --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-3xl p-8 md:p-10 border border-gray-100 shadow-sm">
                            @if(session('success'))
                                <div class="bg-emerald-50 text-emerald-700 p-5 rounded-2xl mb-6 flex items-center gap-3 border border-emerald-100">
                                    <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">{{ __('messages.contact_page.send_message') }}</h2>

                            <form class="space-y-5" method="POST" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('messages.contact_page.name') }}</label>
                                        <input type="text" name="name" class="input-modern" placeholder="{{ __('messages.contact_page.name_placeholder') }}" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('messages.contact_page.phone') }}</label>
                                        <input type="tel" name="phone" dir="ltr" class="input-modern text-{{ $isRtl ? 'right' : 'left' }}" placeholder="{{ __('messages.contact_page.phone_placeholder') }}" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('messages.contact_page.email') }}</label>
                                    <input type="email" name="email" dir="ltr" class="input-modern text-{{ $isRtl ? 'right' : 'left' }}" placeholder="{{ __('messages.contact_page.email_placeholder') }}" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('messages.contact_page.subject') }}</label>
                                    <select name="subject" class="input-modern" required>
                                        <option value="">{{ __('messages.contact_page.subject_placeholder') }}</option>
                                        <option value="inquiry">{{ __('messages.contact_page.subject_inquiry') }}</option>
                                        <option value="register">{{ __('messages.contact_page.subject_register') }}</option>
                                        <option value="pricing">{{ __('messages.contact_page.subject_pricing') }}</option>
                                        <option value="feedback">{{ __('messages.contact_page.subject_feedback') }}</option>
                                        <option value="other">{{ __('messages.contact_page.subject_other') }}</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('messages.contact_page.message') }}</label>
                                    <textarea name="message" rows="5" class="input-modern resize-none" placeholder="{{ __('messages.contact_page.message_placeholder') }}" required></textarea>
                                </div>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/25 flex items-center justify-center gap-2 text-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    {{ __('messages.contact_page.send') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">{{ __('messages.contact_page.map_title') }}</h2>
            </div>
            <div class="max-w-5xl mx-auto rounded-3xl overflow-hidden shadow-lg border border-gray-200">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.268454681215!2d49.5734375!3d25.4284375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e37970d5121ff95:0x9813c2b7c1268da4!2z15DXnNeR16nXkdee15DXpdeR16nXkiDXntefXnnXkdegXnnXmd14XnXkdeR15DXqdegXnnXmd14XnXkdeR15DXqdegXnnXmd14XnXkdeg15DXndeR16g!5e0!3m2!1sen!2ssd!4v1234567890" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-full"></iframe>
            </div>
            <div class="text-center mt-8">
                <a href="https://www.google.com/maps/place/%D9%85%D8%B9%D9%87%D8%AF+%D8%A7%D9%84%D9%86%D8%B3%D9%88%D8%B1+%D9%84%D9%84%D8%BA%D8%A9+%D8%A7%D9%84%D8%A5%D9%86%D8%AC%D9%84%D9%8A%D8%B2%D9%8A%D8%A9%E2%80%AD/@25.4284375,49.5734375,17z" target="_blank" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ __('messages.contact_page.open_maps') }}
                </a>
            </div>
        </div>
    </section>
@endsection
