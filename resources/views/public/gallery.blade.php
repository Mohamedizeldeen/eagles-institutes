@extends('layouts.app')

@section('title', __('messages.gallery.title'))

@push('styles')
<style>
    .gallery-item { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .gallery-item:hover { transform: translateY(-4px); }
    .gallery-item:hover img { transform: scale(1.08); }
    .gallery-filter-btn.active { background: #112c71; color: white; }
    .lightbox { display: none; position: fixed; inset: 0; z-index: 100; background: rgba(0,0,0,0.9); backdrop-filter: blur(8px); align-items: center; justify-content: center; }
    .lightbox.open { display: flex; }
    .lightbox img { max-width: 90vw; max-height: 85vh; object-fit: contain; border-radius: 12px; }
</style>
@endpush

@section('content')
    {{-- Page Header --}}
    <section class="relative py-20 bg-gradient-to-br from-slate-900 via-[#112c71] to-[#0f172a] overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4">{{ __('messages.gallery.title') }}</h1>
            <p class="text-blue-100/70 text-lg max-w-2xl mx-auto">{{ __('messages.gallery.page_description') }}</p>
        </div>
    </section>

    {{-- Gallery --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Category Filters --}}
            @if($categories->count() > 1)
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button onclick="filterGallery('all')" class="gallery-filter-btn active px-5 py-2.5 rounded-xl text-sm font-semibold border border-gray-200 transition-all duration-200 hover:shadow-md">
                    {{ __('messages.gallery.all') }}
                </button>
                @foreach($categories as $cat)
                    <button onclick="filterGallery('cat-{{ $cat->id }}')" class="gallery-filter-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-gray-200 bg-white text-gray-600 transition-all duration-200 hover:shadow-md">
                        {{ $cat->localized_name }}
                        <span class="text-xs text-gray-400 {{ $isRtl ? 'mr-1' : 'ml-1' }}">({{ $cat->images_count }})</span>
                    </button>
                @endforeach
            </div>
            @endif

            {{-- Images Grid --}}
            <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($images as $img)
                    <div class="gallery-item gallery-cat-{{ $img->gallery_category_id }} group cursor-pointer rounded-2xl overflow-hidden shadow-sm bg-white border border-gray-100"
                         onclick="openLightbox('{{ asset('storage/' . $img->image) }}', '{{ addslashes($img->localized_caption ?? '') }}')">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->localized_caption }}" class="w-full h-full object-cover transition-transform duration-500" loading="lazy">
                        </div>
                        @if($img->localized_caption)
                            <div class="p-3">
                                <p class="text-sm text-gray-600 truncate">{{ $img->localized_caption }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $img->category->localized_name }}</p>
                            </div>
                        @else
                            <div class="p-3">
                                <p class="text-xs text-gray-400">{{ $img->category->localized_name }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-gray-400 text-lg">{{ __('messages.gallery.no_images_public') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Lightbox --}}
    <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
        <button onclick="closeLightbox()" class="absolute top-6 {{ $isRtl ? 'left-6' : 'right-6' }} text-white/70 hover:text-white transition z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="text-center" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="" class="mx-auto">
            <p id="lightbox-caption" class="text-white/80 mt-4 text-sm"></p>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function filterGallery(cat) {
    document.querySelectorAll('.gallery-filter-btn').forEach(btn => btn.classList.remove('active'));
    event.target.closest('.gallery-filter-btn').classList.add('active');

    document.querySelectorAll('.gallery-item').forEach(item => {
        if (cat === 'all' || item.classList.contains('gallery-' + cat)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

function openLightbox(src, caption) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-caption').textContent = caption;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(e) {
    if (e && e.target !== document.getElementById('lightbox')) return;
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }
});
</script>
@endpush
