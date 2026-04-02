<?php

namespace App\Services;

use Filament\Facades\Filament;
use Illuminate\Support\Str;

class NavigationIndexer
{
    /**
     * Get all navigation items from registered Filament resources
     *
     * @return array
     */
    public function getAllNavigationItems(): array
    {
        $panel = Filament::getCurrentPanel();
        $resources = $panel->getResources();
        $navigationItems = [];

        foreach ($resources as $resource) {
            // Skip resources that are hidden from navigation
            if (!$resource::shouldRegisterNavigation()) {
                continue;
            }

            $navigationItems[] = [
                'label' => $resource::getNavigationLabel(),
                'group' => $resource::getNavigationGroup() ?? 'Lainnya',
                'icon' => $resource::getNavigationIcon() ?? 'heroicon-o-document',
                'url' => $resource::getUrl(),
                'sort' => $resource::getNavigationSort() ?? 999,
                'badge' => $resource::getNavigationBadge(),
                'resource_class' => $resource,
            ];
        }

        // Sort by navigation group and sort order
        usort($navigationItems, function ($a, $b) {
            if ($a['group'] === $b['group']) {
                return $a['sort'] <=> $b['sort'];
            }
            return $a['group'] <=> $b['group'];
        });

        return $navigationItems;
    }

    /**
     * Search navigation items based on query
     *
     * @param string $query
     * @return array
     */
    public function search(string $query): array
    {
        if (empty(trim($query))) {
            return [];
        }

        $allItems = $this->getAllNavigationItems();
        $results = [];
        $queryLower = Str::lower($query);

        foreach ($allItems as $item) {
            $score = 0;
            $labelLower = Str::lower($item['label']);
            $groupLower = Str::lower($item['group']);

            // Exact match in label (highest priority)
            if ($labelLower === $queryLower) {
                $score += 100;
            }
            // Starts with query in label
            elseif (Str::startsWith($labelLower, $queryLower)) {
                $score += 50;
            }
            // Contains query in label
            elseif (Str::contains($labelLower, $queryLower)) {
                $score += 30;
            }

            // Match in group (lower priority)
            if (Str::contains($groupLower, $queryLower)) {
                $score += 10;
            }

            // Add to results if score > 0
            if ($score > 0) {
                $results[] = array_merge($item, ['relevance' => $score]);
            }
        }

        // Sort by relevance score (descending)
        usort($results, function ($a, $b) {
            return $b['relevance'] <=> $a['relevance'];
        });

        // Limit to top 8 results for performance
        return array_slice($results, 0, 8);
    }

    /**
     * Highlight matched text in search results
     *
     * @param string $text
     * @param string $query
     * @return string
     */
    public function highlightMatch(string $text, string $query): string
    {
        if (empty($query)) {
            return e($text);
        }

        return preg_replace(
            '/(' . preg_quote($query, '/') . ')/i',
            '<mark class="bg-yellow-200 text-gray-900 font-semibold px-1 rounded">$1</mark>',
            e($text)
        );
    }
}
