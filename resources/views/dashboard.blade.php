@extends('layouts.app')

@section('page-title', 'Corporate Dashboard')

@section('content')
    <div class="space-y-8 animate-fade-in">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black text-neutral-900 tracking-tight">Organization Overview</h2>
                <p class="text-neutral-500 mt-1 font-medium">Monitoring project performance and team synergy.</p>
            </div>
            <div class="flex items-center gap-3">
                <span
                    class="px-5 py-2.5 bg-white rounded-xl border border-neutral-200 shadow-soft text-xs font-bold text-neutral-600 flex items-center gap-2">
                    <i class="far fa-calendar-alt text-primary-500"></i>
                    {{ now()->format('D, M d, Y') }}
                </span>
            </div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($stats as $key => $value)
                <div class="card-hover">
                    <div class="flex items-start justify-between mb-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-primary-50 flex items-center justify-center text-primary-600 shadow-sm border border-primary-100">
                            @if($key === 'total_projects')
                                <i class="fas fa-project-diagram text-lg"></i>
                            @elseif($key === 'total_tasks')
                                <i class="fas fa-clipboard-list text-lg"></i>
                            @elseif($key === 'completed_tasks')
                                <i class="fas fa-check-double text-lg"></i>
                            @else
                                <i class="fas fa-users-cog text-lg"></i>
                            @endif
                        </div>
                        @if($key === 'total_projects' || $key === 'completed_tasks')
                            <span
                                class="flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg border border-emerald-100">
                                <i class="fas fa-arrow-up"></i> 12%
                            </span>
                        @endif
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-1">
                            {{ str_replace('_', ' ', $key) }}</p>
                        <h3 class="text-2xl font-black text-neutral-900 leading-none tracking-tight">{{ $value }}</h3>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Operations Area -->
            <div class="lg:col-span-2 space-y-8">
                <div class="card shadow-soft-lg">
                    <div class="card-header flex items-center justify-between">
                        <h3
                            class="text-lg font-bold text-neutral-900 flex items-center gap-2 underline decoration-primary-300 decoration-3 underline-offset-4">
                            <i class="fas fa-bolt text-primary-500"></i> Rapid Operations
                        </h3>
                        <span class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest">Workspace
                            Actions</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-6">
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('users.index') }}"
                                class="group p-6 rounded-2xl border-2 border-neutral-100 hover:border-primary-200 hover:bg-primary-50/40 transition-all flex items-center gap-5">
                                <div
                                    class="w-12 h-12 rounded-xl bg-primary-600 text-white flex items-center justify-center shadow-primary group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-neutral-900">Organization Roster</p>
                                    <p class="text-[11px] text-neutral-500 font-medium tracking-tight">Manage team access &
                                        roles</p>
                                </div>
                            </a>
                        @elseif(Auth::user()->isPM())
                            <a href="{{ route('projects.create') }}"
                                class="group p-6 rounded-2xl border-2 border-neutral-100 hover:border-primary-200 hover:bg-primary-50/40 transition-all flex items-center gap-5">
                                <div
                                    class="w-12 h-12 rounded-xl bg-primary-600 text-white flex items-center justify-center shadow-primary group-hover:scale-110 transition-transform">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-neutral-900">Initiate Workspace</p>
                                    <p class="text-[11px] text-neutral-500 font-medium tracking-tight">Deploy a new project</p>
                                </div>
                            </a>
                            <a href="{{ route('projects.index') }}"
                                class="group p-6 rounded-2xl border-2 border-neutral-100 hover:border-primary-200 hover:bg-primary-50/40 transition-all flex items-center gap-5">
                                <div
                                    class="w-12 h-12 rounded-xl bg-neutral-100 text-neutral-600 group-hover:bg-primary-100 group-hover:text-primary-700 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-neutral-900">Active Pipeline</p>
                                    <p class="text-[11px] text-neutral-500 font-medium tracking-tight">Oversee project
                                        trajectory</p>
                                </div>
                            </a>
                            <a href="{{ route('tasks.index') }}"
                                class="group p-6 rounded-2xl border-2 border-neutral-100 hover:border-primary-200 hover:bg-primary-50/40 transition-all flex items-center gap-5">
                                <div
                                    class="w-12 h-12 rounded-xl bg-neutral-100 text-neutral-600 group-hover:bg-emerald-100 group-hover:text-emerald-700 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-neutral-900">Task Console</p>
                                    <p class="text-[11px] text-neutral-500 font-medium tracking-tight">Global workflow
                                        management</p>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('projects.index') }}"
                                class="group p-6 rounded-2xl border-2 border-neutral-100 hover:border-primary-200 hover:bg-primary-50/40 transition-all flex items-center gap-5">
                                <div
                                    class="w-12 h-12 rounded-xl bg-primary-600 text-white flex items-center justify-center shadow-primary group-hover:scale-110 transition-transform">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-neutral-900">Assigned Units</p>
                                    <p class="text-[11px] text-neutral-500 font-medium tracking-tight">View your project
                                        assignments</p>
                                </div>
                            </a>
                            <a href="{{ route('tasks.index') }}"
                                class="group p-6 rounded-2xl border-2 border-neutral-100 hover:border-primary-200 hover:bg-primary-50/40 transition-all flex items-center gap-5">
                                <div
                                    class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-primary group-hover:scale-110 transition-transform">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-neutral-900">Personal Backlog</p>
                                    <p class="text-[11px] text-neutral-500 font-medium tracking-tight">Manage your individual
                                        tasks</p>
                                </div>
                            </a>
                        @endif

                        <a href="{{ route('profile.edit') }}"
                            class="group p-6 rounded-2xl border-2 border-neutral-100 hover:border-neutral-200 hover:bg-neutral-50 transition-all flex items-center gap-5">
                            <div
                                class="w-12 h-12 rounded-xl bg-neutral-200 text-neutral-600 group-hover:bg-neutral-800 group-hover:text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-neutral-900">Identity Panel</p>
                                <p class="text-[11px] text-neutral-500 font-medium tracking-tight">Personalize organization
                                    profile</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Profile Summary Card -->
                <div class="space-y-8">
                    <div class="card shadow-soft-lg border-2 border-primary-50/50">
                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-6 group">
                                <div
                                    class="absolute inset-0 bg-primary-100 rounded-[28px] rotate-6 group-hover:rotate-12 transition-transform opacity-70">
                                </div>
                                <div
                                    class="relative w-28 h-28 rounded-[28px] bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-5xl font-black shadow-primary-lg">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </div>
                            <h4 class="text-xl font-black text-neutral-900 tracking-tight">{{ Auth::user()->name }}</h4>
                            <p class="text-xs font-bold text-neutral-400 uppercase tracking-widest mt-1">
                                {{ Auth::user()->email }}</p>

                            <div class="w-full mt-8 grid grid-cols-2 gap-4">
                                <div class="p-5 rounded-2xl bg-neutral-50/80 border border-neutral-100 shadow-sm">
                                    <p
                                        class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-1.5 leading-none">
                                        Status</p>
                                    <span class="flex items-center justify-center gap-1.5 text-xs font-bold text-emerald-600">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse-soft"></span> Active
                                    </span>
                                </div>
                                <div class="p-5 rounded-2xl bg-neutral-50/80 border border-neutral-100 shadow-sm">
                                    <p
                                        class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-1.5 leading-none">
                                        Authority</p>
                                    <div
                                        class="flex items-center justify-center gap-1 text-xs font-bold text-primary-600 uppercase">
                                        @if(Auth::user()->isAdmin())
                                            Admin
                                        @elseif(Auth::user()->isPM())
                                            PM
                                        @else
                                            Member
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="w-full mt-6 py-3 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                                View Organization Card
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection