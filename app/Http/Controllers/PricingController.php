<?php

namespace App\Http\Controllers;

class PricingController extends Controller
{
    public function index()
    {
        $pricing = [
            ['name' => 'Qaida Noorania', 'slug' => 'qaida-noorania', 'duration' => '3 Months', 'rate' => 10],
            ['name' => 'Nazra Quran', 'slug' => 'nazra-quran', 'duration' => '12 Months', 'rate' => 10],
            ['name' => 'Tajweed Rules', 'slug' => 'tajweed-rules', 'duration' => '3 Months', 'rate' => 5],
            ['name' => 'Daily Duas', 'slug' => 'daily-duas', 'duration' => '3 Months', 'rate' => 10],
            ['name' => 'Islamic Studies', 'slug' => 'islamic-studies', 'duration' => '6 Months', 'rate' => 10],
            ['name' => 'Hifz Revision', 'slug' => 'hifz-revision', 'duration' => '12 Months', 'rate' => 15],
            ['name' => 'Quran Memorization', 'slug' => 'quran-memorization', 'duration' => '24 Months', 'rate' => 20],
        ];

        return view('pricing', compact('pricing'));
    }
}