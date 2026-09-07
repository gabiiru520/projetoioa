<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function index()
    {
        $homeHero = PageContent::getSection('home', 'hero');
        $homeAbout = PageContent::getSection('home', 'about_summary');
        $sobreInstitucional = PageContent::getSection('sobre', 'institucional');
        $contatoInfo = PageContent::getSection('contato', 'info');

        return view('admin.pages.index', compact(
            'homeHero',
            'homeAbout',
            'sobreInstitucional',
            'contatoInfo'
        ));
    }

    public function update(Request $request)
    {
        $page = $request->input('page');
        $section = $request->input('section');

        $validated = $request->validate([
            'page' => 'required|string',
            'section' => 'required|string',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'extra_data' => 'nullable|array',
        ]);

        PageContent::updateOrCreate(
            ['page' => $page, 'section' => $section],
            [
                'title' => $validated['title'] ?? null,
                'subtitle' => $validated['subtitle'] ?? null,
                'content' => $validated['content'] ?? null,
                'extra_data' => $validated['extra_data'] ?? null,
            ]
        );

        return back()->with('success', "Seção [{$section}] da página [{$page}] atualizada com sucesso!");
    }
}
