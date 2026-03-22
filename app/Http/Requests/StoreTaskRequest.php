<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $project = $this->route('project');
        $startDate = $project?->start_date?->format('Y-m-d') ?? 'today';
        $endDate = $project?->end_date?->format('Y-m-d') ?? '2099-12-31';

        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'assigned_to' => 'required|exists:users,id|in:'.implode(',', $this->getProjectMembers()),
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:todo,in_progress,review,completed',
            'due_date' => "nullable|date|date_format:Y-m-d|after_or_equal:{$startDate}|before_or_equal:{$endDate}",
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        $project = $this->route('project');
        $startDate = $project?->start_date?->format('d M Y') ?? 'project start date';
        $endDate = $project?->end_date?->format('d M Y') ?? 'project end date';

        return [
            'title.required' => 'Judul task harus diisi.',
            'assigned_to.required' => 'Task harus di-assign ke member.',
            'assigned_to.in' => 'User yang dipilih harus menjadi member project.',
            'priority.required' => 'Priority task harus dipilih.',
            'status.required' => 'Status task harus dipilih.',
            'due_date.after_or_equal' => "Due date harus pada atau setelah {$startDate}",
            'due_date.before_or_equal' => "Due date harus pada atau sebelum {$endDate}",
        ];
    }

    /**
     * Get project members for validation.
     */
    private function getProjectMembers(): array
    {
        $project = $this->route('project');
        if (! $project) {
            return [];
        }

        // Only get members with 'member' role
        return $project->members()
            ->select('users.id')
            ->where('users.role', 'member')
            ->pluck('id')
            ->unique()
            ->values()
            ->toArray();
    }
}
