@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <a href="{{ route('users.index') }}"
            class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 font-semibold text-sm transition-colors duration-200 mb-4">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Return to Personnel Directory</span>
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Access Control Amendment</h1>
        <p class="text-slate-500 mt-1">Modifying privileges for: <span
                class="font-bold text-slate-700">{{ $user->name }}</span></p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden max-w-2xl">
        <div class="p-8 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Authority Revision Protocol</h2>
            <span
                class="text-[10px] font-bold px-2 py-0.5 bg-blue-50 text-blue-600 rounded-full border border-blue-100">REV-{{ strtoupper(substr($user->name, 0, 3)) }}</span>
        </div>

        <form action="{{ route('users.update', $user) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Full Legal
                            Name</label>
                        <p class="text-sm font-bold text-slate-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Certified
                            Email</label>
                        <p class="text-sm font-bold text-slate-900">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Role Selection -->
                <div>
                    <label for="role" class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                        Designated Security Role <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="role" name="role" required
                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 font-medium text-slate-900 appearance-none cursor-pointer">
                            <option value="">-- Select Authority Level --</option>
                            <option value="default" @if($user->role == 'default') selected @endif>Default (Restricted)
                            </option>
                            <option value="admin" @if($user->role == 'admin') selected @endif>Administrator (Full Control)
                            </option>
                            <option value="pm" @if($user->role == 'pm') selected @endif>Project Manager (Operational)</option>
                            <option value="member" @if($user->role == 'member') selected @endif>Member (Standard)</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    @error('role')
                        <p class="text-rose-600 text-[10px] font-bold mt-1 uppercase tracking-tighter">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Connectivity Status -->
                <div
                    class="p-4 bg-white border border-slate-200 rounded-xl flex items-center justify-between group hover:border-blue-200 transition-all">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-500 transition-all">
                            <i class="fas fa-signal-trail text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900">System Connectivity</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Enable/Disable user authentication</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="is_active" name="is_active" value="1" @if($user->is_active) checked
                        @endif class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 mt-12 pt-8 border-t border-slate-100">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-xl active:scale-95">
                    <i class="fas fa-save text-xs"></i>
                    <span>Synchronize Authority Changes</span>
                </button>
            </div>
        </form>
    </div>
@endsection