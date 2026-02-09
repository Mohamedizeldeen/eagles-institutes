@extends('layouts.app')

@section('title', 'تواصل معنا')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-bl from-[#db4047] to-[#112c71] text-gray-200 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">تواصل معنا</h1>
            <p class="text-xl text-primary-100 max-w-2xl mx-auto">نسعد بتواصلكم معنا للاستفسار أو التسجيل في دوراتنا</p>
        </div>
    </section>

    {{-- Contact Content --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Contact Info --}}
                    <div class="space-y-6">
                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">العنوان</h3>
                                    <p class="text-gray-600">المملكة العربية السعودية, الأحساء, شارع الظهران</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">الهاتف</h3>
                                    <p class="text-gray-600" dir="ltr">0135881133</p>
                                    <p class="text-gray-600" dir="ltr">0562474472</p>
                                    <p class="text-gray-600" dir="ltr">0538886303</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">البريد الإلكتروني</h3>
                                    <p class="text-gray-600" dir="ltr">info@eagles-institute.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">ساعات العمل</h3>
                                    <p class="text-gray-600">السبت - الخميس: 8:00 ص - 8:00 م</p>
                                    <p class="text-gray-500 text-sm">الجمعة: مغلق</p>
                                </div>
                            </div>
                        </div>

                        {{-- Social Media --}}
                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <h3 class="font-bold text-gray-800 mb-4">تابعنا على</h3>
                            <div class="flex gap-3">
                                <a href="https://www.tiktok.com/@eagles_institutes?_r=1&_t=ZS-93cIEy3iWuq" class="w-10 h-10 bg-gray-200 text-white rounded-lg flex items-center justify-center hover:bg-gray-300 transition-colors">
                                    <img src="{{ asset(path: 'svg/tiktok.svg') }}" alt="TikTok">
                                </a>
                                <a href="https://www.instagram.com/eagles_institutes?igsh=YW10ZnJtYXA2MWQ1" class="w-10 h-10 bg-pink-600 text-white rounded-lg flex items-center justify-center hover:bg-pink-700 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                </a>
                                <a href="https://www.snapchat.com/add/mesk12pp?share_id=FtrGpzG2nDc&locale=en-GB" class="w-10 h-10 bg-yellow-400 text-black rounded-lg flex items-center justify-center hover:bg-yellow-500 transition-colors" aria-label="Snapchat">
                                    <img src="{{ asset(path: 'svg/snapchat.svg') }}" alt="Snapchat">
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Form --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl p-8 shadow-sm">
                            @if(session('success'))
                                <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">أرسل لنا رسالة</h2>
                            <form class="space-y-6" method="POST" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">الاسم الكامل</label>
                                        <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="أدخل اسمك الكامل" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">رقم الهاتف</label>
                                        <input type="tel" name="phone" dir="ltr" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors text-left" placeholder="+249 XX XXX XXXX" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">البريد الإلكتروني</label>
                                    <input type="email" name="email" dir="ltr" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors text-left" placeholder="example@email.com" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">الموضوع</label>
                                    <select name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" required>
                                        <option value="">اختر الموضوع</option>
                                        <option>استفسار عن الدورات</option>
                                        <option>التسجيل في دورة</option>
                                        <option>استفسار عن الأسعار</option>
                                        <option>شكوى أو اقتراح</option>
                                        <option>أخرى</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">الرسالة</label>
                                    <textarea name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors resize-none" placeholder="اكتب رسالتك هنا..." required></textarea>
                                </div>
                                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-gray font-bold py-3 rounded-xl transition-colors duration-300 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    إرسال الرسالة
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">موقعنا على الخريطة</h2>
            <div class="max-w-5xl mx-auto rounded-2xl overflow-hidden shadow-lg">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.268454681215!2d49.5734375!3d25.4284375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e37970d5121ff95:0x9813c2b7c1268da4!2z15DXnNeR16nXkdee15DXpdeR16nXkiDXntefXnnXkdegXnnXmd14XnXkdeR15DXqdegXnnXmd14XnXkdeR15DXqdegXnnXmd14XnXkdeg15DXndeR16g!5e0!3m2!1sen!2ssd!4v1234567890" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="text-center mt-6">
                <a href="https://www.google.com/maps/place/%D9%85%D8%B9%D9%87%D8%AF+%D8%A7%D9%84%D9%86%D8%B3%D9%88%D8%B1+%D9%84%D9%84%D8%BA%D8%A9+%D8%A7%D9%84%D8%A5%D9%86%D8%AC%D9%84%D9%8A%D8%B2%D9%8A%D8%A9%E2%80%AD/@25.4284375,49.5734375,17z/data=!3m1!4b1!4m6!3m5!1s0x3e37970d5121ff95:0x9813c2b7c1268da4!8m2!3d25.4284375!4d49.5734375!16s%2Fg%2F11j0hz82m8?entry=ttu&g_ep=EgoyMDI2MDIwNC4wIKXMDSoKLDEwMDc5MjA2OUgBUAM%3D" target="_blank" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-8 rounded-xl transition-colors duration-300">
                    فتح الموقع على Google Maps
                </a>
            </div>
        </div>
    </section>
@endsection
