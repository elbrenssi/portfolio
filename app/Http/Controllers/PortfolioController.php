<?php

namespace App\Http\Controllers;

use App\Repositories\PortfolioRepository;
use App\Support\SeoBuilder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function __construct(private readonly PortfolioRepository $repository) {}

    public function __invoke(Request $request)
    {
        $payload = $this->repository->payload($request->string('project')->toString());

        return Inertia::render('Home', $payload)
            ->withViewData(['seo' => SeoBuilder::fromPayload($payload)]);
    }

    public function sitemap()
    {
        $xml = $this->repository->sitemapXml();
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        return response($this->repository->robotsTxt(), 200)
            ->header('Content-Type', 'text/plain');
    }
}
