<header class="sticky top-0 z-10 bg-white border-b border-gray-200">
    <div class="flex items-center gap-4 px-4 py-3 md:px-6">

        {{-- Hamburger (mobile only) --}}
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100"
            aria-label="Toggle navigation menu"
        >
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Page title / breadcrumb slot --}}
        <div class="flex-1 min-w-0">
            <h1 class="text-base font-semibold text-gray-900 truncate">@yield('page-title', 'Dashboard')</h1>
        </div>

        {{-- Notification dropdown --}}
        <div
            class="relative"
            x-data="{
                open: false,
                unread: 3,
                notifications: [
                    { id: 1, message: 'Payroll period May 1–15 finalized.', time: '2 hours ago', read: false },
                    { id: 2, message: 'Attendance adjustment for EMP-0003 approved.', time: '5 hours ago', read: false },
                    { id: 3, message: 'New employee EMP-0006 added.', time: 'Yesterday', read: false }
                ],
                markAllRead() { this.notifications.forEach(n => n.read = true); this.unread = 0; }
            }"
            @click.outside="open = false"
        >
            <button
                @click="open = !open; if(open) markAllRead()"
                class="relative p-2 rounded-lg text-gray-500 hover:bg-gray-100"
                aria-label="View notifications"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span
                    x-show="unread > 0"
                    x-text="unread"
                    class="absolute -top-0.5 -right-0.5 flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full"
                ></span>
            </button>

            <div
                x-show="open"
                x-transition
                class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden"
                style="display: none;"
            >
                <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-900">Notifications</span>
                    <button @click="markAllRead()" class="text-sm text-teal-900 hover:underline">Mark all read</button>
                </div>
                <div class="divide-y divide-gray-100 max-h-64 overflow-y-auto">
                    <template x-for="n in notifications" :key="n.id">
                        <div class="px-4 py-3 hover:bg-gray-50">
                            <p class="text-sm text-gray-700" x-text="n.message"></p>
                            <p class="text-sm text-gray-600 mt-1" x-text="n.time"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- User dropdown --}}
        <div
            class="relative"
            x-data="{ open: false }"
            @click.outside="open = false"
        >
            <button
                @click="open = !open"
                class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-gray-100"
                aria-label="User menu"
            >
                <div class="w-7 h-7 bg-teal-700 rounded-full flex items-center justify-center">
                    <span class="text-xs font-semibold text-white">AU</span>
                </div>
                <div class="hidden sm:block text-left">
                    <p class="text-sm font-semibold text-gray-900 leading-tight">Admin User</p>
                    <p class="text-sm text-gray-700 leading-tight">System Administrator</p>
                </div>
                <svg class="w-4 h-4 text-gray-600 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div
                x-show="open"
                x-transition
                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-1 overflow-hidden"
                style="display: none;"
            >
                <a href="{{ route('settings.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <svg class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    My Profile
                </a>
                <a href="{{ route('settings.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <svg class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Settings
                </a>
                <div class="border-t border-gray-100 mt-1 pt-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Sign Out
                    </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>
