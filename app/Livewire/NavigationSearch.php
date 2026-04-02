<?php

namespace App\Livewire;

use App\Services\NavigationIndexer;
use Livewire\Component;

class NavigationSearch extends Component
{
    public string $search = '';
    public array $results = [];

    protected NavigationIndexer $indexer;

    public function boot(NavigationIndexer $indexer)
    {
        $this->indexer = $indexer;
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
        // Clear search
        $this->search = '';
        $this->results = [];
        
        // Navigate to URL
        return redirect($url);
    }

    public function render()
    {
        return view('livewire.navigation-search', [
            'indexer' => $this->indexer,
        ]);
    }
}
