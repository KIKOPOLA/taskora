@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Assignments</h1>
            <p class="text-slate-500 font-medium">Review and manage your organizational deliverables.</p>
        </div>
        @if(Auth::user()->isPM())
            <a href="{{ route('tasks.create-standalone') }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                <i class="fas fa-plus text-xs"></i>
                <span>Create Task</span>
            </a>
        @endif
    </div>

    <!-- Tasks Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-12">
        @if($tasks->isEmpty())
            <div class="text-center py-24">
                <div class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-tasks text-3xl text-blue-200"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900">No Tasks Assigned</h3>
                <p class="text-slate-500 font-medium max-w-sm mx-auto mt-2">Your operational queue is currently empty.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-blue-50/30">
                            <th
                                class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                Task Descriptor</th>
                            <th
                                class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                Parent Project</th>
                            <th
                                class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                Assignee</th>
                            <th
                                class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                Operational Status</th>
                            <th
                                class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                Priority</th>
                            <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] text-right">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 italic-none">
                        @foreach($tasks as $task)
                            <tr class="hover:bg-blue-50/20 transition-colors">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-slate-900">{{ $task->title }}</p>
                                    @if($task->due_date)
                                        <p class="text-[10px] font-bold text-blue-500 mt-1.5 uppercase tracking-widest">
                                            Due {{ $task->due_date->format('M d, Y') }}
                                        </p>
                                    @endif
                                </td>
                                <td class="px-6 py-6">
                                    <a href="{{ route('projects.show', $task->project) }}"
                                        class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors">{{ $task->project->name }}</a>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-lg bg-slate-100 flex items-center justify-center text-[9px] font-bold text-slate-500">
                                            {{ strtoupper(substr($task->assignee?->name ?? '?', 0, 1)) }}
                                        </div>
                                        <span class="text-xs font-bold text-slate-700">{{ $task->assignee?->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span
                                        class="inline-flex items-center gap-2 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest bg-slate-50 text-slate-600">
                                        <div class="w-1.5 h-1.5 rounded-full 
                                                        @if($task->status === 'completed') bg-emerald-400
                                                        @elseif($task->status === 'in_progress') bg-blue-400
                                                        @else bg-slate-400
                                                        @endif"></div>
                                        {{ str_replace('_', ' ', $task->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="text-[10px] font-bold uppercase px-3 py-1 rounded-lg
                                                            @if($task->priority == 'urgent') bg-rose-50 text-rose-700
                                                            @elseif($task->priority == 'high') bg-orange-50 text-orange-700
                                                            @elseif($task->priority == 'medium') bg-amber-50 text-amber-700
                                                            @else bg-emerald-50 text-emerald-700
                                                            @endif">
                                        {{ $task->priority }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('tasks.show', $task) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-50 text-slate-400 hover:bg-blue-600 hover:text-white transition-all">
                                        <i class="fas fa-external-link text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Upcoming Focus -->
    @php
        $upcomingTasks = $tasks->filter(function ($task) {
            return $task->due_date && $task->due_date->isFuture() && $task->status !== 'completed';
        })->sortBy('due_date')->take(6);
    @endphp

    @if($upcomingTasks->count() > 0)
        <div class="mb-12">
            <h2 class="text-xs font-bold text-blue-600 uppercase tracking-[0.2em] mb-8">Strategic Priorities</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($upcomingTasks as $task)
                    <div
                        class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm transition-all hover:shadow-lg hover:-translate-y-1 group relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-blue-50 -mr-12 -mt-12 rounded-full blur-2xl group-hover:bg-blue-100 transition-colors">
                        </div>

                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="text-[10px] font-bold text-blue-500 uppercase tracking-widest truncate">{{ $task->project->name }}</span>
                                @if($task->priority == 'urgent')
                                    <div class="inline-flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                        <span class="text-[8px] font-bold text-rose-500 uppercase">Urgent</span>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('tasks.show', $task) }}"
                                class="block text-lg font-extrabold text-slate-900 hover:text-blue-600 transition-colors mb-6 line-clamp-1">
                                {{ $task->title }}
                            </a>

                            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                <div>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Target Date</p>
                                    <p class="text-sm font-bold text-slate-800 mt-1">{{ $task->due_date->format('M d, Y') }}</p>
                                </div>
                                <span
                                    class="px-2 py-1 rounded-md bg-amber-50 text-[9px] font-bold text-amber-600 uppercase">{{ $task->due_date->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection