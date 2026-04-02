<div 
    x-data="{ 
        open: false,
        search: @entangle('search'),
        init() {
            this.$watch('search', value => {
                this.open = value.length > 0;
            });
        },
        focusInput() {
            this.$nextTick(() => {
                this.$refs.searchInput?.focus();
            });
        }
    }" 
    @click.away="open = false"
    @keydown.escape.window="open = false"
    class="navigation-search-wrapper relative"
>
    <!-- Search Input - Always Visible -->
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input 
            x-ref="searchInput"
            wire:model.live.debounce.150ms="search"
            @focus="if(search.length > 0) open = true"
            @click="if(search.length > 0) open = true"
            type="text" 
            placeholder="Cari menu..."
            class="block w-[280px] pl-9 pr-8 py-2 text-sm border border-gray-300 rounded-lg bg-white/80 backdrop-blur-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:bg-white transition-all duration-200 placeholder-gray-400"
        >
        <!-- Clear button -->
        <button 
            x-show="search.length > 0"
            x-transition
            @click="search = ''; $wire.set('search', ''); open = false; $refs.searchInput.focus()"
            type="button"
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
        >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Dropdown Results -->
    <div 
        x-show="open && search.length > 0" 
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute left-0 top-full mt-2 w-[360px] bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden z-50"
        style="display: none;"
    >
        <!-- Results Header -->
        <div class="px-4 py-2.5 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Hasil Pencarian
                </span>
                <span class="text-xs text-gray-400">{{ count($results) }} menu</span>
            </div>
        </div>

        <!-- Results List -->
        <div class="max-h-[320px] overflow-y-auto overscroll-contain">
            @forelse($results as $index => $result)
                <a 
                    href="{{ $result['url'] }}"
                    wire:click="selectItem('{{ $result['url'] }}', '{{ addslashes($result['label']) }}', '{{ addslashes($result['group']) }}', '{{ $result['icon'] }}')"
                    class="flex items-center gap-3 px-4 py-3 hover:bg-gradient-to-r hover:from-primary-50 hover:to-success-50 transition-all duration-150 group cursor-pointer border-b border-gray-50 last:border-0"
                >
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-gradient-to-br from-primary-500 to-success-600 flex items-center justify-center text-white shadow-sm group-hover:shadow-md group-hover:scale-105 transition-all">
                        <x-filament::icon 
                            icon="{{ $result['icon'] }}" 
                            class="h-4 w-4"
                        />
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-900 truncate group-hover:text-primary-700">
                            {!! $indexer->highlightMatch($result['label'], $search) !!}
                        </div>
                        <div class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3 flex-shrink-0 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                            </svg>
                            <span class="truncate">{!! $indexer->highlightMatch($result['group'], $search) !!}</span>
                        </div>
                    </div>
                    
                    <!-- Arrow -->
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-primary-500 group-hover:translate-x-0.5 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @empty
                <!-- Empty State -->
                <div class="px-4 py-8 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-amber-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Menu tidak ditemukan</p>
                    <p class="text-xs text-gray-400">Coba kata kunci lain</p>
                </div>
            @endforelse
        </div>

        <!-- Footer Hint -->
        @if(count($results) > 0)
        <div class="px-4 py-2 bg-gray-50 border-t border-gray-100">
            <p class="text-xs text-gray-400 text-center flex items-center justify-center gap-1.5">
                <kbd class="px-1.5 py-0.5 text-[10px] font-semibold text-gray-500 bg-white rounded border border-gray-200 shadow-sm">Enter</kbd>
                <span>untuk membuka</span>
                <span class="text-gray-300">|</span>
                <kbd class="px-1.5 py-0.5 text-[10px] font-semibold text-gray-500 bg-white rounded border border-gray-200 shadow-sm">Esc</kbd>
                <span>untuk menutup</span>
            </p>
        </div>
        @endif
    </div>
</div>

<style>
/* Custom Scrollbar */
.navigation-search-wrapper .max-h-\[320px\]::-webkit-scrollbar {
    width: 5px;
}

.navigation-search-wrapper .max-h-\[320px\]::-webkit-scrollbar-track {
    background: transparent;
}

.navigation-search-wrapper .max-h-\[320px\]::-webkit-scrollbar-thumb {
    background: #e5e7eb;
    border-radius: 10px;
}

.navigation-search-wrapper .max-h-\[320px\]::-webkit-scrollbar-thumb:hover {
    background: #d1d5db;
}

/* Highlight Mark Styling */
.navigation-search-wrapper mark {
    background: linear-gradient(120deg, #fef3c7 0%, #fde68a 100%);
    color: #92400e;
    font-weight: 600;
    padding: 0 3px;
    border-radius: 3px;
    box-decoration-break: clone;
}

/* Focus ring animation */
.navigation-search-wrapper input:focus {
    box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.15);
}
</style>
