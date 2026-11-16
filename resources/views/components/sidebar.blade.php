@props(['activeRoute' => ''])

@php
function navLink($route, $label, $icon, $activeRoute) {
    $isActive = str_starts_with($activeRoute, $route) || $activeRoute === $route;
    $baseClass = 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-150 w-full';
    $activeClass = $isActive
        ? 'bg-teal-700 text-white shadow-sm'
        : 'text-slate-200 hover:bg-white/10 hover:text-white';
    return [$baseClass . ' ' . $activeClass, $isActive];
}
@endphp

<div class="flex flex-col h-full">
    {{-- Logo / Brand --}}
    <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10">
        <div class="w-9 h-9 bg-teal-600 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <div>
            <p class="text-sm font-bold text-white leading-tight">Palma General Store</p>
            <p class="text-sm text-slate-300">People & Payroll</p>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-6">

        {{-- Dashboard --}}
        <div>
            <a href="{{ route('dashboard.index') }}"
               class="{{ navLink('dashboard', 'Dashboard', '', $activeRoute)[0] }}">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
        </div>

        {{-- Employees --}}
        <div>
            <p class="px-3 mb-1 text-sm font-semibold text-slate-300 uppercase tracking-wider">Employees</p>
            <div class="space-y-0.5">
                <a href="{{ route('employees.index') }}"
                   class="{{ navLink('employees', '', '', $activeRoute)[0] }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Employee List
                </a>
            </div>
        </div>

        {{-- Attendance --}}
        <div>
            <p class="px-3 mb-1 text-sm font-semibold text-slate-300 uppercase tracking-wider">Attendance</p>
            <div class="space-y-0.5">
                <a href="{{ route('attendance.overview') }}"
                   class="{{ str_starts_with($activeRoute, 'attendance.overview') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Overview
                </a>
                <a href="{{ route('attendance.records') }}"
                   class="{{ str_starts_with($activeRoute, 'attendance.records') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Records
                </a>
                <a href="{{ route('attendance.terminal') }}"
                   class="{{ str_starts_with($activeRoute, 'attendance.terminal') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    QR Terminal
                </a>
                <a href="{{ route('attendance.adjustments') }}"
                   class="{{ str_starts_with($activeRoute, 'attendance.adjustments') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Adjustments
                </a>
            </div>
        </div>

        {{-- Payroll --}}
        <div>
            <p class="px-3 mb-1 text-sm font-semibold text-slate-300 uppercase tracking-wider">Payroll</p>
            <div class="space-y-0.5">
                <a href="{{ route('payroll.overview') }}"
                   class="{{ str_starts_with($activeRoute, 'payroll.overview') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Overview
                </a>
                <a href="{{ route('payroll.periods') }}"
                   class="{{ str_starts_with($activeRoute, 'payroll.periods') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Pay Periods
                </a>
                <a href="{{ route('payroll.records', ['periodId' => 1]) }}"
                   class="{{ str_starts_with($activeRoute, 'payroll.records') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Payroll Records
                </a>
            </div>
        </div>

        {{-- Administration --}}
        <div>
            <p class="px-3 mb-1 text-sm font-semibold text-slate-300 uppercase tracking-wider">Administration</p>
            <div class="space-y-0.5">
                <a href="{{ route('users.index') }}"
                   class="{{ str_starts_with($activeRoute, 'users') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    User Management
                </a>
                <a href="{{ route('settings.index') }}"
                   class="{{ str_starts_with($activeRoute, 'settings') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Business Settings
                </a>
                <a href="{{ route('audit.index') }}"
                   class="{{ str_starts_with($activeRoute, 'audit') ? 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-teal-700 text-white w-full' : 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white w-full' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Audit Logs
                </a>
            </div>
        </div>

    </nav>
</div>
