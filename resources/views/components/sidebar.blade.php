<aside id="app-sidebar"
    class="w-72 bg-white border-r border-neutral-200 flex flex-col fixed left-0 top-20 bottom-0 z-50 md:z-auto overflow-y-auto shadow-[4px_0_24px_-12px_rgba(0,0,0,0.1)] transition-transform duration-300 -translate-x-full md:translate-x-0">
    <!-- Sidebar Header with Logo (Optional, already in Navbar but good for mobile context) -->
    <div class="p-8 border-b border-neutral-100 bg-white">
        <div class="flex items-center gap-4 group">
            <div
                class="w-12 h-12 rounded-xl bg-primary-600 flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                <i class="fas fa-layer-group text-white text-lg"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-neutral-900 uppercase tracking-widest">Workspace</p>
                <p class="text-xs text-primary-600 font-bold">Main Dashboard</p>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="flex-1 py-8 px-5">
        @php
            $links = [];
            $userRole = auth()->user()->role ?? null;

            if (auth()->check() && auth()->user()->isAdmin()) {
                $links = [
                    ['route' => 'dashboard', 'icon' => 'fa-th-large', 'label' => 'Dashboard', 'desc' => 'General Overview'],
                    ['route' => 'users.index', 'icon' => 'fa-users-cog', 'label' => 'User Management', 'desc' => 'Manage Team Access'],
                ];
            } elseif (auth()->check() && auth()->user()->isPM()) {
                $links = [
                    ['route' => 'dashboard', 'icon' => 'fa-th-large', 'label' => 'Dashboard', 'desc' => 'General Overview'],
                    ['route' => 'projects.index', 'icon' => 'fa-project-diagram', 'label' => 'Projects', 'desc' => 'Active Workspaces'],
                    ['route' => 'tasks.index', 'icon' => 'fa-clipboard-list', 'label' => 'Tasks', 'desc' => 'Global Task List'],
                ];
            } else {
                $links = [
                    ['route' => 'dashboard', 'icon' => 'fa-th-large', 'label' => 'Dashboard', 'desc' => 'General Overview'],
                    ['route' => 'projects.index', 'icon' => 'fa-project-diagram', 'label' => 'My Projects', 'desc' => 'View Assigned Work'],
                    ['route' => 'tasks.index', 'icon' => 'fa-check-circle', 'label' => 'My Tasks', 'desc' => 'Task Management'],
                ];
            }
        @endphp

        <div class="space-y-3">
            @foreach($links as $link)
                @php
                    $isActive = request()->routeIs(str_replace('.index', '.*', $link['route']));
                @endphp
                <a href="{{ route($link['route']) }}" class="flex items-center gap-4 px-4 py-4 rounded-xl transition-all duration-300 group relative overflow-hidden
                                @if($isActive)
                                    bg-primary-50 text-primary-700 border border-primary-100
                                @else
                                    text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900
                                @endif">

                    <div class="relative w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 transition-all duration-300
                                @if($isActive)
                                    bg-primary-100 text-primary-600
                                @else
                                    bg-neutral-100 text-neutral-500 group-hover:bg-white group-hover:text-primary-600 group-hover:shadow-sm
                                @endif">
                        <i class="fas {{ $link['icon'] }} text-sm"></i>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold tracking-tight">
                            {{ $link['label'] }}
                        </p>
                        <p class="text-[10px] font-medium opacity-70 truncate">{{ $link['desc'] }}</p>
                    </div>

                    @if($isActive)
                        <div class="w-1.5 h-6 bg-primary-500 rounded-full"></div>
                    @endif
                </a>
            @endforeach
        </div>

        <!-- System Utilities Section -->
        <div class="mt-10 pt-8 border-t border-neutral-100">
            <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest mb-4 px-2">Account Services</p>
            <div class="space-y-2">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-neutral-600 hover:bg-neutral-50 hover:text-neutral-900 transition-all group border border-transparent">
                    <div
                        class="w-9 h-9 rounded-lg bg-neutral-100 group-hover:bg-white flex items-center justify-center text-neutral-500 group-hover:text-primary-600 transition-all shadow-sm">
                        <i class="fas fa-user-circle text-sm"></i>
                    </div>
                    <span class="text-sm font-bold tracking-tight">Organization Profile</span>
                </a>
            </div>
        </div>
    </nav>
</aside>