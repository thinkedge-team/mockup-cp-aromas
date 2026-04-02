<div 
    x-data="{ 
        open: @entangle('isOpen'),
        focusSearch() {
            this.$nextTick(() => {
                this.$refs.searchInput?.focus();
            });
        }
    }" 
    x-init="$watch('open', value => { if (value) focusSearch(); })"
    class="navigation-search-wrapper"
>
    <!-- Search Trigger Button -->
    <button 
        @click="$wire.openModal()"
        type="button"
        class="nav-search-trigger group relative flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 bg-white hover:border-primary-500 hover:shadow-md transition-all duration-200 text-gray-500 hover:text-gray-700"
    >
        <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span class="text-sm font-medium hidden sm:inline">Cari menu...</span>
    </button>

    <!-- Search Modal -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        @click.away="$wire.closeModal()"
        class="absolute right-0 top-14 w-[500px] max-w-[95vw] bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden z-50"
        style="display: none;"
    >
        <!-- Search Input Section -->
        <div class="p-4 border-b border-gray-100">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    x-ref="searchInput"
                    wire:model.live.debounce.200ms="search"
                    type="text" 
                    placeholder="Ketik untuk mencari menu..."
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm transition-all"
                >
            </div>
        </div>

        <!-- Results Container -->
        <div class="max-h-[400px] overflow-y-auto">
            
            @if(empty($search))
                <!-- Recent Searches Section -->
                @if(!empty($recentSearches))
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pencarian Terakhir
                            </h3>
                            <button 
                                wire:click="clearRecentSearches"
                                class="text-xs text-gray-400 hover:text-red-600 transition-colors"
                            >
                                Hapus
                            </button>
                        </div>
                        <div class="space-y-1">
                            @foreach($recentSearches as $recent)
                                <a 
                                    href="{{ $recent['url'] }}"
                                    wire:click="selectItem('{{ $recent['url'] }}', '{{ addslashes($recent['label']) }}', '{{ addslashes($recent['group']) }}', '{{ $recent['icon'] }}')"
                                    class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-gradient-to-r hover:from-success-50 hover:to-primary-50 transition-all duration-150 group cursor-pointer"
                                >
                                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-success-600 flex items-center justify-center text-white shadow-sm">
                                        <x-filament::icon 
                                            icon="{{ $recent['icon'] }}" 
                                            class="h-4 w-4"
                                        />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-medium text-gray-900 truncate">
                                            {{ $recent['label'] }}
                                        </div>
                                        <div class="text-xs text-gray-500 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                                            </svg>
                                            {{ $recent['group'] }}
                                        </div>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Empty State - No Recent -->
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Mulai mencari menu...</p>
                        <p class="text-xs text-gray-400">Coba: Hero, Blog, Product, Contact</p>
                    </div>
                @endif
            @else
                <!-- Search Results Section -->
                <div class="p-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Hasil Pencarian
                    </h3>
                    
                    @forelse($results as $result)
                        <a 
                            href="{{ $result['url'] }}"
                            wire:click="selectItem('{{ $result['url'] }}', '{{ addslashes($result['label']) }}', '{{ addslashes($result['group']) }}', '{{ $result['icon'] }}')"
                            class="flex items-center gap-3 p-3 mb-2 rounded-lg hover:bg-gradient-to-r hover:from-success-50 hover:to-primary-50 transition-all duration-150 group cursor-pointer border border-transparent hover:border-primary-200"
                        >
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-primary-500 to-success-600 flex items-center justify-center text-white shadow-md group-hover:shadow-lg transition-shadow">
                                <x-filament::icon 
                                    icon="{{ $result['icon'] }}" 
                                    class="h-5 w-5"
                                />
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-semibold text-gray-900 truncate mb-0.5">
                                    {!! $indexer->highlightMatch($result['label'], $search) !!}
                                </div>
                                <div class="text-xs text-gray-500 flex items-center gap-1">
                                    <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                                    </svg>
                                    <span class="truncate">{!! $indexer->highlightMatch($result['group'], $search) !!}</span>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @empty
                        <!-- Empty State - No Results -->
                        <div class="py-8 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-yellow-100 flex items-center justify-center">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Tidak ada menu yang cocok</p>
                            <p class="text-xs text-gray-500">Coba kata kunci lain atau periksa ejaan</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>

        <!-- Footer Tip -->
        <div class="border-t border-gray-100 px-4 py-2 bg-gray-50">
            <p class="text-xs text-gray-500 text-center flex items-center justify-center gap-2">
                <svg class="w-3.5 h-3.5 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                Klik menu untuk membuka halaman
            </p>
        </div>
    </div>

    <!-- Backdrop -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="$wire.closeModal()"
        class="fixed inset-0 bg-gray-900/20 backdrop-blur-sm z-40"
        style="display: none;"
    ></div>
</div>

<style>
/* Custom Scrollbar */
.navigation-search-wrapper .max-h-\[400px\]::-webkit-scrollbar {
    width: 6px;
}

.navigation-search-wrapper .max-h-\[400px\]::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
}

.navigation-search-wrapper .max-h-\[400px\]::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
}

.navigation-search-wrapper .max-h-\[400px\]::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Highlight Mark Styling */
.navigation-search-wrapper mark {
    background-color: #fef3c7;
    color: #92400e;
    font-weight: 600;
    padding: 0 2px;
    border-radius: 2px;
}

/* Animation for search trigger pulse */
@keyframes pulse-ring {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.1);
        opacity: 0;
    }
}

.nav-search-trigger:hover::before {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: 0.5rem;
    background: linear-gradient(135deg, #d4a017, #228b22);
    opacity: 0.1;
    animation: pulse-ring 1.5s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
}
</style>
