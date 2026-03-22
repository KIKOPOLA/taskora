<!-- Mobile Menu Toggle Button -->
<button id="mobile-menu-toggle"
    class="md:hidden fixed top-4 left-4 z-[60] w-12 h-12 bg-white rounded-xl shadow-soft-lg flex items-center justify-center text-neutral-700 hover:bg-primary-50 hover:text-primary-600 transition-all border border-neutral-200">
    <i class="fas fa-bars text-lg"></i>
</button>

<!-- Enhanced Navbar with Corporate Styling -->
<nav class="bg-white/90 backdrop-blur-md border-b border-neutral-200/60 sticky top-0 z-50 shadow-soft">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20"> <!-- Increased height for a more premium feel -->
            <!-- Logo area -->
            <div class="flex items-center gap-10 md:ml-0 ml-16">
                <a href="{{ route('dashboard') }}" class="flex items-center group transition-all hover:scale-105">
                    <img src="{{ asset('images/Taskora Logo.png') }}" alt="Taskora Logo"
                        class="h-14 w-auto drop-shadow-sm">
                </a>

                <!-- Breadcrumb / Page Title -->
                <div class="hidden lg:flex items-center gap-4">
                    <div class="w-1.5 h-8 bg-primary-600 rounded-full shadow-sm">
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest leading-none mb-1">Current
                            Workspace</span>
                        <h1 class="text-base font-bold text-neutral-900 tracking-tight leading-none">
                            @yield('page-title', 'Dashboard Overview')
                        </h1>
                    </div>
                </div>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-6">
                <!-- Notifications -->
                <div class="relative">
                    <button id="notification-btn"
                        class="hidden sm:flex items-center justify-center w-11 h-11 rounded-xl bg-white hover:bg-neutral-50 text-neutral-600 hover:text-primary-600 transition-all relative group border border-neutral-200 shadow-sm">
                        <i class="fas fa-bell text-sm"></i>
                        @if(Auth::user()->unreadNotifications->count() > 0)
                            <span
                                class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full border border-white animate-pulse"></span>
                        @endif
                    </button>

                    <!-- Dropdown -->
                    <div id="notification-dropdown"
                        class="absolute right-0 mt-4 w-80 bg-white rounded-2xl shadow-soft-lg border border-neutral-100 hidden z-50 overflow-hidden">
                        <div class="p-4 border-b border-neutral-100 flex justify-between items-center bg-neutral-50/50">
                            <h3 class="text-sm font-bold text-neutral-900">Notifications</h3>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span
                                    class="text-[10px] font-bold bg-primary-100 text-primary-600 px-2 py-0.5 rounded-full">{{ Auth::user()->unreadNotifications->count() }}
                                    new</span>
                            @endif
                        </div>
                        <div class="max-h-80 overflow-y-auto">
                            @forelse(Auth::user()->unreadNotifications as $notification)
                                <a href="{{ route('notifications.read', ['id' => $notification->id, 'redirect_to' => $notification->data['action_url'] ?? '#']) }}"
                                    class="block p-4 hover:bg-neutral-50 transition-colors border-b last:border-0 border-neutral-50 relative group">
                                    <div class="flex gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user-plus text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-neutral-600 font-medium leading-relaxed">
                                                {{ $notification->data['message'] ?? 'New notification' }}
                                            </p>
                                            <p class="text-[10px] text-neutral-400 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @if(isset($notification->data['action_url']))
                                        <div
                                            class="absolute right-2 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <i class="fas fa-chevron-right text-xs text-neutral-300"></i>
                                        </div>
                                    @endif
                                </a>
                            @empty
                                <div class="p-8 text-center text-neutral-500">
                                    <i class="fas fa-bell-slash text-2xl mb-2 text-neutral-300"></i>
                                    <p class="text-xs">No new notifications</p>
                                </div>
                            @endforelse
                        </div>
                        @if(Auth::user()->unreadNotifications->count() > 0)
                            <div class="p-2 border-t border-neutral-100 bg-neutral-50/30 text-center">
                                <a href="{{ route('notifications.readAll') }}"
                                    class="text-xs font-bold text-primary-600 hover:text-primary-700">Mark all as read</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Current User Info -->
                <div
                    class="hidden md:flex items-center gap-4 px-5 py-2.5 bg-white rounded-2xl border border-neutral-200 shadow-sm">
                    <div
                        class="w-11 h-11 rounded-xl bg-primary-600 flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                        <i class="fas fa-user-tie text-white text-sm"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-bold text-neutral-900 leading-none mb-1">{{ Auth::user()->name }}</p>
                        <div class="flex items-center gap-1.5">
                            @if(Auth::user()->isAdmin())
                                <span
                                    class="text-[10px] font-bold text-amber-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="fas fa-shield-alt"></i> Administrator
                                </span>
                            @elseif(Auth::user()->isPM())
                                <span
                                    class="text-[10px] font-bold text-primary-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="fas fa-briefcase"></i> Project Manager
                                </span>
                            @else
                                <span
                                    class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider flex items-center gap-1">
                                    <i class="fas fa-user"></i> Team Member
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Vertical Divider -->
                <div class="hidden sm:block w-px h-10 bg-neutral-200"></div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2.5 text-neutral-600 hover:text-neutral-900 bg-neutral-100 hover:bg-neutral-200 rounded-xl transition-all text-sm font-bold shadow-sm active:scale-95 group"
                        title="Sign Out">
                        <i class="fas fa-power-off group-hover:text-neutral-800 transition-colors"></i>
                        <span class="hidden lg:inline">Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar Overlay -->
<div id="mobile-sidebar-overlay"
    class="md:hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('mobile-menu-toggle');
        const overlay = document.getElementById('mobile-sidebar-overlay');
        const sidebar = document.getElementById('app-sidebar');

        // Notification Dropdown Logic
        const notifBtn = document.getElementById('notification-btn');
        const notifDropdown = document.getElementById('notification-dropdown');

        if (notifBtn && notifDropdown) {
            notifBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                notifDropdown.classList.toggle('hidden');
            });

            // Close when clicking outside
            document.addEventListener('click', function (e) {
                if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                    notifDropdown.classList.add('hidden');
                }
            });
        }

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', function () {
                const isOpen = sidebar.classList.contains('translate-x-0');

                if (isOpen) {
                    // Close
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                    setTimeout(() => overlay.classList.remove('opacity-100'), 10);
                    toggleBtn.innerHTML = '<i class="fas fa-bars text-lg"></i>';
                } else {
                    // Open
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.add('opacity-100'), 10);
                    toggleBtn.innerHTML = '<i class="fas fa-times text-lg"></i>';
                }
            });

            // Close on overlay click
            overlay.addEventListener('click', function () {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                overlay.classList.remove('opacity-100');
                toggleBtn.innerHTML = '<i class="fas fa-bars text-lg"></i>';
            });
        }
    });
</script>