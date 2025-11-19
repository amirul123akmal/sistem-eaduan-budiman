<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('code') | @yield('title') - Kampung Budiman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .bg-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.15) 1px, transparent 0);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-900 to-slate-800 text-white flex items-center justify-center px-4 py-12">
    <div class="absolute inset-0 bg-pattern opacity-40 pointer-events-none"></div>
    <div class="relative max-w-3xl w-full bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl p-10 text-center space-y-6">
        <div class="inline-flex items-center gap-4 px-6 py-2 rounded-full bg-white/10 border border-white/15 text-xs uppercase tracking-[0.3em] text-slate-200">
            <span>@yield('status')</span>
            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
            <span>Kampung Budiman</span>
        </div>

        <div class="space-y-2">
            <p class="text-6xl md:text-7xl font-black text-white drop-shadow">@yield('code')</p>
            <h1 class="text-3xl md:text-4xl font-bold text-white">@yield('title')</h1>
        </div>

        <p class="text-base md:text-lg text-slate-200 leading-relaxed max-w-2xl mx-auto">
            @yield('message')
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-4">
            <a href="{{ url('/') }}"
               class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-gradient-to-r from-primary to-tertiary text-white font-semibold shadow-lg shadow-primary/30 hover:opacity-90 transition">
                Kembali ke Laman Utama
            </a>
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center justify-center px-6 py-3 rounded-2xl border border-white/30 text-white font-semibold hover:bg-white/10 transition">
                Cuba Semula
            </a>
        </div>

        <p class="text-xs uppercase tracking-[0.3em] text-white/60 pt-6">
            @yield('footer', 'JPKK Kampung Budiman · Sistem Komuniti Digital')
        </p>
    </div>
</body>
</html>

