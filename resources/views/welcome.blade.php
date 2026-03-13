<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>واصل | المنصة اللوجستية لنقل المعتمرين</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('image/logo-light.png') }}">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #eef2ff;
            --accent: #f97316;
            --accent-dark: #ea6c07;
            --bg: #f8f9ff;
            --text: #0f172a;
            --text-muted: #64748b;
            --border: rgba(99, 102, 241, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
        }

        .grid-bg {
            background-color: #ffffff;
            background-image: linear-gradient(rgba(99, 102, 241, 0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(99, 102, 241, 0.05) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            pointer-events: none;
        }

        nav {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        }

        .glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(99, 102, 241, 0.15);
            box-shadow: 0 4px 24px rgba(99, 102, 241, 0.09);
        }

        .glass-light {
            background: rgba(238, 242, 255, 0.65);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(99, 102, 241, 0.15);
        }

        .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-weight: 800;
            border-radius: 1rem;
            padding: 1rem 2.5rem;
            font-size: 1.05rem;
            box-shadow: 0 8px 28px rgba(99, 102, 241, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            font-family: 'Cairo', sans-serif;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 44px rgba(99, 102, 241, 0.45);
        }

        .btn-primary:hover::before {
            opacity: 1;
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: white;
            font-weight: 800;
            border-radius: 1rem;
            padding: 1rem 2.5rem;
            font-size: 1.05rem;
            box-shadow: 0 8px 28px rgba(249, 115, 22, 0.35);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-family: 'Cairo', sans-serif;
        }

        .btn-accent:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(249, 115, 22, 0.45);
        }

        .btn-ghost {
            background: rgba(99, 102, 241, 0.06);
            color: var(--primary);
            font-weight: 700;
            border-radius: 1rem;
            padding: 1rem 2.5rem;
            font-size: 1.05rem;
            border: 1.5px solid rgba(99, 102, 241, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Cairo', sans-serif;
        }

        .btn-ghost:hover {
            background: rgba(99, 102, 241, 0.12);
            transform: translateY(-2px);
        }

        .stat-card {
            background: #fff;
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 1.5rem;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 2px 16px rgba(99, 102, 241, 0.06);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .stat-card:hover {
            border-color: rgba(99, 102, 241, 0.25);
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(99, 102, 241, 0.12);
        }

        .feature-card {
            background: #fff;
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 2rem;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(99, 102, 241, 0.05);
        }

        .feature-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 2rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.04) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .feature-card:hover {
            border-color: rgba(99, 102, 241, 0.25);
            transform: translateY(-8px);
            box-shadow: 0 24px 60px rgba(99, 102, 241, 0.12), 0 0 0 1px rgba(99, 102, 241, 0.1);
        }

        .feature-card:hover::after {
            opacity: 1;
        }

        .icon-box {
            width: 64px;
            height: 64px;
            border-radius: 1.2rem;
            background: var(--primary-light);
            border: 1px solid rgba(99, 102, 241, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            transition: all 0.4s ease;
            margin-bottom: 1.5rem;
        }

        .feature-card:hover .icon-box {
            background: var(--primary);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
        }

        .fleet-card {
            border-radius: 2rem;
            overflow: hidden;
            position: relative;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            border: 1px solid rgba(99, 102, 241, 0.1);
            background: #fff;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.07);
        }

        .fleet-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 32px 64px rgba(99, 102, 241, 0.15), 0 0 0 1px rgba(99, 102, 241, 0.2);
        }

        .fleet-img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: transform 0.7s ease;
            filter: brightness(0.85) saturate(1.1);
        }

        .fleet-card:hover .fleet-img {
            transform: scale(1.08);
            filter: brightness(0.95) saturate(1.2);
        }

        .fleet-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(8, 13, 26, 0.95) 0%, rgba(8, 13, 26, 0.3) 55%, transparent 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.9rem;
            border-radius: 2rem;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .badge-accent {
            background: rgba(249, 115, 22, 0.1);
            color: #ea6c07;
            border: 1px solid rgba(249, 115, 22, 0.25);
        }

        .badge-primary {
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .badge-green {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .route-card {
            background: #fff;
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 1.5rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 2px 12px rgba(99, 102, 241, 0.05);
        }

        .route-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            background: var(--primary-light);
            transform: translateX(-4px);
            box-shadow: 0 8px 28px rgba(99, 102, 241, 0.1);
        }

        .route-icon {
            width: 56px;
            height: 56px;
            border-radius: 1rem;
            background: var(--primary-light);
            border: 1px solid rgba(99, 102, 241, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1.2rem;
            background: var(--primary-light);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 2rem;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 1.2rem;
        }

        .ping-dot {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 10px;
            height: 10px;
        }

        .ping-dot span:first-child {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #22c55e;
            animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .ping-dot span:last-child {
            position: relative;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: all 0.65s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 {
            transition-delay: 0.1s;
        }

        .reveal-delay-2 {
            transition-delay: 0.2s;
        }

        .reveal-delay-3 {
            transition-delay: 0.3s;
        }

        .live-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #f0fdf4;
            border: 1px solid rgba(34, 197, 94, 0.25);
            padding: 0.55rem 1.1rem;
            border-radius: 2rem;
            font-size: 0.78rem;
            font-weight: 700;
            color: #16a34a;
        }

        .float-card {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .gradient-border {
            position: relative;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            inset: -1.5px;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.4), rgba(249, 115, 22, 0.25), rgba(99, 102, 241, 0.1));
            z-index: -1;
        }

        .book-btn {
            width: 100%;
            padding: 0.9rem;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 1.2rem;
            font-family: 'Cairo', sans-serif;
            font-weight: 800;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .book-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.5);
            transform: translateY(-2px);
        }

        .capacity-bar {
            height: 3px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 99px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .capacity-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, #a5b4fc, #f97316);
        }

        #mobile-menu {
            display: none;
        }

        #mobile-menu.open {
            display: block;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.2), transparent);
        }

        @media (max-width:768px) {
            section {
                padding-top: 4rem !important;
                padding-bottom: 4rem !important;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3 shrink-0">
                <img src="{{ asset('image/logo.png') }}" alt="واصل" class="h-10 md:h-12 w-auto object-contain">
            </a>
            <div class="hidden lg:flex items-center gap-1">
                <a href="#hero"
                    class="px-4 py-2 text-indigo-600 font-bold text-sm bg-indigo-50 rounded-lg">الرئيسية</a>
                <a href="#about"
                    class="px-4 py-2 text-slate-500 font-bold text-sm hover:text-slate-800 hover:bg-slate-100 rounded-lg transition">عن
                    واصل</a>
                <a href="#fleet"
                    class="px-4 py-2 text-slate-500 font-bold text-sm hover:text-slate-800 hover:bg-slate-100 rounded-lg transition">الأسطول</a>
                <a href="#routes"
                    class="px-4 py-2 text-slate-500 font-bold text-sm hover:text-slate-800 hover:bg-slate-100 rounded-lg transition">المسارات</a>
            </div>
            <div class="hidden lg:flex items-center gap-3">
                <div class="live-chip">
                    <div class="ping-dot"><span></span><span></span></div>النظام يعمل
                </div>
                <button class="btn-primary" style="padding:0.65rem 1.5rem;font-size:0.88rem;">بوابة الشركات</button>
            </div>
            <button class="lg:hidden text-slate-700 p-2 rounded-xl hover:bg-slate-100 transition"
                onclick="document.getElementById('mobile-menu').classList.toggle('open')">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>
        <div id="mobile-menu"
            class="lg:hidden bg-white/95 backdrop-blur-lg border-t border-indigo-100 px-6 py-4 space-y-1 shadow-lg">
            <a href="#hero" class="block px-4 py-3 text-indigo-600 font-bold rounded-xl bg-indigo-50">الرئيسية</a>
            <a href="#about"
                class="block px-4 py-3 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition">عن واصل</a>
            <a href="#fleet"
                class="block px-4 py-3 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition">الأسطول</a>
            <a href="#routes"
                class="block px-4 py-3 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition">المسارات</a>
            <button class="btn-primary w-full mt-2">بوابة الشركات</button>
        </div>
    </header>
    <style>
        <style>

        /* أنيميشن النقطة الخضراء (النظام يعمل) */
        .live-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.8rem;
            background: #f0fdf4;
            color: #16a34a;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            border: 1px solid #bbf7d0;
        }

        .ping-dot {
            position: relative;
            display: flex;
            height: 0.5rem;
            width: 0.5rem;
        }

        .ping-dot span:first-child {
            position: absolute;
            display: inline-flex;
            height: 100%;
            width: 100%;
            border-radius: 9999px;
            background-color: #22c55e;
            opacity: 0.75;
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .ping-dot span:last-child {
            position: relative;
            display: inline-flex;
            border-radius: 9999px;
            height: 0.5rem;
            width: 0.5rem;
            background-color: #16a34a;
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* تحسين القائمة في الموبايل */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s ease-in-out;
            opacity: 0;
            transform: translateY(-10px);
        }

        #mobile-menu.open {
            max-height: 500px;
            opacity: 1;
            transform: translateY(0);
            margin-top: 1rem;
        }

        .btn-primary {
            background: #6366f1;
            color: white;
            border-radius: 0.75rem;
            font-weight: 700;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            background: #4f46e5;
            transform: translateY(-2px);
        }
    </style>

    <!-- HERO -->
    <section id="hero" class="relative min-h-screen grid-bg flex items-center pt-8 pb-24 overflow-hidden">
        <div class="orb w-[700px] h-[700px] bg-indigo-300/20 top-[-200px] right-[-200px]"></div>
        <div class="orb w-[500px] h-[500px] bg-orange-300/15 bottom-[-100px] left-[-150px]"></div>

        <div class="container mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center relative z-10">
            <div class="space-y-8">
                <div class="section-label">
                    <div class="ping-dot"><span></span><span></span></div>
                    نظام إدارة النقل البري الأحدث في المملكة
                </div>
                <h1 class="font-black text-slate-900 leading-[1.1]" style="font-size:clamp(2.4rem,5.5vw,4.2rem);">
                    حوّل إدارة<span class="gradient-text"> تحركات</span><br>معتمريك إلى<br>تجربة <span
                        class="text-orange-500">ذكية</span>
                </h1>
                <p class="text-lg text-slate-500 leading-relaxed max-w-lg font-semibold">
                    واصل هي المنصة اللوجستية الأولى التي تمنح شركات السياحة المصرية تحكماً كاملاً في حجز وتتبع الحافلات
                    داخل السعودية بكل سهولة وأمان.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="btn-primary"><span
                            style="display:flex;align-items:center;gap:0.6rem;justify-content:center;">ابدأ التشغيل الآن
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24" style="transform:scaleX(-1)">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg></span></button>
                    <button class="btn-ghost">استعراض الأسطول</button>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <div class="badge badge-green">✓ موثّق ومرخّص</div>
                    <div class="badge badge-primary">+500 حافلة متاحة</div>
                    <div class="badge badge-accent">تأكيد فوري</div>
                </div>
            </div>

            <div class="relative">
                <div class="gradient-border" style="border-radius:2.5rem;position:relative;">
                    <img src="{{ asset('image/hero.jpg') }}" alt="Bus" class="w-full object-cover"
                        style="height:440px;border-radius:2.5rem;filter:brightness(0.88) saturate(1.05);box-shadow:0 32px 80px rgba(99,102,241,0.18);">
                    <div class="absolute inset-0"
                        style="background:linear-gradient(to top,rgba(8,13,26,0.45) 0%,transparent 50%);border-radius:2.5rem;">
                    </div>
                </div>

                <div class="float-card absolute -bottom-6 -right-4 glass p-5 rounded-2xl z-20 hidden md:block"
                    style="min-width:220px;">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-11 h-11 bg-green-100 border border-green-200 rounded-xl flex items-center justify-center text-green-600 font-bold text-lg">
                            ✓</div>
                        <div>
                            <p class="font-black text-slate-800 text-base">تأكيد الحجز</p>
                            <p class="text-slate-400 text-xs font-semibold">رحلة #EG-4821 — الآن</p>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center gap-2">
                        <div class="ping-dot"><span></span><span></span></div>
                        <span class="text-green-600 text-xs font-bold">سائق تم التعيين</span>
                    </div>
                </div>

                <div class="absolute -top-4 -left-4 glass p-4 rounded-2xl z-20 hidden md:block">
                    <p class="text-xs text-slate-400 font-bold mb-1">الرحلات اليوم</p>
                    <p class="text-3xl font-black text-slate-800">24 <span class="text-indigo-500 text-lg">/ 24</span>
                    </p>
                    <div class="capacity-bar mt-2" style="width:140px;background:rgba(99,102,241,0.1);">
                        <div class="capacity-fill" style="width:100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- STATS -->
    <section class="py-14" style="background:linear-gradient(135deg,#6366f1,#4f46e5);">
        <div class="container mx-auto px-6 grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center reveal">
                <p class="text-5xl font-black text-white mb-2">+500</p>
                <p class="text-indigo-200 font-bold text-xs uppercase tracking-widest">حافلة حديثة</p>
            </div>
            <div class="text-center reveal reveal-delay-1">
                <p class="text-5xl font-black text-orange-300 mb-2">+120</p>
                <p class="text-indigo-200 font-bold text-xs uppercase tracking-widest">شركة سياحة</p>
            </div>
            <div class="text-center reveal reveal-delay-2">
                <p class="text-5xl font-black text-white mb-2">+10k</p>
                <p class="text-indigo-200 font-bold text-xs uppercase tracking-widest">رحلة مكتملة</p>
            </div>
            <div class="text-center reveal reveal-delay-3">
                <p class="text-5xl font-black text-green-300 mb-2">24/7</p>
                <p class="text-indigo-200 font-bold text-xs uppercase tracking-widest">دعم لوجستي</p>
            </div>
        </div>
    </section>


    <!-- ABOUT -->
    <section id="about" class="py-24 relative overflow-hidden" style="background:#f8f9ff;">
        <div class="orb w-[500px] h-[500px] bg-indigo-200/25 top-0 left-[-150px]"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-2xl mb-16 reveal">
                <div class="section-label">لماذا واصل</div>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-5">لماذا تعتمد الشركات الكبرى على <span
                        class="gradient-text">واصل؟</span></h2>
                <p class="text-lg text-slate-500 font-semibold leading-relaxed">نحن لا نوفر باصات فقط، نحن نوفر نظاماً
                    يقلل من أخطاء التشغيل ويزيد من رضا معتمريك.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="feature-card reveal">
                    <div class="icon-box">🛰️</div>
                    <h3 class="text-xl font-black mb-3 text-slate-800">تتبع حي للرحلات</h3>
                    <p class="text-slate-500 leading-relaxed font-semibold text-sm">راقب تحركات مجموعاتك من لحظة خروجهم
                        من الفندق حتى وصولهم للمطار عبر لوحة تحكم ذكية ومتكاملة.</p>
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2">
                        <div class="ping-dot"><span></span><span></span></div>
                        <span class="text-green-600 text-xs font-bold">مباشر الآن</span>
                    </div>
                </div>
                <div class="feature-card reveal reveal-delay-1">
                    <div class="icon-box">📄</div>
                    <h3 class="text-xl font-black mb-3 text-slate-800">أوامر تشغيل فورية</h3>
                    <p class="text-slate-500 leading-relaxed font-semibold text-sm">بمجرد الحجز، يتم إصدار الـ Voucher
                        بكافة تفاصيل السائق والباص لتقديمه للجهات المختصة فوراً.</p>
                    <div class="mt-6 pt-4 border-t border-slate-100"><span class="badge badge-primary">PDF
                            تلقائي</span></div>
                </div>
                <div class="feature-card reveal reveal-delay-2">
                    <div class="icon-box">⚖️</div>
                    <h3 class="text-xl font-black mb-3 text-slate-800">تسعير لوجستي عادل</h3>
                    <p class="text-slate-500 leading-relaxed font-semibold text-sm">تجنب تقلبات السوق واحصل على أسعار
                        ثابتة ومنافسة مربوطة مباشرة بموردين معتمدين وموثوقين.</p>
                    <div class="mt-6 pt-4 border-t border-slate-100"><span class="badge badge-accent">أسعار
                            مضمونة</span></div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div class="feature-card reveal" style="display:flex;gap:1.5rem;align-items:flex-start;">
                    <div class="icon-box" style="flex-shrink:0;margin-bottom:0;">🔐</div>
                    <div>
                        <h3 class="text-xl font-black mb-2 text-slate-800">أمان بيانات كامل</h3>
                        <p class="text-slate-500 font-semibold text-sm leading-relaxed">جميع بيانات شركتك ومجموعاتك
                            محمية بأعلى معايير التشفير ومطابقة لمتطلبات هيئة البيانات السعودية.</p>
                    </div>
                </div>
                <div class="feature-card reveal reveal-delay-1"
                    style="display:flex;gap:1.5rem;align-items:flex-start;">
                    <div class="icon-box" style="flex-shrink:0;margin-bottom:0;">📱</div>
                    <div>
                        <h3 class="text-xl font-black mb-2 text-slate-800">لوحة تحكم متكاملة</h3>
                        <p class="text-slate-500 font-semibold text-sm leading-relaxed">أدر كل رحلاتك من جهاز واحد —
                            كمبيوتر أو هاتف — مع إشعارات لحظية ومرفقات فورية.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FLEET -->
    <section id="fleet" class="py-24 relative overflow-hidden bg-white">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="reveal">
                    <div class="text-indigo-600 font-bold text-sm tracking-widest mb-2 uppercase">الأسطول اللوجستي
                    </div>
                    <h2 class="text-4xl font-black text-slate-900 mb-3">خيارات نقل متنوعة</h2>
                    <p class="text-slate-500 font-semibold">من الحافلات الكبرى إلى الفان الـ VIP، نغطي كافة احتياجاتكم
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="group relative rounded-2xl overflow-hidden bg-slate-900 aspect-[4/5]">
                    <img src="https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&q=80&w=600"
                        class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent p-6 flex flex-col justify-end">
                        <span class="text-orange-400 text-[10px] font-black mb-1 uppercase tracking-tighter">Large
                            Coach</span>
                        <h4 class="text-xl font-black text-white">50 راكب</h4>
                        <p class="text-slate-300 text-xs mb-4">موديلات 2025 - مرسيدس</p>
                        <button
                            class="w-full py-2 bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-bold rounded-lg hover:bg-white hover:text-slate-900 transition">حجز
                            سريع</button>
                    </div>
                </div>

                <div class="group relative rounded-2xl overflow-hidden bg-slate-900 aspect-[4/5]">
                    <img src="https://images.pexels.com/photos/385998/pexels-photo-385998.jpeg?auto=compress&cs=tinysrgb&w=600"
                        class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-indigo-900 via-transparent p-6 flex flex-col justify-end">
                        <span class="text-indigo-300 text-[10px] font-black mb-1 uppercase tracking-tighter">Medium
                            Bus</span>
                        <h4 class="text-xl font-black text-white">32 راكب</h4>
                        <p class="text-slate-300 text-xs mb-4">مثالي للبعثات السياحية</p>
                        <button
                            class="w-full py-2 bg-indigo-600 text-white text-sm font-bold rounded-lg hover:bg-indigo-500 transition shadow-lg">حجز
                            سريع</button>
                    </div>
                </div>

                <div class="group relative rounded-2xl overflow-hidden bg-slate-900 aspect-[4/5]">
                    <img src="{{ asset('image/bus27.jpg') }}" alt="Mini Bus"
                        class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent p-6 flex flex-col justify-end">
                        <span class="text-slate-400 text-[10px] font-black mb-1 uppercase tracking-tighter">Mini
                            Bus</span>
                        <h4 class="text-xl font-black text-white">27 راكب</h4>
                        <p class="text-slate-300 text-xs mb-4">تويوتا كوستر - مكيّف</p>
                        <button
                            class="w-full py-2 bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-bold rounded-lg hover:bg-white hover:text-slate-900 transition">حجز
                            سريع</button>
                    </div>
                </div>

                <div class="group relative rounded-2xl overflow-hidden bg-slate-900 aspect-[4/5]">
                    <img src="{{ asset('image/bus8.jpg') }}"
                        class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-transparent p-6 flex flex-col justify-end">
                        <span class="text-emerald-400 text-[10px] font-black mb-1 uppercase tracking-tighter">Executive
                            Van</span>
                        <h4 class="text-xl font-black text-white">8 ركاب</h4>
                        <p class="text-slate-300 text-xs mb-4">فان عائلي - خدمة VIP</p>
                        <button
                            class="w-full py-2 bg-emerald-600 text-white text-sm font-bold rounded-lg hover:bg-emerald-500 transition">حجز
                            سريع</button>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ROUTES -->
    <section id="routes" class="py-24 relative" style="background:#f8f9ff;">
        <div class="orb w-[400px] h-[400px] bg-indigo-200/20 bottom-0 left-0"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16 reveal">
                <div class="section-label" style="display:inline-flex;justify-content:center;">أبرز المسارات</div>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mt-3">مسارات النقل اللوجستي</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="route-card reveal">
                    <div class="route-icon">🕋</div>
                    <div>
                        <p class="font-black text-slate-800 mb-1">مكة المكرمة</p>
                        <p class="text-xs text-slate-400 font-bold">نقاط تحرك رئيسية</p>
                        <div class="mt-2"><span class="badge badge-primary"
                                style="font-size:0.65rem;padding:0.2rem 0.6rem;">24 خط نشط</span></div>
                    </div>
                </div>
                <div class="route-card reveal reveal-delay-1">
                    <div class="route-icon">🕌</div>
                    <div>
                        <p class="font-black text-slate-800 mb-1">المدينة المنورة</p>
                        <p class="text-xs text-slate-400 font-bold">ربط مباشر</p>
                        <div class="mt-2"><span class="badge badge-primary"
                                style="font-size:0.65rem;padding:0.2rem 0.6rem;">18 خط نشط</span></div>
                    </div>
                </div>
                <div class="route-card reveal reveal-delay-2">
                    <div class="route-icon">✈️</div>
                    <div>
                        <p class="font-black text-slate-800 mb-1">مطار جدة</p>
                        <p class="text-xs text-slate-400 font-bold">استقبال ومغادرة</p>
                        <div class="mt-2"><span class="badge badge-green"
                                style="font-size:0.65rem;padding:0.2rem 0.6rem;">متاح الآن</span></div>
                    </div>
                </div>
                <div class="route-card reveal reveal-delay-3">
                    <div class="route-icon">🏙️</div>
                    <div>
                        <p class="font-black text-slate-800 mb-1">مطار الطائف</p>
                        <p class="text-xs text-slate-400 font-bold">خدمات إضافية</p>
                        <div class="mt-2"><span class="badge badge-accent"
                                style="font-size:0.65rem;padding:0.2rem 0.6rem;">موسم ٢٠٢٦</span></div>
                    </div>
                </div>
            </div>

            <div class="mt-10 bg-white rounded-3xl p-8 reveal border border-indigo-100 shadow-sm"
                style="min-height:200px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
                <svg viewBox="0 0 800 200" class="absolute inset-0 w-full h-full" style="opacity:0.1;">
                    <line x1="700" y1="100" x2="530" y2="80" stroke="#6366f1"
                        stroke-width="2" stroke-dasharray="8,4" />
                    <line x1="530" y1="80" x2="300" y2="100" stroke="#6366f1"
                        stroke-width="2" stroke-dasharray="8,4" />
                    <line x1="300" y1="100" x2="150" y2="90" stroke="#6366f1"
                        stroke-width="2" stroke-dasharray="8,4" />
                    <circle cx="700" cy="100" r="7" fill="#f97316" />
                    <circle cx="530" cy="80" r="9" fill="#6366f1" />
                    <circle cx="300" cy="100" r="7" fill="#6366f1" />
                    <circle cx="150" cy="90" r="7" fill="#6366f1" />
                </svg>
                <div class="text-center relative z-10">
                    <p class="text-slate-700 font-bold text-lg mb-2">خريطة المسارات التفاعلية</p>
                    <p class="text-slate-400 text-sm font-semibold mb-4">تغطية شاملة لكافة مناطق المملكة</p>
                    <button class="btn-ghost" style="padding:0.6rem 1.5rem;font-size:0.85rem;">استعراض كل
                        المسارات</button>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="rounded-[2.5rem] p-12 text-center reveal relative overflow-hidden"
                style="background:linear-gradient(135deg,#eef2ff 0%,#fef3c7 100%);border:1px solid rgba(99,102,241,0.15);">
                <div class="orb w-72 h-72 bg-indigo-300/20" style="top:-80px;right:-80px;"></div>
                <div class="orb w-56 h-56 bg-orange-300/20" style="bottom:-60px;left:-60px;"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-4">جاهز لتشغيل موسم ٢٠٢٦؟</h2>
                    <p class="text-slate-500 font-semibold text-lg mb-8 max-w-xl mx-auto">انضم إلى أكثر من ١٢٠ شركة
                        سياحة مصرية تعتمد على واصل لإدارة رحلاتهم</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="btn-primary" style="font-size:1.05rem;padding:1.1rem 3rem;">ابدأ مجاناً
                            الآن</button>
                        <button class="btn-ghost">تحدث مع خبير لوجستي</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer class="pt-20 pb-10" style="background:#0f172a;">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-4 gap-12 pb-16 border-b border-white/5">
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <a href="#" class="flex items-center gap-3 shrink-0">
                            <img src="{{ asset('image/logo.png') }}" alt="واصل"
                                class="h-10 md:h-12 w-auto object-contain">
                        </a>
                    </div>
                    <p class="text-slate-400 font-semibold leading-relaxed text-sm">المنصة اللوجستية المتكاملة لخدمات
                        النقل البري وتأمين الحافلات لشركات السياحة المصرية.</p>
                    <div class="flex gap-3">
                        <a href="#"
                            class="w-9 h-9 rounded-lg border border-white/10 flex items-center justify-center text-slate-400 hover:text-indigo-400 transition text-sm bg-white/5">in</a>
                        <a href="#"
                            class="w-9 h-9 rounded-lg border border-white/10 flex items-center justify-center text-slate-400 hover:text-indigo-400 transition text-sm bg-white/5">X</a>
                        <a href="#"
                            class="w-9 h-9 rounded-lg border border-white/10 flex items-center justify-center text-slate-400 hover:text-indigo-400 transition text-sm bg-white/5">fb</a>
                    </div>
                </div>
                <div>
                    <h5 class="text-base font-black text-white mb-5">المنصة</h5>
                    <ul class="space-y-3 text-slate-400 font-semibold text-sm">
                        <li><a href="#" class="hover:text-indigo-400 transition">عن واصل</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">الأسطول اللوجستي</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">نظام التتبع المباشر</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">بوابة الشركات</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-base font-black text-white mb-5">الدعم</h5>
                    <ul class="space-y-3 text-slate-400 font-semibold text-sm">
                        <li><a href="#" class="hover:text-indigo-400 transition">الأسئلة الشائعة</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">الدعم الفني 24/7</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">سياسة الخصوصية</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">شروط الاستخدام</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-base font-black text-white mb-5">تواصل معنا</h5>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-sm">
                                📍</div>
                            <p class="text-slate-400 font-semibold text-sm">القاهرة · جدة</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-sm">
                                📞</div>
                            <p class="text-slate-400 font-semibold text-sm">+966 5X XXX XXXX</p>
                        </div>
                    </div>
                    <button class="btn-primary w-full" style="font-size:0.9rem;padding:0.85rem;">اتصل بالمندوب
                        الآن</button>
                </div>
            </div>
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-slate-500 font-semibold text-sm">© 2026 واصل للنقل اللوجستي. جميع الحقوق محفوظة.</p>
                <div class="flex items-center gap-2">
                    <div class="ping-dot"><span></span><span></span></div>
                    <span class="text-green-400 text-xs font-bold">جميع الأنظمة تعمل بشكل طبيعي</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px'
        });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function(e) {
                const t = document.querySelector(this.getAttribute('href'));
                if (t) {
                    e.preventDefault();
                    t.scrollIntoView({
                        behavior: 'smooth'
                    });
                    document.getElementById('mobile-menu')?.classList.remove('open');
                }
            });
        });
    </script>
</body>

</html>
