<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TaskUpdateController extends Controller
{
    public function show(Task $task): View
    {
        $this->authorize('view', $task);

        $updates = $task->updates()->get();

        return view('tasks.updates.show', compact('task', 'updates'));
    }

    public function store(Request $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'notes' => 'required|string',
            'status' => 'required|in:todo,in_progress,review,completed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,txt,zip,jpeg,png,jpg,gif|max:10240',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('task-updates', 'public');
        }

        $taskUpdate = $task->updates()->create([
            'updated_by' => auth()->id(),
            'notes' => $validated['notes'],
            'status' => $validated['status'],
            'image_path' => $imagePath,
        ]);

        // Handle multiple file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->store('task-updates/files', 'public');
                TaskFile::create([
                    'task_update_id' => $taskUpdate->id,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        $task->update(['status' => $validated['status']]);

        return back()->with('success', 'Update task berhasil disimpan dengan file.');
    }

    public function downloadFile(TaskFile $taskFile): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        if (! Storage::disk('public')->exists($taskFile->file_path)) {
            abort(404, 'File tidak ditemukan di storage.');
        }

        return Storage::disk('public')->download($taskFile->file_path, $taskFile->file_name);
    }
}
