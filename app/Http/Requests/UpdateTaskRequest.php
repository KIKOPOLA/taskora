<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->task);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $task = $this->route('task');
        $startDate = $task?->project->start_date?->format('Y-m-d') ?? 'today';
        $endDate = $task?->project->end_date?->format('Y-m-d') ?? '2099-12-31';

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
        $task = $this->route('task');
        $startDate = $task?->project->start_date?->format('d M Y') ?? 'project start date';
        $endDate = $task?->project->end_date?->format('d M Y') ?? 'project end date';

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
        $task = $this->route('task');
        if (! $task) {
            return [];
        }

        return $task->project->members()
            ->pluck('user_id')
            ->merge([$task->project->created_by])
            ->unique()
            ->values()
            ->toArray();
    }
}
