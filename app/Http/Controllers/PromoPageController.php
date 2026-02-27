<?php

namespace App\Http\Controllers;

use App\Models\PromoCampaign;
use App\Models\PromoCtaSection;
use App\Models\PromoFilterCategory;
use App\Models\PromoHeroSetting;
use App\Models\PromoHowtoSection;
use Illuminate\Http\Request;

class PromoPageController extends Controller
{
    /**
     * Display the promo page with all active promotions
     */
    public function index()
    {
        // Get hero settings
        $heroSettings = PromoHeroSetting::getInstance();

        // Get how-to claim settings
        $howtoSettings = PromoHowtoSection::getInstance();

        // Get CTA settings
        $ctaSettings = PromoCtaSection::getInstance();

        // Get filter categories
        $filterCategories = PromoFilterCategory::active()->get();

        // Get active promos ordered by sort_order
        $promos = PromoCampaign::active()
            ->ordered()
            ->get();

        // Get featured promo for banner
        $featuredPromo = PromoCampaign::active()
            ->featured()
            ->first();

        // Count active promos
        $activePromoCount = $promos->count();

        return view('promo', compact(
            'heroSettings',
            'howtoSettings',
            'ctaSettings',
            'filterCategories',
            'promos',
            'featuredPromo',
            'activePromoCount'
        ));
    }
}
