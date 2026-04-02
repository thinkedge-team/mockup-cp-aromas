<div 
    x-data="{ 
        open: false,
        search: @entangle('search'),
        selectedIndex: -1,
        loading: false,
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
    class="fi-navigation-search relative"
>
    <!-- Search Input Container -->
    <div class="relative group">
        <!-- Search Icon -->
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <!-- Default Search Icon -->
            <svg 
                x-show="!loading" 
                class="w-4 h-4 text-gray-400 dark:text-gray-500 group-focus-within:text-primary-500 dark:group-focus-within:text-primary-400 transition-colors duration-200" 
                fill="none" 
                stroke="currentColor" 
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <!-- Loading Spinner -->
            <svg 
                x-show="loading" 
                x-cloak
                class="w-4 h-4 text-primary-500 dark:text-primary-400 animate-spin" 
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
            placeholder="Cari menu..."
            autocomplete="off"
            class="fi-input w-64 h-9 pl-10 pr-9 text-sm rounded-lg
                   bg-gray-100 dark:bg-white/5
                   border border-transparent
                   text-gray-900 dark:text-white
                   placeholder:text-gray-500 dark:placeholder:text-gray-400
                   hover:bg-gray-200/70 dark:hover:bg-white/10
                   focus:bg-white dark:focus:bg-white/5
                   focus:border-primary-500 dark:focus:border-primary-500
                   focus:ring-2 focus:ring-primary-500/20 dark:focus:ring-primary-500/30
                   focus:outline-none
                   transition duration-200 ease-in-out"
        >
        
        <!-- Keyboard Shortcut Badge -->
        <div 
            x-show="search.length === 0"
            class="absolute inset-y-0 right-0 flex items-center pr-2.5 pointer-events-none"
        >
            <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 text-[10px] font-medium text-gray-400 dark:text-gray-500 bg-gray-200/80 dark:bg-white/10 rounded border-0 font-mono">
                ⌘K
            </kbd>
        </div>
        
        <!-- Clear Button -->
        <button 
            x-show="search.length > 0"
            x-cloak
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            @click="search = ''; $wire.set('search', ''); open = false; selectedIndex = -1; $refs.searchInput.focus()"
            type="button"
            class="absolute inset-y-0 right-0 flex items-center pr-2.5 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Dropdown Results Panel -->
    <div 
        x-show="open && search.length > 0" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        x-cloak
        class="absolute right-0 top-full mt-2 w-80 
               bg-white dark:bg-gray-900 
               rounded-xl 
               shadow-lg shadow-gray-900/10 dark:shadow-gray-900/50
               ring-1 ring-gray-200 dark:ring-white/10
               overflow-hidden z-50"
    >
        <!-- Results Header -->
        <div class="flex items-center justify-between px-4 py-2.5 border-b border-gray-100 dark:border-white/10">
            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                Hasil Pencarian
            </span>
            <span class="text-xs text-gray-400 dark:text-gray-500 tabular-nums">
                {{ count($results) }} menu
            </span>
        </div>

        <!-- Results List -->
        <div class="max-h-72 overflow-y-auto overscroll-contain fi-search-results">
            @forelse($results as $index => $result)
                <a 
                    href="{{ $result['url'] }}"
                    wire:click="selectItem('{{ $result['url'] }}', '{{ addslashes($result['label']) }}', '{{ addslashes($result['group']) }}', '{{ $result['icon'] }}')"
                    data-search-result
                    data-index="{{ $index }}"
                    :class="{ 
                        'bg-gray-50 dark:bg-white/5': selectedIndex === {{ $index }}
                    }"
                    class="flex items-center gap-3 px-4 py-2.5 
                           hover:bg-gray-50 dark:hover:bg-white/5 
                           transition-colors duration-75 
                           cursor-pointer group"
                >
                    <!-- Icon -->
                    <div class="flex-shrink-0 flex items-center justify-center w-9 h-9 rounded-lg 
                                bg-primary-50 dark:bg-primary-500/10
                                text-primary-600 dark:text-primary-400
                                group-hover:bg-primary-100 dark:group-hover:bg-primary-500/20
                                transition-colors duration-150">
                        <x-filament::icon 
                            :icon="$result['icon']" 
                            class="w-5 h-5"
                        />
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-900 dark:text-white truncate">
                            {!! $indexer->highlightMatch($result['label'], $search) !!}
                        </div>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <svg class="w-3 h-3 text-gray-400 dark:text-gray-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                            </svg>
                            <span class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                {!! $indexer->highlightMatch($result['group'], $search) !!}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Arrow -->
                    <svg 
                        class="w-4 h-4 text-gray-300 dark:text-gray-600 
                               group-hover:text-gray-400 dark:group-hover:text-gray-500
                               group-hover:translate-x-0.5
                               transition-all duration-150 flex-shrink-0"
                        :class="{ 'text-gray-400 dark:text-gray-500 translate-x-0.5': selectedIndex === {{ $index }} }"
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @empty
                <!-- Empty State -->
                <div class="px-4 py-10 text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 dark:bg-white/5 mb-3">
                        <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Tidak ditemukan</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Coba kata kunci lain</p>
                </div>
            @endforelse
        </div>

        <!-- Footer with Keyboard Hints -->
        @if(count($results) > 0)
        <div class="flex items-center justify-center gap-4 px-4 py-2 border-t border-gray-100 dark:border-white/10 bg-gray-50/50 dark:bg-white/[0.02]">
            <div class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500">
                <kbd class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-medium bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 shadow-sm">↑</kbd>
                <kbd class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-medium bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 shadow-sm">↓</kbd>
                <span class="ml-1">navigasi</span>
            </div>
            <div class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500">
                <kbd class="inline-flex items-center justify-center h-5 px-1.5 text-[10px] font-medium bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 shadow-sm">↵</kbd>
                <span class="ml-1">buka</span>
            </div>
            <div class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500">
                <kbd class="inline-flex items-center justify-center h-5 px-1.5 text-[10px] font-medium bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 shadow-sm">esc</kbd>
                <span class="ml-1">tutup</span>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
[x-cloak] { display: none !important; }

/* Custom Scrollbar for Results */
.fi-search-results::-webkit-scrollbar {
    width: 6px;
}

.fi-search-results::-webkit-scrollbar-track {
    background: transparent;
}

.fi-search-results::-webkit-scrollbar-thumb {
    background-color: rgba(156, 163, 175, 0.4);
    border-radius: 3px;
}

.fi-search-results::-webkit-scrollbar-thumb:hover {
    background-color: rgba(156, 163, 175, 0.6);
}

.dark .fi-search-results::-webkit-scrollbar-thumb {
    background-color: rgba(75, 85, 99, 0.5);
}

.dark .fi-search-results::-webkit-scrollbar-thumb:hover {
    background-color: rgba(75, 85, 99, 0.7);
}

/* Search Highlight */
.fi-navigation-search mark {
    background-color: #fef08a;
    color: #854d0e;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-weight: 600;
}

.dark .fi-navigation-search mark {
    background-color: rgba(250, 204, 21, 0.2);
    color: #fde047;
}
</style>
