<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $inventory = $this->inventory();
        $leaders = [
            [
                'image' => 'assets/img/ilya-bulygin.jpg',
                'title' => 'CEO',
                'name' => 'Ilya Bulygin',
                'description' => 'Investor, entrepreneur, top manager of the largest outdoor advertising operators. In the advertising business since 2003. Experience in creating and managing outdoor advertising networks in more than 50 cities in Europe and the CIS countries.',
            ],
            [
                'image' => 'assets/img/maria-faldina.jpg',
                'title' => 'CBDO',
                'name' => 'Maria Faldina',
                'description' => 'Entrepreneur. Over 20 years in the advertising business. Successful experience in building sales teams in large companies, managing her own business since 2007 in Europe.',
            ],
            [
                'image' => 'assets/img/alexander-murzak.jpg',
                'title' => 'CCO',
                'name' => 'Alexander Murzak',
                'description' => 'A visionary Creative Director with 20 years of experience in top global agencies like McCann, MullenLowe, VMLY&R, and DDB. Known for crafting powerful, award-winning campaigns that connect brands with audiences on a profound level.',
            ],
        ];

        $mapConfig = $this->mapConfig();

        return view('home', [
            'inventory' => $inventory,
            'leaders' => $leaders,
            'mapConfig' => $mapConfig,
        ]);
    }

    public function show(int $unit)
    {
        $unitData = collect($this->inventory())->firstWhere('id', $unit);

        abort_unless($unitData, 404);

        return view('location', [
            'unit' => $unitData,
            'mapConfig' => $this->mapConfig(),
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function inventory(): array
    {
        return config('inventory.units', []);
    }

    protected function mapConfig(): array
    {
        return [
            'token' => config('services.mapbox.token'),
            'style' => config('services.mapbox.style'),
        ];
    }
}

