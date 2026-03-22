<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(): View
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $projects = Project::with('creator', 'members')->get();
        } elseif ($user->role === 'pm') {
            // PM melihat projects yang mereka buat + projects yang mereka join
            $projects = Project::where('created_by', $user->id)
                ->orWhereHas('members', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->with('creator', 'members')
                ->get();
        } else {
            // Member melihat projects yang mereka join (via project_members)
            $projects = $user->projectMembers()->with('creator', 'members')->get();
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        $this->authorize('create', Project::class);

        $availableMembers = User::where('role', 'member')
            ->where('is_active', true)
            ->get();

        return view('projects.create', compact('availableMembers'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'created_by' => auth()->id(),
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'status' => $validated['status'] ?? 'planning',
        ]);

        // Add creator as member
        $memberIds = [auth()->id()];

        // Attach additional members if provided
        if (! empty($request->members)) {
            $memberIds = array_merge($memberIds, $request->members);
        }

        $project->members()->attach(array_unique($memberIds));

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project berhasil dibuat.');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project): View
    {
        $this->authorize('view', $project);

        $tasks = $project->tasks()
            ->with('assignee', 'updates')
            ->latest()
            ->get();

        $members = $project->members()
            ->select('users.*')
            ->where('users.role', 'member')
            ->get();

        $availableMembers = User::where('role', 'member')
            ->where('is_active', true)
            ->whereNotIn('id', $project->members->pluck('id'))
            ->get();

        return view('projects.show', compact('project', 'tasks', 'members', 'availableMembers'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        $this->authorize('update', $project);

        $currentMembers = $project->members()->select('users.id')->pluck('id')->toArray();
        $availableMembers = User::where('role', 'member')
            ->where('is_active', true)
            ->get();

        return view('projects.edit', compact('project', 'availableMembers', 'currentMembers'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();

        $project->update($validated);

        // Update members - always keep creator as member
        if ($request->has('members')) {
            $memberIds = array_unique(
                array_merge($request->members ?? [], [$project->created_by])
            );
            $project->members()->sync($memberIds);
        }

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project berhasil diperbarui.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->authorize('delete', $project);

        $projectName = $project->name;
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', "Project '{$projectName}' berhasil dihapus.");
    }
}
