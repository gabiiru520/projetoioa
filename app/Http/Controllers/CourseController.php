<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('categoria');
        $search = $request->query('busca');

        $query = Course::where('is_active', true);

        if ($category && $category !== 'todos') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(9)
            ->withQueryString();

        $categories = Course::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('courses.index', compact('courses', 'categories', 'category', 'search'));
    }

    public function show(string $slug)
    {
        $course = Course::where('slug', $slug)
            ->where('is_active', true)
            ->with(['activeTurmas' => function ($q) {
                $q->orderBy('start_date', 'asc');
            }])
            ->firstOrFail();

        $relatedCourses = Course::where('is_active', true)
            ->where('id', '!=', $course->id)
            ->where('category', $course->category)
            ->take(3)
            ->get();

        if ($relatedCourses->count() < 3) {
            $moreCourses = Course::where('is_active', true)
                ->where('id', '!=', $course->id)
                ->whereNotIn('id', $relatedCourses->pluck('id'))
                ->take(3 - $relatedCourses->count())
                ->get();
            $relatedCourses = $relatedCourses->concat($moreCourses);
        }

        return view('courses.show', compact('course', 'relatedCourses'));
    }
}
