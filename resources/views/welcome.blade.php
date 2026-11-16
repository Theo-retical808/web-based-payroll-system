<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0b1f33">
    <title>Palma People & Payroll</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased">
    <header class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5 lg:px-8">
        <a href="{{ route('splash') }}" class="flex items-center gap-3" aria-label="Palma People and Payroll home">
            <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#0b1f33] text-white">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 20V6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5V20M2 20h20M8 8h2m4 0h2m-8 4h2m4 0h2m-8 4h2m4 0h2M11 20v-3h2v3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <span><span class="block text-base font-bold text-[#0b1f33]">Palma People</span><span class="block text-sm text-slate-600">Records · Attendance · Payroll</span></span>
        </a>
        <a href="{{ route('login') }}" class="rounded-xl bg-[#0b1f33] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#163653] focus:outline-none focus:ring-4 focus:ring-teal-200">Sign in</a>
    </header>

    <main class="mx-auto grid max-w-7xl items-center gap-12 px-5 pb-16 pt-10 lg:grid-cols-[1.05fr_.95fr] lg:px-8 lg:pb-24 lg:pt-16">
        <section class="max-w-2xl">
            <span class="inline-flex items-center gap-2 rounded-full border border-teal-200 bg-teal-50 px-3.5 py-2 text-sm font-semibold text-teal-900"><span class="h-2 w-2 rounded-full bg-teal-600"></span>People operations, made clearer</span>
            <h1 class="mt-6 text-4xl font-bold leading-tight tracking-tight text-[#0b1f33] sm:text-5xl lg:text-6xl">A simpler way to care for your team and payroll.</h1>
            <p class="mt-5 max-w-xl text-lg leading-8 text-slate-600">Keep employee records, attendance, and pay periods together in one calm, easy-to-explore workspace.</p>
            <div class="mt-8 flex flex-wrap gap-3"><a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-teal-700 px-6 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-800 focus:outline-none focus:ring-4 focus:ring-teal-200">Go to your workspace <span aria-hidden="true">→</span></a><a href="#modules" class="rounded-xl border border-slate-300 bg-white px-6 py-3.5 text-sm font-semibold text-[#0b1f33] transition hover:border-teal-600 hover:bg-teal-50">Explore features</a></div>
            <p class="mt-5 text-sm text-slate-600">Demo sign-in: <span class="font-semibold text-[#0b1f33]">admin</span> / <span class="font-semibold text-[#0b1f33]">pass123</span></p>
        </section>

        <section aria-label="People and payroll dashboard preview" class="relative">
            <div class="absolute -inset-4 rounded-[2rem] bg-teal-50 sm:-inset-7"></div>
            <div class="relative overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-2xl shadow-[#0b1f33]/10">
                <div class="flex items-center justify-between border-b border-slate-200 bg-[#0b1f33] px-5 py-4 text-white"><div><p class="text-sm font-semibold">Today at a glance</p><p class="mt-0.5 text-sm text-slate-300">Palma General Store</p></div><span class="rounded-full bg-teal-500/20 px-3 py-1.5 text-sm font-semibold text-teal-100">Workspace</span></div>
                <div class="grid grid-cols-2 gap-3 p-4 sm:gap-4 sm:p-6"><div class="rounded-2xl border border-slate-200 p-4"><p class="text-sm text-slate-600">Active employees</p><p class="mt-2 text-3xl font-bold text-[#0b1f33]">13</p><span class="mt-3 block h-1.5 rounded-full bg-teal-500"></span></div><div class="rounded-2xl border border-slate-200 p-4"><p class="text-sm text-slate-600">Payroll periods</p><p class="mt-2 text-3xl font-bold text-[#0b1f33]">03</p><span class="mt-3 block h-1.5 rounded-full bg-teal-200"></span></div></div>
                <div class="px-4 pb-5 sm:px-6 sm:pb-6"><div class="rounded-2xl bg-slate-50 p-4"><div class="flex items-center justify-between"><p class="text-sm font-semibold text-[#0b1f33]">Your modules</p><span class="text-sm text-slate-600">All in one place</span></div><div id="modules" class="mt-4 grid grid-cols-2 gap-2 sm:grid-cols-4"><span class="rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm font-medium text-[#0b1f33]">Employees</span><span class="rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm font-medium text-[#0b1f33]">Attendance</span><span class="rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm font-medium text-[#0b1f33]">Payroll</span><span class="rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm font-medium text-[#0b1f33]">Reports</span></div></div></div>
            </div>
        </section>
    </main>
    <footer class="border-t border-slate-200"><div class="mx-auto flex max-w-7xl flex-col gap-2 px-5 py-5 text-sm text-slate-600 sm:flex-row sm:items-center sm:justify-between lg:px-8"><span>Palma People & Payroll</span><span>Employee records, attendance, and payroll in one workspace.</span></div></footer>
</body>
</html>
