<div 
    x-data="{ 
        open: false,
        search: @entangle('search'),
        selectedIndex: -1,
        loading: false,
        results: [],
        init() {
            this.$watch('search', value => {
                this.open = value.length > 0;
                this.selectedIndex = -1;
                if (value.length > 0) {
                    this.loading = true;
                }
            });
            
            // Watch for Livewire updates
            Livewire.hook('message.processed', (message, component) => {
                if (component.name === 'navigation-search') {
                    this.loading = false;
                }
            });
        },
        focusInput() {
            this.$nextTick(() => {
                this.$refs.searchInput?.focus();
            });
        },
        selectNext() {
            const resultsCount = document.querySelectorAll('[data-search-result]').length;
            if (resultsCount > 0) {
                this.selectedIndex = Math.min(this.selectedIndex + 1, resultsCount - 1);
                this.scrollToSelected();
            }
        },
        selectPrev() {
            if (this.selectedIndex > 0) {
                this.selectedIndex--;
                this.scrollToSelected();
            }
        },
        scrollToSelected() {
            this.$nextTick(() => {
                const selected = document.querySelector(`[data-search-result][data-index='${this.selectedIndex}']`);
                if (selected) {
                    selected.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                }
            });
        },
        confirmSelection() {
            const selected = document.querySelector(`[data-search-result][data-index='${this.selectedIndex}']`);
            if (selected) {
                selected.click();
            }
        }
    }" 
    @click.away="open = false; selectedIndex = -1"
    @keydown.escape.window="open = false; selectedIndex = -1"
    @keydown.ctrl.k.window.prevent="focusInput()"
    @keydown.meta.k.window.prevent="focusInput()"
    @keydown.slash.window="if(document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') { $event.preventDefault(); focusInput(); }"
    class="navigation-search-wrapper relative"
>
    <!-- Search Input -->
    <div class="relative group">
        <!-- Search Icon -->
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
            <svg 
                x-show="!loading" 
                class="h-4 w-4 text-gray-400 group-focus-within:text-primary-500 transition-colors duration-200" 
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <!-- Loading Spinner -->
            <svg 
                x-show="loading" 
                x-cloak
                class="h-4 w-4 text-primary-500 animate-spin" 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        
        <!-- Input Field -->
        <input 
            x-ref="searchInput"
            wire:model.live.debounce.200ms="search"
            @focus="if(search.length > 0) open = true"
            @click="if(search.length > 0) open = true"
            @keydown.arrow-down.prevent="selectNext()"
            @keydown.arrow-up.prevent="selectPrev()"
            @keydown.enter.prevent="confirmSelection()"
            type="text" 
            placeholder="Cari menu... (Ctrl+K)"
            class="block w-[260px] pl-9 pr-8 py-1.5 text-sm border border-gray-200 rounded-lg 
                   bg-gray-50 hover:bg-white hover:border-gray-300
                   focus:bg-white focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 
                   transition-all duration-200 placeholder-gray-400
                   dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:border-gray-600
                   dark:focus:bg-gray-800 dark:focus:border-primary-500 dark:placeholder-gray-500 dark:text-gray-200"
        >
        
        <!-- Clear Button -->
        <button 
            x-show="search.length > 0"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-75"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-75"
            @click="search = ''; $wire.set('search', ''); open = false; selectedIndex = -1; $refs.searchInput.focus()"
            type="button"
            class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
        >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Dropdown Results -->
    <div 
        x-show="open && search.length > 0" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
        x-cloak
        class="absolute left-0 top-full mt-2 w-[340px] bg-white dark:bg-gray-900 rounded-xl shadow-2xl shadow-gray-200/50 dark:shadow-black/30 border border-gray-100 dark:border-gray-800 overflow-hidden z-50"
    >
        <!-- Results Header -->
        <div class="px-3 py-2 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Hasil Pencarian
                </span>
                <span class="text-xs text-gray-400 dark:text-gray-500 tabular-nums">{{ count($results) }} ditemukan</span>
            </div>
        </div>

        <!-- Results List -->
        <div class="max-h-[300px] overflow-y-auto overscroll-contain">
            @forelse($results as $index => $result)
                <a 
                    href="{{ $result['url'] }}"
                    wire:click="selectItem('{{ $result['url'] }}', '{{ addslashes($result['label']) }}', '{{ addslashes($result['group']) }}', '{{ $result['icon'] }}')"
                    data-search-result
                    data-index="{{ $index }}"
                    :class="{ 
                        'bg-primary-50 dark:bg-primary-900/20 border-l-2 border-l-primary-500': selectedIndex === {{ $index }},
                        'border-l-2 border-l-transparent': selectedIndex !== {{ $index }}
                    }"
                    class="flex items-center gap-3 px-3 py-2.5 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-100 group cursor-pointer"
                >
                    <!-- Icon Container -->
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500/10 to-primary-600/10 dark:from-primary-400/20 dark:to-primary-500/20 flex items-center justify-center group-hover:from-primary-500/20 group-hover:to-primary-600/20 transition-all duration-200"
                         :class="{ 'from-primary-500/20 to-primary-600/20 dark:from-primary-400/30 dark:to-primary-500/30': selectedIndex === {{ $index }} }">
                        <x-filament::icon 
                            :icon="$result['icon']" 
                            class="h-4 w-4 text-primary-600 dark:text-primary-400"
                        />
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors"
                             :class="{ 'text-primary-600 dark:text-primary-400': selectedIndex === {{ $index }} }">
                            {!! $indexer->highlightMatch($result['label'], $search) !!}
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                            </svg>
                            <span class="truncate">{!! $indexer->highlightMatch($result['group'], $search) !!}</span>
                        </div>
                    </div>
                    
                    <!-- Arrow Indicator -->
                    <div class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity"
                         :class="{ 'opacity-100': selectedIndex === {{ $index }} }">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </a>
            @empty
                <!-- Empty State -->
                <div class="px-4 py-8 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Menu tidak ditemukan</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">Coba kata kunci lain</p>
                </div>
            @endforelse
        </div>

        <!-- Footer Hint -->
        @if(count($results) > 0)
        <div class="px-3 py-2 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-800">
            <div class="flex items-center justify-center gap-3 text-xs text-gray-400 dark:text-gray-500">
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 text-[10px] font-medium bg-white dark:bg-gray-700 rounded border border-gray-200 dark:border-gray-600 shadow-sm">↑</kbd>
                    <kbd class="px-1.5 py-0.5 text-[10px] font-medium bg-white dark:bg-gray-700 rounded border border-gray-200 dark:border-gray-600 shadow-sm">↓</kbd>
                    <span class="ml-0.5">navigasi</span>
                </span>
                <span class="text-gray-300 dark:text-gray-600">|</span>
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 text-[10px] font-medium bg-white dark:bg-gray-700 rounded border border-gray-200 dark:border-gray-600 shadow-sm">Enter</kbd>
                    <span class="ml-0.5">buka</span>
                </span>
                <span class="text-gray-300 dark:text-gray-600">|</span>
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 text-[10px] font-medium bg-white dark:bg-gray-700 rounded border border-gray-200 dark:border-gray-600 shadow-sm">Esc</kbd>
                    <span class="ml-0.5">tutup</span>
                </span>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
[x-cloak] { display: none !important; }

/* Custom Scrollbar */
.navigation-search-wrapper .max-h-\[300px\]::-webkit-scrollbar {
    width: 6px;
}

.navigation-search-wrapper .max-h-\[300px\]::-webkit-scrollbar-track {
    background: transparent;
}

.navigation-search-wrapper .max-h-\[300px\]::-webkit-scrollbar-thumb {
    background: #e5e7eb;
    border-radius: 10px;
}

.navigation-search-wrapper .max-h-\[300px\]::-webkit-scrollbar-thumb:hover {
    background: #d1d5db;
}

.dark .navigation-search-wrapper .max-h-\[300px\]::-webkit-scrollbar-thumb {
    background: #374151;
}

.dark .navigation-search-wrapper .max-h-\[300px\]::-webkit-scrollbar-thumb:hover {
    background: #4b5563;
}

/* Highlight Styling */
.navigation-search-wrapper mark {
    background: linear-gradient(120deg, #fef3c7 0%, #fde68a 100%);
    color: #92400e;
    font-weight: 600;
    padding: 1px 4px;
    border-radius: 3px;
    box-decoration-break: clone;
}

.dark .navigation-search-wrapper mark {
    background: linear-gradient(120deg, #78350f 0%, #92400e 100%);
    color: #fef3c7;
}
</style>
