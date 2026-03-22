@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <a href="{{ route('projects.show', $project) }}"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors duration-200 mb-4">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Return to Details</span>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Modify Venture</h1>
        <p class="text-slate-500 mt-1">Adjusting parameters for: <span
                class="font-bold text-slate-700">{{ $project->name }}</span></p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
        <div class="p-8 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Amendment Protocol</h2>
            <span
                class="text-[10px] font-bold px-2 py-0.5 bg-amber-50 text-amber-600 rounded-full border border-amber-100">EDIT
                MODE</span>
        </div>

        <form action="{{ route('projects.update', $project) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <!-- Project Name -->
                    <div>
                        <label for="name" class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                            Project Designation <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" required value="{{ old('name', $project->name) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900">
                        @error('name')
                            <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description"
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Detailed
                            Brief</label>
                        <textarea id="description" name="description" rows="5"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900 resize-none">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status"
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                            Execution Status <span class="text-rose-500">*</span>
                        </label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900 appearance-none cursor-pointer">
                            <option value="planning" @if($project->status == 'planning') selected @endif>Planning Phase
                            </option>
                            <option value="in_progress" @if($project->status == 'in_progress') selected @endif>In Operation
                            </option>
                            <option value="completed" @if($project->status == 'completed') selected @endif>Finalized</option>
                            <option value="on_hold" @if($project->status == 'on_hold') selected @endif>Suspended</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Dates Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_date"
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Commencement</label>
                            <input type="date" id="start_date" name="start_date"
                                value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900">
                        </div>

                        <div>
                            <label for="end_date"
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Maturity
                                Date</label>
                            <input type="date" id="end_date" name="end_date"
                                value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900">
                        </div>
                    </div>

                    <!-- Members Multi-select -->
                    <div>
                        <label for="members"
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Human
                            Resources Assignment</label>
                        <select id="members" name="members[]" multiple
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200 font-medium text-slate-900"
                            style="height: 245px;">
                            @foreach($availableMembers as $member)
                                <option value="{{ $member->id }}" @if(in_array($member->id, $currentMembers)) selected @endif
                                    class="py-1">
                                    {{ $member->name }} | {{ $member->role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 mt-12 pt-8 border-t border-slate-100">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-xl active:scale-95">
                    <i class="fas fa-save text-xs"></i>
                    <span>Synchronize Changes</span>
                </button>
            </div>
        </form>
    </div>
@endsection