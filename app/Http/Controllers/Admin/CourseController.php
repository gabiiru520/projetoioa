<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('turmas')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $course = new Course();
        return view('admin.courses.form', compact('course'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses,slug',
            'category' => 'required|string|max:100',
            'modality' => 'required|string|max:50',
            'summary' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'duration_workload' => 'nullable|string|max:100',
            'schedule_info' => 'nullable|string|max:255',
            'target_audience' => 'nullable|string',
            'syllabus' => 'nullable|string',
            'investment' => 'nullable|string|max:255',
            'coordinator' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }
        unset($validated['image_url']);

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Curso cadastrado com sucesso!');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.form', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:courses,slug,' . $course->id,
            'category' => 'required|string|max:100',
            'modality' => 'required|string|max:50',
            'summary' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'duration_workload' => 'nullable|string|max:100',
            'schedule_info' => 'nullable|string|max:255',
            'target_audience' => 'nullable|string',
            'syllabus' => 'nullable|string',
            'investment' => 'nullable|string|max:255',
            'coordinator' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $validated['slug'] = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            if ($course->image && !Str::startsWith($course->image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($course->image);
            }
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }
        unset($validated['image_url']);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Course $course)
    {
        if ($course->image && !Str::startsWith($course->image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($course->image);
        }
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Curso removido com sucesso!');
    }
}
