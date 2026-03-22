<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks (filtered by project).
     */
    public function index(): View
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $tasks = Task::with('project', 'assignee', 'updates')->latest()->get();
        } elseif ($user->role === 'pm') {
            // PM melihat tasks dari projects yang mereka buat
            $tasks = Task::whereHas('project', function ($query) use ($user) {
                $query->where('created_by', $user->id);
            })
                ->with('project', 'assignee', 'updates')
                ->latest()
                ->get();
        } else {
            // Member melihat tasks yang di-assign ke mereka
            $tasks = Task::where('assigned_to', $user->id)
                ->with('project', 'assignee', 'updates')
                ->latest()
                ->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create(?Project $project = null): View|RedirectResponse
    {
        if ($project) {
            $this->authorize('view', $project);

            // Only get Members from project members, not the PM
            $members = $project->members()
                ->select('users.*')
                ->where('users.role', 'member')
                ->where('is_active', true)
                ->get();

            return view('tasks.create', compact('project', 'members'));
        } else {
            // When creating from tasks index without specific project
            $user = auth()->user();

            // Get projects the PM created
            $projects = Project::where('created_by', $user->id)
                ->get();

            if ($projects->isEmpty()) {
                return redirect()->route('tasks.index')
                    ->with('error', 'Buat project terlebih dahulu sebelum membuat task.');
            }

            // If only one project, redirect to that project's create form
            if ($projects->count() === 1) {
                return redirect()->route('tasks.create', $projects->first());
            }

            // If multiple projects, show project selector
            return view('tasks.create-select-project', compact('projects'));
        }
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(StoreTaskRequest $request, Project $project): RedirectResponse
    {
        $this->authorize('view', $project);

        $validated = $request->validated();

        $task = $project->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'assigned_to' => $validated['assigned_to'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'due_date' => $validated['due_date'] ?? null,
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Task berhasil dibuat dan di-assign.');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task): View
    {
        $this->authorize('view', $task);

        $updates = $task->updates()->with('updatedBy')->latest()->get();

        return view('tasks.show', compact('task', 'updates'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        $project = $task->project;
        // Only get members with role='member', not PM
        $members = $project->members()
            ->select('users.*')
            ->where('users.role', 'member')
            ->where('is_active', true)
            ->get();

        return view('tasks.edit', compact('task', 'project', 'members'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();

        $task->update($validated);

        return redirect()->route('projects.show', $task->project)
            ->with('success', 'Task berhasil diperbarui.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $project = $task->project;
        $taskTitle = $task->title;

        $task->delete();

        return redirect()->route('projects.show', $project)
            ->with('success', "Task '{$taskTitle}' berhasil dihapus.");
    }

    /**
     * Update task status (quick update).
     */
    public function updateStatus(Task $task, $status): RedirectResponse
    {
        $this->authorize('update', $task);

        if (! in_array($status, ['todo', 'in_progress', 'review', 'completed'])) {
            return back()->with('error', 'Status tidak valid.');
        }

        $task->update(['status' => $status]);

        return back()->with('success', 'Status task berhasil diperbarui.');
    }
}
