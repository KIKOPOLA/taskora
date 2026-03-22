@extends('layouts.app')

@section('content')
    <!-- Page Link -->
    <div class="mb-6">
        <a href="{{ route('projects.index') }}"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors duration-200">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to Projects List</span>
        </a>
    </div>

    <!-- Main Header Card -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider
                        @if($project->status === 'completed') bg-emerald-50 text-emerald-700
                        @elseif($project->status === 'in_progress') bg-blue-50 text-blue-700
                        @elseif($project->status === 'on_hold') bg-red-50 text-red-700
                        @else bg-slate-100 text-slate-600
                        @endif">
                        {{ str_replace('_', ' ', $project->status) }}
                    </span>
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">#{{ $project->id }}</span>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $project->name }}</h1>
                <p class="text-slate-600 mt-4 text-sm leading-relaxed max-w-4xl">
                    {{ $project->description ?? 'No description.' }}</p>
            </div>

            <div class="flex flex-col gap-3 min-w-[200px]">
                @if(Auth::user()->isPM() && $project->created_by == Auth::id())
                    <a href="{{ route('projects.edit', $project) }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm">
                        <i class="fas fa-edit text-xs"></i>
                        <span>Edit Project</span>
                    </a>
                @endif
                <div class="p-4 bg-slate-50 rounded-lg border border-slate-100 space-y-2">
                    <div
                        class="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-slate-400">
                        <span>Started</span>
                        <span
                            class="text-slate-700">{{ $project->start_date ? $project->start_date->format('M d, Y') : '-' }}</span>
                    </div>
                    <div
                        class="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-slate-400">
                        <span>Deadline</span>
                        <span
                            class="text-slate-700">{{ $project->end_date ? $project->end_date->format('M d, Y') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Project Manager Info -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Project Lead</h3>
            <div class="flex items-center gap-3">
                <div
                    class="w-10 min-w-[40px] h-10 rounded bg-slate-900 flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr($project->creator->name, 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-900 truncate">{{ $project->creator->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ $project->creator->email }}</p>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Project Team
                ({{ $members->count() }})</h3>
            <div class="flex -space-x-2">
                @forelse($members->take(8) as $member)
                    <div class="w-8 h-8 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-slate-600 shadow-sm"
                        title="{{ $member->name }}">
                        {{ strtoupper(substr($member->name, 0, 1)) }}
                    </div>
                @empty
                    <p class="text-slate-400 text-xs italic">No members assigned.</p>
                @endforelse
                @if($members->count() > 8)
                    <div
                        class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-[10px] font-bold text-slate-500 shadow-sm">
                        +{{ $members->count() - 8 }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Task Breakdown -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Task Status</h3>
            <div class="flex items-center gap-2">
                <div class="flex-1 bg-emerald-50 p-2 rounded text-center">
                    <span
                        class="block text-sm font-bold text-emerald-700">{{ $tasks->where('status', 'completed')->count() }}</span>
                    <span class="text-[9px] font-bold text-emerald-600 uppercase">Done</span>
                </div>
                <div class="flex-1 bg-blue-50 p-2 rounded text-center">
                    <span
                        class="block text-sm font-bold text-blue-700">{{ $tasks->where('status', 'in_progress')->count() }}</span>
                    <span class="text-[9px] font-bold text-blue-600 uppercase">Active</span>
                </div>
                <div class="flex-1 bg-slate-50 p-2 rounded text-center">
                    <span
                        class="block text-sm font-bold text-slate-700">{{ $tasks->where('status', 'to_do')->count() }}</span>
                    <span class="text-[9px] font-bold text-slate-600 uppercase">Pending</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-widest">Tasks List</h2>
            @if(Auth::user()->isPM() && $project->created_by == Auth::id())
                <a href="{{ route('tasks.create', $project) }}"
                    class="inline-flex items-center gap-2 text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors">
                    <i class="fas fa-plus"></i> New Task
                </a>
            @endif
        </div>

        @if($tasks->isEmpty())
            <div class="p-12 text-center text-slate-400">
                <p class="text-sm">No tasks assigned to this project yet.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Title</th>
                            <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Assignee</th>
                            <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Priority</th>
                            <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($tasks as $task)
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="px-8 py-4">
                                    <p class="text-sm font-bold text-slate-900">{{ $task->title }}</p>
                                    @if($task->due_date)
                                        <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Due
                                            {{ $task->due_date->format('M d, Y') }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-bold text-slate-600">{{ $task->assignee?->name ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded border
                                                @if($task->priority == 'urgent') bg-red-50 text-red-700 border-red-100
                                                @elseif($task->priority == 'high') bg-orange-50 text-orange-700 border-orange-100
                                                @elseif($task->priority == 'medium') bg-amber-50 text-amber-700 border-amber-100
                                                @else bg-emerald-50 text-emerald-700 border-emerald-100
                                                @endif">
                                        {{ $task->priority }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-[10px] font-bold uppercase text-slate-600">{{ str_replace('_', ' ', $task->status) }}</span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="text-slate-400 hover:text-blue-600 transition-colors" title="View details">
                                            <i class="fas fa-external-link text-sm"></i>
                                        </a>
                                        @if(Auth::user()->isPM() && $project->created_by == Auth::id())
                                            <a href="{{ route('tasks.edit', $task) }}"
                                                class="text-slate-400 hover:text-slate-900 transition-colors"><i
                                                    class="fas fa-edit text-sm"></i></a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                onsubmit="return confirm('Archive this task?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors"><i
                                                        class="fas fa-trash text-sm"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection