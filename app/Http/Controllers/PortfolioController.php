<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCtaSetting;
use App\Models\PortfolioImpactStat;
use App\Models\PortfolioKeunggulan;
use App\Models\PortfolioMitraLogo;
use App\Models\PortfolioPartner;
use App\Models\PortfolioSetting;
use App\Models\PortfolioTestimonial;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Get portfolio settings
        $portfolioSettings = PortfolioSetting::getInstance();

        // Get partners grouped by category
        $partners = PortfolioPartner::active()->get()->groupBy('category');

        // Get testimonials
        $testimonials = PortfolioTestimonial::active()->get();

        // Get impact stats
        $impactStats = PortfolioImpactStat::active()->get();

        // Get keunggulan
        $keunggulan = PortfolioKeunggulan::active()->get();

        // Get mitra logos
        $mitraLogos = PortfolioMitraLogo::active()->get();

        // Get CTA settings
        $ctaSettings = PortfolioCtaSetting::getInstance();

        return view('portfolio', compact(
            'portfolioSettings',
            'partners',
            'testimonials',
            'impactStats',
            'keunggulan',
            'mitraLogos',
            'ctaSettings'
        ));
    }
}
