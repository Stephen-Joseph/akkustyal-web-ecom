<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $hero = HeroSection::where('section', 'home')->firstOrFail();

        return view('index', compact('hero'));
    }
}
