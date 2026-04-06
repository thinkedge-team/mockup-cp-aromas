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
    {{-- ===================== INPUT ROW ===================== --}}
    <div class="fi-search-input-row">
        {{-- Icon / Spinner --}}
        <div class="fi-search-icon-wrap" aria-hidden="true">
            <svg x-show="!loading" class="fi-search-svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <svg x-show="loading" x-cloak class="fi-search-svg fi-search-svg--spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
        </div>

        {{-- Input --}}
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

        {{-- ⌘K badge --}}
        <div x-show="search.length === 0" class="fi-search-kbd-wrap" aria-hidden="true">
            <kbd class="fi-search-kbd">⌘</kbd>
            <kbd class="fi-search-kbd">K</kbd>
        </div>

        {{-- Clear button --}}
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
            aria-label="Hapus pencarian"
        >
            <svg style="width:13px;height:13px;display:block;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- ===================== DROPDOWN ===================== --}}
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
        {{-- Header --}}
        <div class="fi-search-dropdown-header">
            <span class="fi-search-dropdown-label">Hasil Pencarian</span>
            <span class="fi-search-dropdown-count">{{ count($results) }} menu</span>
        </div>

        {{-- Results --}}
        <div class="fi-search-results-list">
            @forelse($results as $index => $result)
                <a
                    href="{{ $result['url'] }}"
                    wire:click="selectItem('{{ $result['url'] }}', '{{ addslashes($result['label']) }}', '{{ addslashes($result['group']) }}', '{{ $result['icon'] }}')"
                    data-search-result
                    data-index="{{ $index }}"
                    :class="{ 'fi-search-item--active': selectedIndex === {{ $index }} }"
                    class="fi-search-item"
                >
                    {{-- Icon box: ukuran dikunci ketat, overflow hidden --}}
                    <span class="fi-search-item-icon" aria-hidden="true">
                        <x-filament::icon
                            :icon="$result['icon']"
                            class="fi-search-item-icon-svg"
                        />
                    </span>

                    {{-- Teks --}}
                    <span class="fi-search-item-body">
                        <span class="fi-search-item-label">
                            {!! $indexer->highlightMatch($result['label'], $search) !!}
                        </span>
                        <span class="fi-search-item-group">
                            <svg style="width:10px;height:10px;flex-shrink:0;display:block;" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                            </svg>
                            <span class="fi-search-item-group-text">
                                {!! $indexer->highlightMatch($result['group'], $search) !!}
                            </span>
                        </span>
                    </span>

                    {{-- Arrow --}}
                    <svg
                        class="fi-search-item-arrow"
                        :class="{ 'fi-search-item-arrow--active': selectedIndex === {{ $index }} }"
                        style="width:13px;height:13px;flex-shrink:0;display:block;"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @empty
                <div class="fi-search-empty">
                    <div class="fi-search-empty-icon">
                        <svg style="width:20px;height:20px;display:block;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <p class="fi-search-empty-title">Tidak ditemukan</p>
                    <p class="fi-search-empty-subtitle">Coba kata kunci lain</p>
                </div>
            @endforelse
        </div>

        {{-- Footer --}}
        @if(count($results) > 0)
        <div class="fi-search-footer">
            <span class="fi-search-hint">
                <kbd class="fi-search-hint-kbd">↑</kbd>
                <kbd class="fi-search-hint-kbd">↓</kbd>
                <span class="fi-search-hint-text">navigasi</span>
            </span>
            <span class="fi-search-hint">
                <kbd class="fi-search-hint-kbd">↵</kbd>
                <span class="fi-search-hint-text">buka</span>
            </span>
            <span class="fi-search-hint">
                <kbd class="fi-search-hint-kbd">esc</kbd>
                <span class="fi-search-hint-text">tutup</span>
            </span>
        </div>
        @endif
    </div>

    <style>
    [x-cloak] { display: none !important; }

/* ============================================================
   INPUT ROW
   ============================================================ */
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
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
    transition: border-color .15s, box-shadow .15s;
    cursor: text;
}
.dark .fi-search-input-row {
    background: rgba(255,255,255,.05);
    border-color: rgba(255,255,255,.1);
    box-shadow: none;
}
.fi-search-input-row:focus-within {
    border-color: rgb(var(--primary-500, 99 102 241));
    box-shadow: 0 0 0 3px rgba(var(--primary-500, 99 102 241),.15), 0 1px 3px rgba(0,0,0,.06);
}

/* Icon wrap — dimensi tetap, tidak bisa melar */
.fi-search-icon-wrap {
    flex: 0 0 18px;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.fi-search-svg {
    display: block;
    width: 15px;
    height: 15px;
    color: #a09e98;
    transition: color .15s;
}
.fi-search-input-row:focus-within .fi-search-svg {
    color: rgb(var(--primary-500, 99 102 241));
}
.fi-search-svg--spin {
    color: rgb(var(--primary-500, 99 102 241));
    animation: fi-spin .75s linear infinite;
}
@keyframes fi-spin { to { transform: rotate(360deg); } }

/* Input field */
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
.dark .fi-search-field { color: #f9fafb; }
.fi-search-field::placeholder { color: #b5b2aa; }
.dark .fi-search-field::placeholder { color: #6b7280; }

/* ⌘K badge */
.fi-search-kbd-wrap {
    flex: 0 0 auto;
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
    background: rgba(255,255,255,.06);
    border-color: rgba(255,255,255,.1);
}

/* Clear button */
.fi-search-clear-btn {
    flex: 0 0 22px;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: none;
    background: transparent;
    color: #a09e98;
    cursor: pointer;
    transition: color .1s, background .1s;
    padding: 0;
}
.fi-search-clear-btn:hover {
    color: #374151;
    background: #f3f2ef;
}
.dark .fi-search-clear-btn { color: #6b7280; }
.dark .fi-search-clear-btn:hover { color: #e5e7eb; background: rgba(255,255,255,.08); }

/* ============================================================
   DROPDOWN
   ============================================================ */
.fi-search-dropdown {
    position: absolute;
    right: 0;
    top: calc(100% + 8px);
    width: 320px;
    background: #ffffff;
    border: 1.5px solid #e5e3de;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,.10), 0 2px 8px rgba(0,0,0,.06);
    overflow: hidden;
    z-index: 50;
}
.dark .fi-search-dropdown {
    background: #111827;
    border-color: rgba(255,255,255,.1);
    box-shadow: 0 8px 30px rgba(0,0,0,.4);
}

/* Dropdown header */
.fi-search-dropdown-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 9px 14px;
    border-bottom: 1px solid #f0ede8;
}
.dark .fi-search-dropdown-header { border-bottom-color: rgba(255,255,255,.07); }

.fi-search-dropdown-label {
    font-size: 10.5px;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: #a09e98;
}
.dark .fi-search-dropdown-label { color: #6b7280; }

.fi-search-dropdown-count {
    font-size: 11.5px;
    font-weight: 500;
    color: #b5b2aa;
    background: #f5f4f1;
    border-radius: 20px;
    padding: 2px 9px;
}
.dark .fi-search-dropdown-count { color: #6b7280; background: rgba(255,255,255,.06); }

/* Results list */
.fi-search-results-list {
    max-height: 288px;
    overflow-y: auto;
    overscroll-behavior: contain;
}
.fi-search-results-list::-webkit-scrollbar { width: 4px; }
.fi-search-results-list::-webkit-scrollbar-track { background: transparent; }
.fi-search-results-list::-webkit-scrollbar-thumb { background: rgba(156,163,175,.3); border-radius: 2px; }
.fi-search-results-list::-webkit-scrollbar-thumb:hover { background: rgba(156,163,175,.5); }
.dark .fi-search-results-list::-webkit-scrollbar-thumb { background: rgba(75,85,99,.4); }

/* ============================================================
   RESULT ITEM
   ============================================================ */
.fi-search-item {
    /* Layout utama: flex row, tinggi terkunci */
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 11px;
    padding: 10px 14px;
    min-height: 54px;
    max-height: 54px;          /* kunci tinggi agar tidak melar */
    overflow: hidden;           /* potong apapun yang keluar batas */
    text-decoration: none;
    cursor: pointer;
    border-bottom: 1px solid #f5f3f0;
    transition: background .08s;
    box-sizing: border-box;
}
.fi-search-item:last-child { border-bottom: none; }
.dark .fi-search-item { border-bottom-color: rgba(255,255,255,.05); }

.fi-search-item:hover,
.fi-search-item--active {
    background: #faf9f7;
}
.dark .fi-search-item:hover,
.dark .fi-search-item--active {
    background: rgba(255,255,255,.04);
}

/* Icon box — triple-locked: flex, width/height, overflow */
.fi-search-item-icon {
    flex: 0 0 32px;
    width: 32px;
    height: 32px;
    min-width: 32px;
    min-height: 32px;
    max-width: 32px;
    max-height: 32px;
    border-radius: 8px;
    overflow: hidden;           /* potong apapun yang melebihi box */
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgb(var(--primary-50, 238 242 255));
    color: rgb(var(--primary-600, 79 70 229));
    transition: background .12s;
    box-sizing: border-box;
}
.dark .fi-search-item-icon {
    background: rgba(var(--primary-500, 99 102 241), .12);
    color: rgb(var(--primary-400, 129 140 248));
}
.fi-search-item:hover .fi-search-item-icon,
.fi-search-item--active .fi-search-item-icon {
    background: rgb(var(--primary-100, 224 231 255));
}
.dark .fi-search-item:hover .fi-search-item-icon,
.dark .fi-search-item--active .fi-search-item-icon {
    background: rgba(var(--primary-500, 99 102 241), .2);
}

/* Force semua child di dalam icon box ke 16×16 — tidak bisa keluar */
.fi-search-item-icon *,
.fi-search-item-icon svg,
.fi-search-item-icon img,
.fi-search-item-icon-svg {
    display: block !important;
    width: 16px !important;
    height: 16px !important;
    min-width: 16px !important;
    min-height: 16px !important;
    max-width: 16px !important;
    max-height: 16px !important;
    flex-shrink: 0 !important;
    object-fit: contain !important;
}

/* Body teks */
.fi-search-item-body {
    flex: 1;
    min-width: 0;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.fi-search-item-label {
    display: block;
    font-size: 13.5px;
    font-weight: 500;
    color: #111827;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.3;
}
.dark .fi-search-item-label { color: #f9fafb; }

/* Sembunyikan elemen non-teks yang mungkin dirender di dalam label */
.fi-search-item-label img,
.fi-search-item-label svg,
.fi-search-item-group-text img,
.fi-search-item-group-text svg {
    display: none !important;
}

.fi-search-item-group {
    display: flex;
    align-items: center;
    gap: 4px;
    color: #b5b2aa;
    overflow: hidden;
}
.dark .fi-search-item-group { color: #6b7280; }

.fi-search-item-group-text {
    font-size: 11.5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
}

/* Arrow */
.fi-search-item-arrow {
    color: #d1cdc7;
    transition: transform .1s, color .1s;
    flex-shrink: 0;
}
.dark .fi-search-item-arrow { color: #4b5563; }
.fi-search-item:hover .fi-search-item-arrow,
.fi-search-item-arrow--active {
    transform: translateX(2px);
    color: #a09e98;
}
.dark .fi-search-item:hover .fi-search-item-arrow,
.dark .fi-search-item-arrow--active { color: #9ca3af; }

/* ============================================================
   EMPTY STATE
   ============================================================ */
.fi-search-empty {
    padding: 36px 16px;
    text-align: center;
}
.fi-search-empty-icon {
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
.dark .fi-search-empty-icon { background: rgba(255,255,255,.05); color: #6b7280; }
.fi-search-empty-title {
    font-size: 13.5px;
    font-weight: 500;
    color: #374151;
}
.dark .fi-search-empty-title { color: #f9fafb; }
.fi-search-empty-subtitle {
    font-size: 12px;
    color: #b5b2aa;
    margin-top: 3px;
}
.dark .fi-search-empty-subtitle { color: #6b7280; }

/* ============================================================
   FOOTER KEYBOARD HINTS
   ============================================================ */
.fi-search-footer {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    padding: 8px 14px;
    border-top: 1px solid #f0ede8;
    background: #faf9f7;
}
.dark .fi-search-footer {
    border-top-color: rgba(255,255,255,.07);
    background: rgba(255,255,255,.02);
}
.fi-search-hint {
    display: flex;
    align-items: center;
    gap: 4px;
}
.fi-search-hint-text {
    font-size: 11px;
    color: #b5b2aa;
}
.dark .fi-search-hint-text { color: #6b7280; }
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
    box-shadow: 0 1px 2px rgba(0,0,0,.06);
    color: #a09e98;
}
.dark .fi-search-hint-kbd {
    background: #1f2937;
    border-color: rgba(255,255,255,.1);
    box-shadow: none;
    color: #6b7280;
}

/* ============================================================
   HIGHLIGHT MARK
   ============================================================ */
.fi-navigation-search mark {
    background-color: #fef3c7;
    color: #92400e;
    padding: 1px 3px;
    border-radius: 3px;
    font-weight: 600;
    font-style: normal;
}
.dark .fi-navigation-search mark {
    background-color: rgba(250,204,21,.18);
    color: #fde047;
}
    </style>
</div>