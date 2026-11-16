<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0b1f33">
    <title>Sign in · Palma People</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <main class="grid min-h-screen lg:grid-cols-[1.05fr_.95fr]">
        <section class="relative hidden overflow-hidden bg-[#0b1f33] p-12 text-white lg:flex lg:flex-col lg:justify-between xl:p-16">
            <a href="{{ route('splash') }}" class="flex items-center gap-3"><span class="grid h-11 w-11 place-items-center rounded-2xl bg-teal-500 text-[#0b1f33]"><svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 20V6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5V20M2 20h20M8 8h2m4 0h2m-8 4h2m4 0h2m-8 4h2m4 0h2M11 20v-3h2v3" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span class="text-lg font-bold">Palma People</span></a>
            <div class="relative z-10 max-w-xl"><span class="text-sm font-semibold uppercase tracking-[.18em] text-teal-300">Your team, in sync</span><h1 class="mt-5 text-4xl font-bold leading-tight xl:text-5xl">Everything you need to support your people.</h1><p class="mt-5 text-lg leading-8 text-slate-300">Move between employee records, attendance, and payroll with a workspace designed to feel clear from the first click.</p><div class="mt-8 grid gap-3 sm:grid-cols-3"><div class="rounded-2xl border border-white/15 bg-white/5 p-4"><p class="text-sm font-semibold text-teal-200">01</p><p class="mt-2 text-sm font-medium">People records</p></div><div class="rounded-2xl border border-white/15 bg-white/5 p-4"><p class="text-sm font-semibold text-teal-200">02</p><p class="mt-2 text-sm font-medium">Daily attendance</p></div><div class="rounded-2xl border border-white/15 bg-white/5 p-4"><p class="text-sm font-semibold text-teal-200">03</p><p class="mt-2 text-sm font-medium">Payroll periods</p></div></div></div>
            <p class="text-sm text-slate-400">Palma General Store · People & Payroll workspace</p>
            <div class="pointer-events-none absolute -bottom-28 -right-20 h-80 w-80 rounded-full border-[48px] border-teal-500/10"></div>
        </section>

        <section class="flex items-center justify-center px-5 py-10 sm:px-10">
            <div class="w-full max-w-md">
                <a href="{{ route('splash') }}" class="mb-10 inline-flex items-center gap-2 text-sm font-semibold text-teal-800 hover:text-teal-900 lg:hidden"><span aria-hidden="true">←</span> Back to overview</a>
                <div class="mb-8"><span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#0b1f33] text-white"><svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2Zm10-11V7a4 4 0 0 0-8 0v4h8Z" stroke-linecap="round" stroke-linejoin="round"/></svg></span><h2 class="mt-5 text-3xl font-bold tracking-tight text-[#0b1f33]">Welcome back</h2><p class="mt-2 text-base text-slate-600">Sign in to continue to your workspace.</p></div>
                @if($errors->any())<div role="alert" class="mb-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-900">{{ $errors->first() }}</div>@endif
                <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                    @csrf
                    <div><label for="username" class="mb-2 block text-sm font-semibold text-slate-800">Username</label><input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" required autofocus placeholder="Enter your username" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-base text-slate-900 outline-none transition placeholder:text-slate-500 focus:border-teal-600 focus:ring-4 focus:ring-teal-100"></div>
                    <div><div class="mb-2 flex items-center justify-between"><label for="password" class="block text-sm font-semibold text-slate-800">Password</label><span class="text-sm text-slate-600">Demo access</span></div><div class="relative" x-data="{show:false}"><input id="password" name="password" :type="show?'text':'password'" autocomplete="current-password" required placeholder="Enter your password" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 pr-20 text-base text-slate-900 outline-none transition placeholder:text-slate-500 focus:border-teal-600 focus:ring-4 focus:ring-teal-100"><button type="button" @click="show=!show" class="absolute inset-y-0 right-3 my-auto min-h-11 px-3 text-sm font-semibold text-teal-800" x-text="show?'Hide':'Show'" :aria-label="show?'Hide password':'Show password'"></button></div></div>
                    <button type="submit" class="flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-teal-700 px-5 py-3.5 text-base font-semibold text-white shadow-sm transition hover:bg-teal-800 focus:outline-none focus:ring-4 focus:ring-teal-200">Sign in <span aria-hidden="true">→</span></button>
                </form>
                <div class="mt-6 rounded-xl border border-teal-200 bg-teal-50 p-4"><p class="text-sm font-semibold text-[#0b1f33]">Demo credentials</p><p class="mt-1 text-sm text-slate-700">Username: <code class="rounded bg-white px-1.5 py-0.5 font-semibold">admin</code> &nbsp; Password: <code class="rounded bg-white px-1.5 py-0.5 font-semibold">pass123</code></p></div>
                <p class="mt-8 text-center text-sm text-slate-600">Need an overview? <a href="{{ route('splash') }}" class="font-semibold text-teal-800 underline decoration-teal-300 underline-offset-4 hover:text-teal-900">Explore the workspace</a></p>
            </div>
        </section>
    </main>
</body>
</html>
