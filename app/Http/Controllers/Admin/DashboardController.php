<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\PortfolioItem;
use App\Models\Post;
use App\Models\Turma;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'courses_count' => Course::count(),
            'active_courses_count' => Course::where('is_active', true)->count(),
            'turmas_count' => Turma::where('status', 'Inscrições abertas')->count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'posts_count' => Post::count(),
            'portfolio_count' => PortfolioItem::count(),
        ];

        $latestMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();
        $upcomingTurmas = Turma::with('course')->orderBy('start_date', 'asc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages', 'upcomingTurmas'));
    }
}
