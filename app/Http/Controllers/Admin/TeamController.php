<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.team.form', compact('member'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'cro' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
            'photo_url' => 'nullable|url|max:500',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('team', 'public');
            $validated['photo'] = $path;
        } elseif (!empty($validated['photo_url'])) {
            $validated['photo'] = $validated['photo_url'];
        }
        unset($validated['photo_url']);

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Membro da equipe cadastrado com sucesso!');
    }

    public function edit(TeamMember $team)
    {
        $member = $team;
        return view('admin.team.form', compact('member'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'cro' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:5120',
            'photo_url' => 'nullable|url|max:500',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        if ($request->hasFile('photo')) {
            if ($team->photo && !Str::startsWith($team->photo, ['http://', 'https://'])) {
                Storage::disk('public')->delete($team->photo);
            }
            $path = $request->file('photo')->store('team', 'public');
            $validated['photo'] = $path;
        } elseif (!empty($validated['photo_url'])) {
            $validated['photo'] = $validated['photo_url'];
        }
        unset($validated['photo_url']);

        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Membro da equipe atualizado!');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo && !Str::startsWith($team->photo, ['http://', 'https://'])) {
            Storage::disk('public')->delete($team->photo);
        }
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Membro da equipe removido!');
    }
}
