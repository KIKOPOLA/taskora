<aside id="dashboard-sidebar" class="w-72 bg-white border-r border-gray-200 p-6 hidden lg:flex flex-col fixed left-0 top-16 bottom-0 overflow-y-auto">
    <!-- Header -->
    <div class="mb-4 flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
            <i class="fas fa-briefcase text-blue-600 text-lg"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-600 uppercase tracking-widest">Navigation</p>
            <p class="text-xs text-gray-500">Taskora Platform</p>
        </div>
    </div>

    <!-- Links -->
    <nav class="space-y-2">
        @php
            $links = [];
            if (auth()->check() && auth()->user()->isAdmin()) {
                $links = [
                    ['route' => 'dashboard', 'icon' => 'fa-chart-line', 'label' => 'Dashboard'],
                    ['route' => 'users.index', 'icon' => 'fa-users-cog', 'label' => 'Users'],
                    ['route' => 'projects.index', 'icon' => 'fa-folder-open', 'label' => 'Projects'],
                    ['route' => 'tasks.index', 'icon' => 'fa-tasks', 'label' => 'Tasks'],
                ];
            } elseif (auth()->check() && auth()->user()->isPM()) {
                $links = [
                    ['route' => 'dashboard', 'icon' => 'fa-chart-line', 'label' => 'Dashboard'],
                    ['route' => 'projects.index', 'icon' => 'fa-folder-open', 'label' => 'Projects'],
                    ['route' => 'tasks.index', 'icon' => 'fa-tasks', 'label' => 'Tasks'],
                ];
            } else {
                $links = [
                    ['route' => 'dashboard', 'icon' => 'fa-chart-line', 'label' => 'Dashboard'],
                    ['route' => 'projects.index', 'icon' => 'fa-folder-open', 'label' => 'Projects'],
                    ['route' => 'tasks.index', 'icon' => 'fa-tasks', 'label' => 'My Tasks'],
                ];
            }
        @endphp

        @foreach($links as $link)
            <a href="{{ route($link['route']) }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600">
                    <i class="fas {{ $link['icon'] }}"></i>
                </div>
                <div class="text-sm font-semibold text-gray-800">{{ $link['label'] }}</div>
            </a>
        @endforeach
    </nav>

    <!-- Role Badge -->
    <div class="mt-6 p-3 rounded-lg bg-gray-50 border border-gray-100">
        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Your Role</p>
        <p class="text-sm font-semibold text-gray-800">
            @if(auth()->check() && auth()->user()->isAdmin())
                <i class="fas fa-crown text-yellow-500 mr-2"></i>Administrator
            @elseif(auth()->check() && auth()->user()->isPM())
                <i class="fas fa-chart-pie text-orange-500 mr-2"></i>Project Manager
            @else
                <i class="fas fa-user text-emerald-500 mr-2"></i>Team Member
            @endif
        </p>
    </div>
</aside>
