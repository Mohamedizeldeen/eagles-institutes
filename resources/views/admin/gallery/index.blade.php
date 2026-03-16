@extends('layouts.admin')
@section('title', __('messages.gallery.manage'))
@section('page-title', __('messages.gallery.manage'))

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <div class="flex gap-2">
        <a href="{{ route('admin.gallery.categories.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            {{ __('messages.gallery.new_category') }}
        </a>
        <a href="{{ route('admin.gallery.images.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-emerald-700 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ __('messages.gallery.upload_images') }}
        </a>
    </div>
</div>

{{-- Categories --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    {{-- Sidebar: Categories List --}}
    <div class="md:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-4">
            <h3 class="font-bold text-gray-800 mb-3 text-sm uppercase tracking-wider">{{ __('messages.gallery.categories') }}</h3>
            <div class="space-y-1">
                @forelse($categories as $cat)
                    <a href="{{ route('admin.gallery.index', ['category' => $cat->id]) }}"
                       class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition {{ $selectedCategory && $selectedCategory->id === $cat->id ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        <span class="flex items-center gap-2">
                            @if(!$cat->is_active)
                                <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                            @else
                                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                            @endif
                            {{ $cat->localized_name }}
                        </span>
                        <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">{{ $cat->images_count }}</span>
                    </a>
                @empty
                    <p class="text-gray-400 text-sm py-4 text-center">{{ __('messages.gallery.no_categories') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Main: Images Grid or Category Details --}}
    <div class="md:col-span-3">
        @if($selectedCategory)
            {{-- Category Header --}}
            <div class="bg-white rounded-xl shadow-sm p-4 mb-4 flex items-center justify-between flex-wrap gap-3">
                <div>
                    <h3 class="font-bold text-lg text-gray-800">{{ $selectedCategory->localized_name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $images->count() }} {{ __('messages.gallery.images_count') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.gallery.images.create', ['category' => $selectedCategory->id]) }}" class="bg-emerald-600 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-emerald-700 transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        {{ __('messages.gallery.add_image') }}
                    </a>
                    <a href="{{ route('admin.gallery.categories.edit', $selectedCategory) }}" class="text-amber-600 hover:text-amber-800 p-1.5" title="{{ __('messages.edit') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>
                    <form action="{{ route('admin.gallery.categories.destroy', $selectedCategory) }}" method="POST" onsubmit="return confirm('{{ __('messages.gallery.confirm_delete_category') }}')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 p-1.5" title="{{ __('messages.delete') }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Images Grid with Drag-Sort --}}
            @if($images->count() > 0)
                <div id="sortable-gallery" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($images as $img)
                        <div class="group relative bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 cursor-move" data-id="{{ $img->id }}">
                            <div class="aspect-square overflow-hidden">
                                <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->localized_caption }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100">
                                <a href="{{ route('admin.gallery.images.edit', $img) }}" class="bg-white text-amber-600 p-2 rounded-lg hover:bg-amber-50 transition" title="{{ __('messages.edit') }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.gallery.images.destroy', $img) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-white text-red-600 p-2 rounded-lg hover:bg-red-50 transition" title="{{ __('messages.delete') }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                            {{-- Sort handle indicator --}}
                            <div class="absolute top-2 {{ $isRtl ? 'left-2' : 'right-2' }} opacity-0 group-hover:opacity-100 transition">
                                <span class="bg-white/80 backdrop-blur text-gray-500 p-1 rounded text-xs flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                                    {{ $img->sort_order }}
                                </span>
                            </div>
                            @if($img->show_on_home)
                                <div class="absolute top-2 {{ $isRtl ? 'right-2' : 'left-2' }}">
                                    <span class="bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full">{{ __('messages.gallery.on_home') }}</span>
                                </div>
                            @endif
                            @if($img->localized_caption)
                                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/60 to-transparent p-3 opacity-0 group-hover:opacity-100 transition">
                                    <p class="text-white text-xs truncate">{{ $img->localized_caption }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-gray-400">{{ __('messages.gallery.no_images') }}</p>
                    <a href="{{ route('admin.gallery.images.create', ['category' => $selectedCategory->id]) }}" class="inline-flex items-center gap-2 mt-4 text-blue-600 hover:text-blue-700 font-medium text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        {{ __('messages.gallery.upload_images') }}
                    </a>
                </div>
            @endif
        @else
            {{-- No category selected --}}
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <p class="text-gray-500 font-medium">{{ __('messages.gallery.select_category_hint') }}</p>
                <p class="text-gray-400 text-sm mt-1">{{ __('messages.gallery.select_category_desc') }}</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
// Simple drag-and-drop sort
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('sortable-gallery');
    if (!grid) return;

    let dragEl = null;

    grid.querySelectorAll('[data-id]').forEach(item => {
        item.setAttribute('draggable', 'true');

        item.addEventListener('dragstart', function(e) {
            dragEl = this;
            this.style.opacity = '0.4';
            e.dataTransfer.effectAllowed = 'move';
        });

        item.addEventListener('dragend', function() {
            this.style.opacity = '1';
            grid.querySelectorAll('[data-id]').forEach(i => i.classList.remove('ring-2', 'ring-blue-400'));
        });

        item.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            this.classList.add('ring-2', 'ring-blue-400');
        });

        item.addEventListener('dragleave', function() {
            this.classList.remove('ring-2', 'ring-blue-400');
        });

        item.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('ring-2', 'ring-blue-400');
            if (dragEl !== this) {
                const allItems = [...grid.querySelectorAll('[data-id]')];
                const fromIndex = allItems.indexOf(dragEl);
                const toIndex = allItems.indexOf(this);
                if (fromIndex < toIndex) {
                    this.after(dragEl);
                } else {
                    this.before(dragEl);
                }
                saveOrder();
            }
        });
    });

    function saveOrder() {
        const order = [...grid.querySelectorAll('[data-id]')].map(el => parseInt(el.dataset.id));
        fetch('{{ route("admin.gallery.images.updateOrder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ order }),
        });
    }
});
</script>
@endpush
@endsection
