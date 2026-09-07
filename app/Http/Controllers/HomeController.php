<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\PageContent;
use App\Models\PortfolioItem;
use App\Models\Post;
use App\Models\Turma;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroContent = PageContent::getSection('home', 'hero');
        $aboutSummary = PageContent::getSection('home', 'about_summary');

        $featuredCourses = Course::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        if ($featuredCourses->isEmpty()) {
            $featuredCourses = Course::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->take(6)
                ->get();
        }

        $openTurmas = Turma::with('course')
            ->where('status', '!=', 'Encerrada')
            ->whereHas('course', function ($q) {
                $q->where('is_active', true);
            })
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();

        $portfolioItems = PortfolioItem::where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        if ($portfolioItems->isEmpty()) {
            $portfolioItems = PortfolioItem::orderBy('sort_order', 'asc')->take(6)->get();
        }

        $latestPosts = Post::published()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('home', compact(
            'heroContent',
            'aboutSummary',
            'featuredCourses',
            'openTurmas',
            'portfolioItems',
            'latestPosts'
        ));
    }
}
