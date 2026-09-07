<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $courseId = $request->query('curso');

        $query = Turma::with('course')
            ->whereHas('course', function ($q) {
                $q->where('is_active', true);
            });

        if ($status && $status !== 'todos') {
            $query->where('status', $status);
        }

        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        $turmas = $query->orderBy('start_date', 'asc')
            ->paginate(12)
            ->withQueryString();

        $courses = Course::where('is_active', true)->orderBy('title')->get();

        return view('turmas.index', compact('turmas', 'courses', 'status', 'courseId'));
    }
}
