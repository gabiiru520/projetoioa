<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        $member = new TeamMember();
        $courses = Course::where('is_active', true)->orderBy('title')->get();
        return view('admin.team.form', compact('member', 'courses'));
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'O nome do membro da equipe é obrigatório.',
            'role.required' => 'O cargo / especialidade é obrigatório.',
            'photo.file' => 'O arquivo de foto enviado não é válido.',
            'photo.mimes' => 'Formato de foto não suportado. Utilize JPG, PNG, WEBP, GIF, SVG, AVIF ou HEIC.',
            'photo.max' => 'A foto selecionada excede o tamanho máximo de 20 MB.',
            'photo.uploaded' => 'Falha no envio da foto. O arquivo pode ter excedido o limite de upload do servidor.',
            'photo_url.url' => 'A URL informada para a foto é inválida.',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'cro' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,svg,jfif,heic,heif,avif|max:20480',
            'photo_url' => 'nullable|url|max:500',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ], $messages);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('team', 'public');
            $validated['photo'] = $path;
        } elseif (!empty($validated['photo_url'])) {
            $validated['photo'] = $validated['photo_url'];
        }
        unset($validated['photo_url']);

        $member = TeamMember::create($validated);
        $member->courses()->sync($request->input('courses', []));

        return redirect()->route('admin.team.index')->with('success', 'Membro da equipe cadastrado com sucesso!');
    }

    public function edit(TeamMember $team)
    {
        $member = $team->load('courses');
        $courses = Course::where('is_active', true)->orderBy('title')->get();
        return view('admin.team.form', compact('member', 'courses'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $messages = [
            'name.required' => 'O nome do membro da equipe é obrigatório.',
            'role.required' => 'O cargo / especialidade é obrigatório.',
            'photo.file' => 'O arquivo de foto enviado não é válido.',
            'photo.mimes' => 'Formato de foto não suportado. Utilize JPG, PNG, WEBP, GIF, SVG, AVIF ou HEIC.',
            'photo.max' => 'A foto selecionada excede o tamanho máximo de 20 MB.',
            'photo.uploaded' => 'Falha no envio da foto. O arquivo pode ter excedido o limite de upload do servidor.',
            'photo_url.url' => 'A URL informada para a foto é inválida.',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'cro' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,svg,jfif,heic,heif,avif|max:20480',
            'photo_url' => 'nullable|url|max:500',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ], $messages);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if ($request->hasFile('photo')) {
            if ($team->photo && !Str::startsWith($team->photo, ['http://', 'https://', 'images/'])) {
                Storage::disk('public')->delete($team->photo);
            }
            $path = $request->file('photo')->store('team', 'public');
            $validated['photo'] = $path;
        } elseif (!empty($validated['photo_url'])) {
            $validated['photo'] = $validated['photo_url'];
        }
        unset($validated['photo_url']);

        $team->update($validated);
        $team->courses()->sync($request->input('courses', []));

        return redirect()->route('admin.team.index')->with('success', 'Membro da equipe atualizado!');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo && !Str::startsWith($team->photo, ['http://', 'https://', 'images/'])) {
            Storage::disk('public')->delete($team->photo);
        }
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Membro da equipe removido!');
    }
}
