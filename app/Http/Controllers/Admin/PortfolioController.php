<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $items = PortfolioItem::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.portfolio.index', compact('items'));
    }

    public function create()
    {
        $item = new PortfolioItem();
        return view('admin.portfolio.form', compact('item'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'date_label' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolio', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        } else {
            $validated['image'] = 'images/portfolio-default.jpg';
        }
        unset($validated['image_url']);

        PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'Item adicionado ao portfólio!');
    }

    public function edit(PortfolioItem $portfolio)
    {
        $item = $portfolio;
        return view('admin.portfolio.form', compact('item'));
    }

    public function update(Request $request, PortfolioItem $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'date_label' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            if ($portfolio->image && !Str::startsWith($portfolio->image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $path = $request->file('image')->store('portfolio', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }
        unset($validated['image_url']);

        $portfolio->update($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'Item do portfólio atualizado!');
    }

    public function destroy(PortfolioItem $portfolio)
    {
        if ($portfolio->image && !Str::startsWith($portfolio->image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'Item excluído com sucesso!');
    }
}
