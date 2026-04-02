<?php

namespace App\Livewire;

use App\Services\NavigationIndexer;
use Livewire\Component;
use Livewire\Attributes\On;

class NavigationSearch extends Component
{
    public string $search = '';
    public array $results = [];
    public array $recentSearches = [];
    public bool $isOpen = false;

    protected NavigationIndexer $indexer;

    public function boot(NavigationIndexer $indexer)
    {
        $this->indexer = $indexer;
    }

    public function mount()
    {
        $this->loadRecentSearches();
    }

    public function updatedSearch()
    {
        if (empty(trim($this->search))) {
            $this->results = [];
            return;
        }

        $this->results = $this->indexer->search($this->search);
    }

    public function selectItem(string $url, string $label, string $group, string $icon)
    {
        // Save to recent searches
        $this->saveToRecentSearches($label, $group, $icon, $url);
        
        // Close modal
        $this->isOpen = false;
        
        // Navigate to URL
        return redirect($url);
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->search = '';
        $this->results = [];
        $this->loadRecentSearches();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->search = '';
        $this->results = [];
    }

    public function clearRecentSearches()
    {
        session()->forget('navigation_recent_searches');
        $this->recentSearches = [];
    }

    protected function loadRecentSearches()
    {
        $this->recentSearches = session('navigation_recent_searches', []);
    }

    protected function saveToRecentSearches(string $label, string $group, string $icon, string $url)
    {
        $newItem = [
            'label' => $label,
            'group' => $group,
            'icon' => $icon,
            'url' => $url,
            'timestamp' => now()->timestamp,
        ];

        // Get existing recent searches
        $recent = session('navigation_recent_searches', []);

        // Remove duplicate if exists (based on URL)
        $recent = array_filter($recent, function ($item) use ($url) {
            return $item['url'] !== $url;
        });

        // Add new item to beginning
        array_unshift($recent, $newItem);

        // Keep only last 5 items
        $recent = array_slice($recent, 0, 5);

        // Save back to session
        session(['navigation_recent_searches' => $recent]);
    }

    public function render()
    {
        return view('livewire.navigation-search', [
            'indexer' => $this->indexer,
        ]);
    }
}
