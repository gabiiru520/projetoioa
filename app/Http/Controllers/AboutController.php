<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $aboutContent = PageContent::getSection('sobre', 'institucional');
        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('about', compact('aboutContent', 'teamMembers'));
    }
}
