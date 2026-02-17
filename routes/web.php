<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

Route::get('/', PortfolioController::class)->name('home');
Route::get('/sitemap.xml', [PortfolioController::class, 'sitemap']);
Route::get('/robots.txt', [PortfolioController::class, 'robots']);
Route::post('/locale', function (Request $request) {
    $locale = $request->input('locale', 'en');
    abort_unless(in_array($locale, ['en', 'fr', 'ar'], true), 400);

    return back()->withCookie(Cookie::make('locale', $locale, 60 * 24 * 365));
});
