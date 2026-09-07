<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('categoria');

        $query = PortfolioItem::query();

        if ($category && $category !== 'todos') {
            $query->where('category', $category);
        }

        $items = $query->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(12)
            ->withQueryString();

        $categories = PortfolioItem::distinct()->pluck('category')->filter();

        return view('portfolio.index', compact('items', 'categories', 'category'));
    }
}
