<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::with('course')
            ->orderBy('start_date', 'asc')
            ->paginate(15);

        return view('admin.turmas.index', compact('turmas'));
    }

    public function create()
    {
        $turma = new Turma();
        $courses = Course::orderBy('title')->get();
        return view('admin.turmas.form', compact('turma', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'schedule' => 'nullable|string|max:255',
            'modality' => 'required|string|max:50',
            'spots' => 'nullable|string|max:100',
            'status' => 'required|string|max:50',
            'whatsapp_message' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        Turma::create($validated);

        return redirect()->route('admin.turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    public function edit(Turma $turma)
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.turmas.form', compact('turma', 'courses'));
    }

    public function update(Request $request, Turma $turma)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'schedule' => 'nullable|string|max:255',
            'modality' => 'required|string|max:50',
            'spots' => 'nullable|string|max:100',
            'status' => 'required|string|max:50',
            'whatsapp_message' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        $turma->update($validated);

        return redirect()->route('admin.turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect()->route('admin.turmas.index')->with('success', 'Turma excluída com sucesso!');
    }
}
