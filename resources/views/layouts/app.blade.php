<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HR & Payroll System') — Palma General Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">

    {{-- Mobile overlay --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black/40 lg:hidden"
        style="display: none;"
    ></div>

    {{-- Sidebar --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-30 w-64 bg-[#0b1f33] border-r border-white/10 transition-transform duration-200 ease-in-out lg:translate-x-0 lg:z-auto"
    >
        <x-sidebar :active-route="request()->route()->getName() ?? ''" />
    </aside>

    {{-- Main content wrapper --}}
    <div class="flex flex-col min-h-screen lg:pl-64">

        {{-- Top navigation --}}
        <x-top-nav />

        {{-- Page content --}}
        <main class="flex-1 p-4 md:p-6">
            @yield('content')
        </main>

    </div>

    {{-- Global toast notification --}}
    <div
        x-data="{
            show: false,
            message: '',
            type: 'success',
            trigger(msg, t) {
                this.message = msg;
                this.type = t || 'success';
                this.show = true;
                setTimeout(() => { this.show = false; }, 3000);
            }
        }"
        @show-toast.window="trigger($event.detail.message, $event.detail.type)"
        class="fixed top-4 right-4 z-50"
        style="display: none;"
        x-show="show"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
    >
        <div
            :class="{
                'bg-green-600 text-white': type === 'success',
                'bg-red-600 text-white':   type === 'error',
                'bg-amber-500 text-white':  type === 'warning',
                'bg-sky-600 text-white':    type === 'info'
            }"
            class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg min-w-64 max-w-sm"
            role="alert"
        >
            <span class="text-sm font-medium" x-text="message"></span>
            <button @click="show = false" class="ml-auto text-white/80 hover:text-white" aria-label="Dismiss notification">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
