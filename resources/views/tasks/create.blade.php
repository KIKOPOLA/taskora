@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <a href="{{ route('projects.show', $project) }}"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors mb-4">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to {{ $project->name }}</span>
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create New Task</h1>
        <p class="text-slate-500 text-sm">Create a new task for project <span
                class="font-bold text-slate-700">{{ $project->name }}</span></p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
        <form action="{{ route('tasks.store', $project) }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <!-- Task Title -->
                    <div>
                        <label for="title"
                            class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Task Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" required value="{{ old('title') }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900"
                            placeholder="e.g. Implement Login API">
                        @error('title')
                            <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description"
                            class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Description</label>
                        <textarea id="description" name="description" rows="5"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 resize-none"
                            placeholder="Provide details about the task requirements...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Personnel & Priority Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="assigned_to"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Assignee <span
                                    class="text-red-500">*</span></label>
                            <select id="assigned_to" name="assigned_to" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 cursor-pointer">
                                <option value="">-- Select Member --</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" @if(old('assigned_to') == $member->id) selected @endif>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="priority"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Priority <span
                                    class="text-red-500">*</span></label>
                            <select id="priority" name="priority" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 cursor-pointer">
                                <option value="low" @if(old('priority') == 'low') selected @endif>Low</option>
                                <option value="medium" @if(old('priority') == 'medium' || !old('priority')) selected @endif>
                                    Medium</option>
                                <option value="high" @if(old('priority') == 'high') selected @endif>High</option>
                                <option value="urgent" @if(old('priority') == 'urgent') selected @endif>Urgent</option>
                            </select>
                            @error('priority')
                                <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status & Due Date Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="status"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Status <span
                                    class="text-red-500">*</span></label>
                            <select id="status" name="status" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900 cursor-pointer">
                                <option value="to_do" @if(old('status') == 'to_do') selected @endif></option>
                                <option value="in_progress" @if(old('status') == 'in_progress') selected @endif>In Progress
                                </option>
                                <option value="review" @if(old('status') == 'review') selected @endif>Review</option>
                                <option value="completed" @if(old('status') == 'completed') selected @endif>Completed</option>
                            </select>
                            @error('status')
                                <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date"
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Due
                                Date</label>
                            <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
                                min="{{ $project->start_date->format('Y-m-d') }}"
                                max="{{ $project->end_date->format('Y-m-d') }}"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-sm font-medium text-slate-900">
                            @error('due_date')
                                <p class="text-red-600 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 mt-12 pt-8 border-t border-slate-100">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg font-bold text-sm transition-all shadow-sm">
                    <span>Create Task</span>
                </button>
            </div>
        </form>
    </div>
@endsection