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
    <div class="fi-search-input-row">
        <!-- Search Icon / Loading Spinner -->
        <div class="fi-search-icon-wrap pointer-events-none">
            <svg 
                x-show="!loading" 
                class="fi-search-icon"
                fill="none" 
                stroke="currentColor" 
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <svg 
                x-show="loading" 
                x-cloak
                class="fi-search-icon fi-search-icon--spin"
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
            class="fi-search-field"
        >
        
        <!-- Keyboard Shortcut Badge -->
        <div 
            x-show="search.length === 0"
            class="fi-search-kbd-wrap pointer-events-none"
        >
            <kbd class="fi-search-kbd">⌘</kbd>
            <kbd class="fi-search-kbd">K</kbd>
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
            class="fi-search-clear-btn"
        >
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
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
        class="fi-search-dropdown"
    >
        <!-- Results Header -->
        <div class="fi-search-dropdown-header">
            <span class="fi-search-dropdown-header-label">
                Hasil Pencarian
            </span>
            <span class="fi-search-dropdown-count">
                {{ count($results) }} menu
            </span>
        </div>

        <!-- Results List -->
        <div class="fi-search-results">
            @forelse($results as $index => $result)
                <a 
                    href="{{ $result['url'] }}"
                    wire:click="selectItem('{{ $result['url'] }}', '{{ addslashes($result['label']) }}', '{{ addslashes($result['group']) }}', '{{ $result['icon'] }}')"
                    data-search-result
                    data-index="{{ $index }}"
                    :class="{ 'fi-search-result--active': selectedIndex === {{ $index }} }"
                    class="fi-search-result group"
                >
                    <!-- Icon -->
                    <div class="fi-search-result-icon">
                        <x-filament::icon 
                            :icon="$result['icon']" 
                            class="w-4 h-4"
                        />
                    </div>
                    
                    <!-- Content -->
                    <div class="fi-search-result-content">
                        <div class="fi-search-result-label">
                            {!! $indexer->highlightMatch($result['label'], $search) !!}
                        </div>
                        <div class="fi-search-result-group">
                            <svg class="w-2.5 h-2.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                            </svg>
                            <span class="truncate">
                                {!! $indexer->highlightMatch($result['group'], $search) !!}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Arrow -->
                    <svg 
                        class="fi-search-result-arrow"
                        :class="{ 'fi-search-result-arrow--active': selectedIndex === {{ $index }} }"
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
                <div class="fi-search-empty">
                    <div class="fi-search-empty-icon-wrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="fi-search-empty-title">Tidak ditemukan</p>
                    <p class="fi-search-empty-subtitle">Coba kata kunci lain</p>
                </div>
            @endforelse
        </div>

        <!-- Footer with Keyboard Hints -->
        @if(count($results) > 0)
        <div class="fi-search-footer">
            <div class="fi-search-hint">
                <kbd class="fi-search-hint-kbd">↑</kbd>
                <kbd class="fi-search-hint-kbd">↓</kbd>
                <span>navigasi</span>
            </div>
            <div class="fi-search-hint">
                <kbd class="fi-search-hint-kbd">↵</kbd>
                <span>buka</span>
            </div>
            <div class="fi-search-hint">
                <kbd class="fi-search-hint-kbd">esc</kbd>
                <span>tutup</span>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
[x-cloak] { display: none !important; }

/* =============================================
   INPUT ROW — flex container menggantikan
   pendekatan absolute-positioning lama
   ============================================= */
.fi-search-input-row {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 272px;
    height: 38px;
    padding: 0 10px 0 12px;
    background: #ffffff;
    border: 1.5px solid #e5e3de;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
    cursor: text;
}

.dark .fi-search-input-row {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
    box-shadow: none;
}

.fi-search-input-row:focus-within {
    border-color: rgb(var(--primary-500));
    box-shadow: 0 0 0 3px rgba(var(--primary-500), 0.15), 0 1px 3px rgba(0, 0, 0, 0.06);
}

/* Icon wrapper — ukuran tetap agar tidak menempel placeholder */
.fi-search-icon-wrap {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
}

.fi-search-icon {
    width: 15px;
    height: 15px;
    color: #a09e98;
    transition: color 0.15s ease;
}

.fi-search-input-row:focus-within .fi-search-icon {
    color: rgb(var(--primary-500));
}

.fi-search-icon--spin {
    color: rgb(var(--primary-500));
    animation: fi-spin 0.75s linear infinite;
}

@keyframes fi-spin {
    to { transform: rotate(360deg); }
}

/* Input field — flex: 1 mengisi sisa ruang */
.fi-search-field {
    flex: 1;
    min-width: 0;
    border: none;
    background: transparent;
    outline: none;
    font-size: 13.5px;
    line-height: 1;
    color: #111827;
    font-family: inherit;
}

.dark .fi-search-field {
    color: #f9fafb;
}

.fi-search-field::placeholder {
    color: #b5b2aa;
}

.dark .fi-search-field::placeholder {
    color: #6b7280;
}

/* ⌘K badge — dua kbd terpisah */
.fi-search-kbd-wrap {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 3px;
}

.fi-search-kbd {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 20px;
    min-width: 20px;
    padding: 0 5px;
    font-size: 11px;
    font-family: inherit;
    font-weight: 500;
    color: #b5b2aa;
    background: #f3f2ef;
    border: 1px solid #e5e3de;
    border-radius: 5px;
    line-height: 1;
}

.dark .fi-search-kbd {
    color: #6b7280;
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(255, 255, 255, 0.1);
}

/* Clear button */
.fi-search-clear-btn {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    color: #a09e98;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: color 0.1s, background 0.1s;
}

.fi-search-clear-btn:hover {
    color: #374151;
    background: #f3f2ef;
}

.dark .fi-search-clear-btn:hover {
    color: #e5e7eb;
    background: rgba(255, 255, 255, 0.08);
}

/* =============================================
   DROPDOWN PANEL
   ============================================= */
.fi-search-dropdown {
    position: absolute;
    right: 0;
    top: calc(100% + 8px);
    width: 320px;
    background: #ffffff;
    border: 1.5px solid #e5e3de;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.10), 0 2px 8px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    z-index: 50;
}

.dark .fi-search-dropdown {
    background: #111827;
    border-color: rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
}

/* Dropdown header */
.fi-search-dropdown-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 14px;
    border-bottom: 1px solid #f0ede8;
}

.dark .fi-search-dropdown-header {
    border-bottom-color: rgba(255, 255, 255, 0.07);
}

.fi-search-dropdown-header-label {
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #a09e98;
}

.dark .fi-search-dropdown-header-label {
    color: #6b7280;
}

.fi-search-dropdown-count {
    font-size: 11.5px;
    font-weight: 500;
    color: #b5b2aa;
    background: #f5f4f1;
    border-radius: 20px;
    padding: 2px 9px;
}

.dark .fi-search-dropdown-count {
    color: #6b7280;
    background: rgba(255, 255, 255, 0.06);
}

/* Results list scrollable */
.fi-search-results {
    max-height: 288px;
    overflow-y: auto;
    overscroll-behavior: contain;
}

.fi-search-results::-webkit-scrollbar { width: 5px; }
.fi-search-results::-webkit-scrollbar-track { background: transparent; }
.fi-search-results::-webkit-scrollbar-thumb { background: rgba(156, 163, 175, 0.35); border-radius: 3px; }
.fi-search-results::-webkit-scrollbar-thumb:hover { background: rgba(156, 163, 175, 0.55); }
.dark .fi-search-results::-webkit-scrollbar-thumb { background: rgba(75, 85, 99, 0.45); }
.dark .fi-search-results::-webkit-scrollbar-thumb:hover { background: rgba(75, 85, 99, 0.65); }

/* Result item */
.fi-search-result {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 10px 14px;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.08s ease;
}

.fi-search-result:hover,
.fi-search-result--active {
    background: #faf9f7;
}

.dark .fi-search-result:hover,
.dark .fi-search-result--active {
    background: rgba(255, 255, 255, 0.04);
}

/* Result icon box */
.fi-search-result-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 9px;
    background: rgb(var(--primary-50, 238 242 255));
    color: rgb(var(--primary-600, 79 70 229));
    transition: background 0.12s ease;
}

.dark .fi-search-result-icon {
    background: rgba(var(--primary-500, 99 102 241), 0.12);
    color: rgb(var(--primary-400, 129 140 248));
}

.fi-search-result:hover .fi-search-result-icon,
.fi-search-result--active .fi-search-result-icon {
    background: rgb(var(--primary-100, 224 231 255));
}

.dark .fi-search-result:hover .fi-search-result-icon,
.dark .fi-search-result--active .fi-search-result-icon {
    background: rgba(var(--primary-500, 99 102 241), 0.2);
}

/* Result text content */
.fi-search-result-content {
    flex: 1;
    min-width: 0;
}

.fi-search-result-label {
    font-size: 13.5px;
    font-weight: 500;
    color: #111827;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dark .fi-search-result-label {
    color: #f9fafb;
}

.fi-search-result-group {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-top: 2px;
    color: #b5b2aa;
    font-size: 11.5px;
}

.dark .fi-search-result-group {
    color: #6b7280;
}

/* Arrow */
.fi-search-result-arrow {
    flex-shrink: 0;
    width: 14px;
    height: 14px;
    color: #d1cdc7;
    transition: transform 0.1s ease, color 0.1s ease;
}

.dark .fi-search-result-arrow {
    color: #4b5563;
}

.fi-search-result:hover .fi-search-result-arrow,
.fi-search-result-arrow--active {
    transform: translateX(2px);
    color: #a09e98;
}

.dark .fi-search-result:hover .fi-search-result-arrow,
.dark .fi-search-result-arrow--active {
    color: #9ca3af;
}

/* Empty state */
.fi-search-empty {
    padding: 36px 16px;
    text-align: center;
}

.fi-search-empty-icon-wrap {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #f5f4f1;
    color: #c0bdb6;
    margin-bottom: 10px;
}

.dark .fi-search-empty-icon-wrap {
    background: rgba(255, 255, 255, 0.05);
    color: #6b7280;
}

.fi-search-empty-title {
    font-size: 13.5px;
    font-weight: 500;
    color: #374151;
}

.dark .fi-search-empty-title {
    color: #f9fafb;
}

.fi-search-empty-subtitle {
    font-size: 12px;
    color: #b5b2aa;
    margin-top: 3px;
}

.dark .fi-search-empty-subtitle {
    color: #6b7280;
}

/* Footer keyboard hints */
.fi-search-footer {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 18px;
    padding: 8px 14px;
    border-top: 1px solid #f0ede8;
    background: #faf9f7;
}

.dark .fi-search-footer {
    border-top-color: rgba(255, 255, 255, 0.07);
    background: rgba(255, 255, 255, 0.02);
}

.fi-search-hint {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    color: #b5b2aa;
}

.dark .fi-search-hint {
    color: #6b7280;
}

.fi-search-hint-kbd {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 20px;
    height: 20px;
    padding: 0 5px;
    font-size: 10px;
    font-family: inherit;
    font-weight: 500;
    background: #ffffff;
    border: 1px solid #e5e3de;
    border-radius: 5px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
    color: #a09e98;
}

.dark .fi-search-hint-kbd {
    background: #1f2937;
    border-color: rgba(255, 255, 255, 0.1);
    box-shadow: none;
    color: #6b7280;
}

/* Search highlight mark */
.fi-navigation-search mark {
    background-color: #fef3c7;
    color: #92400e;
    padding: 1px 3px;
    border-radius: 3px;
    font-weight: 600;
    font-style: normal;
}

.dark .fi-navigation-search mark {
    background-color: rgba(250, 204, 21, 0.18);
    color: #fde047;
}
</style>