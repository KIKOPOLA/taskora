@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800 mb-2">
        <i class="fas fa-tasks text-blue-600 mr-2"></i>{{ $task->title }}
    </h1>
    <p class="text-slate-600">{{ $task->project->name }}</p>
</div>

<!-- Task Details Card -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Column -->
        <div>
            <!-- Status -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Status</label>
                <span class="px-3 py-1.5 rounded-full text-sm font-semibold
                    @if($task->status === 'completed') bg-green-100 text-green-800
                    @elseif($task->status === 'in_progress') bg-blue-100 text-blue-800
                    @elseif($task->status === 'to_do') bg-slate-100 text-slate-800
                    @elseif($task->status === 'review') bg-yellow-100 text-yellow-800
                    @endif">
                    {{ str_replace('_', ' ', ucfirst($task->status)) }}
                </span>
            </div>
            
            <!-- Priority -->
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Priority</label>
                <span class="px-3 py-1.5 rounded-full text-sm font-semibold
                    @if($task->priority === 'urgent') bg-red-100 text-red-800
                    @elseif($task->priority === 'high') bg-orange-100 text-orange-800
                    @elseif($task->priority === 'medium') bg-blue-100 text-blue-800
                    @else bg-green-100 text-green-800
                    @endif">
                    {{ ucfirst($task->priority) }}
                </span>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Assigned To -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Assigned To</label>
                <p class="text-lg font-semibold text-slate-800">{{ $task->assignee?->name ?? 'Unassigned' }}</p>
            </div>
            
            <!-- Due Date -->
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-2">Due Date</label>
                <p class="text-lg font-semibold text-slate-800">{{ $task->due_date?->format('d M Y') ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="mt-8 pt-8 border-t border-slate-200">
        <label class="block text-xs font-bold text-slate-600 uppercase tracking-widest mb-3">Description</label>
        <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">
            {{ $task->description ?? 'No description provided' }}
        </p>
    </div>
</div>

<!-- Add Update Form -->
@if(Auth::user()->isMember() && $task->assigned_to == Auth::id())
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
        <i class="fas fa-plus-circle text-blue-600"></i>Add Update
    </h2>
    
    <form action="{{ route('task-updates.store', $task) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Notes -->
        <div class="mb-6">
            <label for="notes" class="block text-sm font-semibold text-slate-700 mb-2">
                Notes / Comments <span class="text-red-500">*</span>
            </label>
            <textarea id="notes" name="notes" rows="5" required 
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-vertical"
                placeholder="Describe your progress...">{{ old('notes') }}</textarea>
            @error('notes')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-6">
            <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Update Status</label>
            <select id="status" name="status" required
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                <option value="to_do" @if(old('status') == 'to_do') selected @endif>To Do</option>
                <option value="in_progress" @if(old('status', 'in_progress') == 'in_progress') selected @endif>In Progress</option>
                <option value="review" @if(old('status') == 'review') selected @endif>Review</option>
                <option value="completed" @if(old('status') == 'completed') selected @endif>Completed</option>
            </select>
            @error('status')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Photo/Screenshot -->
        <div class="mb-6">
            <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Upload Photo/Screenshot</label>
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            <small class="text-slate-600 text-xs mt-1 block">Max 2MB. Supported: JPG, PNG, GIF</small>
            @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Files -->
        <div class="mb-8">
            <label for="files" class="block text-sm font-semibold text-slate-700 mb-2">Upload Files</label>
            <input type="file" id="files" name="files[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,.zip,.jpeg,.png,.jpg,.gif"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            <small class="text-slate-600 text-xs mt-1 block">Max 10MB each. Supported: PDF, DOC, DOCX, XLS, XLSX, TXT, ZIP, Images</small>
            @error('files.*')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg">
            <i class="fas fa-paper-plane"></i>Submit Update
        </button>
    </form>
</div>
@endif

<!-- Updates List Section -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Header -->
    <div class="p-8 border-b border-slate-200">
        <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-history text-blue-600"></i>Updates ({{ $updates->count() }})
        </h2>
    </div>

    <!-- Updates Content -->
    <div class="p-8">
        @if($updates->isEmpty())
            <div class="text-center py-12">
                <i class="fas fa-inbox text-4xl text-slate-300 mb-3 block"></i>
                <p class="text-slate-600 text-lg">No updates yet</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($updates as $update)
                    <div class="p-6 bg-slate-50 border-l-4 border-blue-600 rounded-lg">
                        <!-- Update Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="font-semibold text-slate-800">{{ $update->updatedBy->name }}</p>
                                <small class="text-slate-600 flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    {{ $update->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                                @if($update->status === 'completed') bg-green-100 text-green-800
                                @elseif($update->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($update->status === 'to_do') bg-slate-100 text-slate-800
                                @elseif($update->status === 'review') bg-yellow-100 text-yellow-800
                                @endif">
                                {{ str_replace('_', ' ', ucfirst($update->status)) }}
                            </span>
                        </div>

                        <!-- Notes -->
                        <p class="text-slate-700 leading-relaxed whitespace-pre-wrap mb-4">
                            {{ $update->notes }}
                        </p>

                        <!-- Image -->
                        @if($update->image_path)
                            <a href="{{ asset('storage/' . $update->image_path) }}" target="_blank" class="inline-block mb-4">
                                <img src="{{ asset('storage/' . $update->image_path) }}" alt="Update" class="max-w-sm rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                            </a>
                        @endif

                        <!-- Files -->
                        @if($update->files->count() > 0)
                            <div class="mt-4 pt-4 border-t border-slate-200">
                                <div class="font-semibold text-slate-800 mb-3 text-sm flex items-center gap-2">
                                    <i class="fas fa-file-download text-blue-600"></i>
                                    Files ({{ $update->files->count() }})
                                </div>
                                <div class="space-y-2">
                                    @foreach($update->files as $file)
                                        <a href="{{ route('task-files.download', $file) }}" class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors duration-200 text-slate-700">
                                            <i class="fas fa-file text-blue-600 text-lg"></i>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-medium truncate">{{ $file->file_name }}</div>
                                                <small class="text-slate-600 text-xs">{{ $file->getFileSizeFormatted() }}</small>
                                            </div>
                                            <i class="fas fa-download text-slate-400 text-sm"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Back Button -->
<a href="{{ route('projects.show', $task->project) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold transition-colors duration-200 mt-8">
    <i class="fas fa-arrow-left"></i> Back to Project
</a>
@endsection
    </div>
@endsection
