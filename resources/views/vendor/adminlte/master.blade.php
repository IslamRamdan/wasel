<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- IFrame Preloader Removal Workaround --}}
    <!-- IFrame Preloader Removal Workaround -->
    <style type="text/css">
        body.iframe-mode .preloader {
            display: none !important;
        }
    </style>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets (depends on Laravel asset bundling tool) --}}
    @if (config('adminlte.enabled_laravel_mix', false))
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @else
        @switch(config('adminlte.laravel_asset_bundling', false))
            @case('mix')
                <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_css_path', 'css/app.css')) }}">
            @break

            @case('vite')
                @vite([config('adminlte.laravel_css_path', 'resources/css/app.css'), config('adminlte.laravel_js_path', 'resources/js/app.js')])
            @break

            @case('vite_js_only')
                @vite(config('adminlte.laravel_js_path', 'resources/js/app.js'))
            @break

            @default
                <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
                <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
                <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

                @if (config('adminlte.google_fonts.allowed', true))
                    <link rel="stylesheet"
                        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
                @endif
        @endswitch
    @endif

    {{-- Extra Configured Plugins Stylesheets --}}
    @include('adminlte::plugins', ['type' => 'css'])

    {{-- Livewire Styles --}}
    @if (config('adminlte.livewire'))
        @if (intval(app()->version()) >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if (config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        /* إعدادات الخط والاتجاه العامة */
        html,
        body {
            direction: rtl !important;
            text-align: right !important;
            font-family: 'Tajawal', sans-serif !important;
            background-color: #f8fafc !important;
        }

        /* إصلاح السايد بار في الشاشات الكبيرة */
        @media (min-width: 992px) {
            .main-sidebar {
                right: 0 !important;
                left: auto !important;
                border-left: 1px solid #e2e8f0 !important;
            }

            .content-wrapper,
            .main-header,
            .main-footer {
                margin-right: 250px !important;
                margin-left: 0 !important;
            }
        }

        /* إصلاح الريسبونسيف (الموبايل والتابلت) */
        @media (max-width: 991.98px) {
            .main-sidebar {
                right: -250px !important;
                left: auto !important;
                transform: translate3d(250px, 0, 0) !important;
            }

            body.sidebar-open .main-sidebar {
                transform: translate3d(0, 0, 0) !important;
            }

            .content-wrapper,
            .main-header,
            .main-footer {
                margin-right: 0 !important;
            }

            #sidebar-overlay {
                right: 0 !important;
            }
        }

        /* تنسيق الروابط والأيقونات داخل القائمة */
        .nav-sidebar .nav-item>.nav-link {
            display: flex !important;
            align-items: center !important;
            padding: 10px 15px !important;
        }

        .nav-sidebar .nav-link>i {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .nav-sidebar .nav-link>p {
            margin: 0 !important;
            white-space: nowrap;
        }

        /* تصفير هوامش القوائم لمنع النقاط والمسافات الزائدة */
        .sidebar ul {
            padding: 0 !important;
            list-style: none !important;
        }

        /* مكان سهم القوائم المنسدلة */
        .nav-sidebar .nav-link>.right {
            left: 1rem !important;
            right: auto !important;
            transform: rotate(180deg);
        }

        .sidebar-light-success .nav-sidebar>.nav-item>.nav-link.active {
            background-color: #28a745 !important;
            color: #fff !important;
        }
    </style>
    <style>
        /* 1. إعدادات الخط والاتجاه الأساسية */
        :root {
            --sidebar-width: 250px;
        }

        html,
        body {
            direction: rtl !important;
            text-align: right !important;
            font-family: 'Tajawal', sans-serif !important;
        }

        /* 2. إصلاح الهيدر والفوتر والمحتوى في الشاشات الكبيرة */
        @media (min-width: 992px) {
            body.rtl .main-sidebar {
                right: 0 !important;
                left: auto !important;
            }

            body.rtl .content-wrapper,
            body.rtl .main-header,
            body.rtl .main-footer {
                margin-right: var(--sidebar-width) !important;
                margin-left: 0 !important;
            }

            /* في حال كان السايد بار مغلق (Collapsed) */
            body.rtl.sidebar-collapse .content-wrapper,
            body.rtl.sidebar-collapse .main-header,
            body.rtl.sidebar-collapse .main-footer {
                margin-right: 4.6rem !important;
                margin-left: 0 !important;
            }
        }

        /* 3. إصلاح الريسبونسيف (الموبايل) - أهم جزء */
        @media (max-width: 991.98px) {
            body.rtl .main-sidebar {
                right: calc(var(--sidebar-width) * -1) !important;
                /* يختفي لليمين */
                left: auto !important;
                transform: none !important;
                /* نلغي تحريك الفريمورك الأصلي */
                transition: right 0.3s ease-in-out !important;
            }

            /* عند فتح المنيو في الموبايل */
            body.rtl.sidebar-open .main-sidebar {
                right: 0 !important;
                left: auto !important;
            }

            body.rtl .content-wrapper {
                margin-right: 0 !important;
            }

            /* إصلاح مكان الطبقة الشفافة */
            #sidebar-overlay {
                right: 0 !important;
                left: 0 !important;
            }
        }

        /* 4. تنسيق العناصر الداخلية (الأيقونات والنصوص) */
        .nav-sidebar .nav-link {
            display: flex !important;
            align-items: center !important;
        }



        .nav-sidebar .nav-link p {
            margin: 0 !important;
            text-align: right !important;
        }

        /* إصلاح أسهم القوائم المنسدلة */
        .nav-sidebar .nav-link>.right {
            left: 1rem !important;
            right: auto !important;
            transform: rotate(180deg) !important;
        }

        .nav-sidebar .menu-open>.nav-link>i.right {
            transform: rotate(90deg) !important;
        }
    </style>
    <style>
        /* 1. تنعيم حركة السايد بار بالكامل */
        .main-sidebar,
        .main-sidebar::before {
            transition: margin-right 0.3s ease-in-out, transform 0.3s ease-in-out, width 0.3s ease-in-out !important;
        }

        /* 2. تنعيم حركة المحتوى لكي يلحق بالسايد بار */
        .content-wrapper,
        .main-header,
        .main-footer {
            transition: margin-right 0.3s ease-in-out !important;
        }

        /* 3. إصلاح "القفزة" عند تصغير السايد بار (Sidebar Mini) */
        body.sidebar-mini.sidebar-collapse .main-sidebar {
            width: 4.6rem !important;
            /* العرض عند التصغير */
        }

        /* 4. معالجة الـ Transform في وضع الـ RTL */
        /* عند إغلاق السايد بار في الشاشات الكبيرة */
        @media (min-width: 992px) {

            body.sidebar-mini.sidebar-collapse .content-wrapper,
            body.sidebar-mini.sidebar-collapse .main-header,
            body.sidebar-mini.sidebar-collapse .main-footer {
                margin-right: 4.6rem !important;
                margin-left: 0 !important;
            }
        }

        /* 5. منع ظهور الـ Scrollbar الأفقي أثناء الحركة */
        body {
            overflow-x: hidden !important;
        }

        /* 6. إصلاح النص والأيقونات أثناء التصغير لكي لا "تطير" خارج الصندوق */
        .sidebar-collapse .nav-sidebar .nav-link p {
            display: none !important;
        }

        .sidebar-collapse .main-sidebar .nav-sidebar .nav-item>.nav-link {
            text-align: center !important;
        }
    </style>
    <style>
        /* 1. إصلاح عرض السايد بار عند الهوفر وهو مغلق */
        .sidebar-mini.sidebar-collapse .main-sidebar:hover,
        .sidebar-mini.sidebar-collapse .main-sidebar.sidebar-focused {
            width: 250px !important;
            /* نفس عرض السايد بار وهو مفتوح */
            right: 0 !important;
            left: auto !important;
        }

        /* 2. إظهار النصوص المفرودة عند الهوفر ومنع تداخلها */
        .sidebar-mini.sidebar-collapse .main-sidebar:hover .nav-sidebar .nav-link p {
            display: inline-block !important;
            opacity: 1 !important;
            margin-right: 10px !important;
            white-space: nowrap !important;
        }

        /* 3. تنظيف شكل الأيقونات والنصوص لمنع "الكركبة" */
        .sidebar-mini.sidebar-collapse .main-sidebar:hover .nav-sidebar .nav-item>.nav-link {
            display: flex !important;
            align-items: center !important;
            text-align: right !important;
            width: 100% !important;
            margin: 0 !important;
        }

        /* 4. منع المحتوى (Content Wrapper) من الاهتزاز عند الهوفر */
        @media (min-width: 992px) {

            .sidebar-mini.sidebar-collapse .content-wrapper,
            .sidebar-mini.sidebar-collapse .main-header,
            .sidebar-mini.sidebar-collapse .main-footer {
                margin-right: 4.6rem !important;
                /* الحفاظ على مساحة التصغير ثابتة */
                margin-left: 0 !important;
            }
        }

        /* 5. إصلاح البراند (اللوجو) عند الهوفر */
        .sidebar-mini.sidebar-collapse .main-sidebar:hover .brand-link .brand-text {
            display: inline-block !important;
            opacity: 1 !important;
        }
    </style>
    <style>
        /* 1. السايد بار بالكامل (الخلفية) */
        .main-sidebar {
            background-color: #0f172a !important;
            /* كحلي غامق جداً (Midnight) */
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1) !important;
        }

        /* 2. اللوجو (البراند) */
        .brand-link {
            background-color: #0f172a !important;
            border-bottom: 1px solid #1e293b !important;
            color: #fff !important;
        }

        /* 3. الروابط العادية (قبل الضغط) */
        .nav-sidebar .nav-item .nav-link {
            color: #94a3b8 !important;
            /* رمادي مريح للعين */
            border-radius: 8px !important;
            transition: 0.3s all ease;
        }

        /* 4. عند تمرير الماوس (Hover) */
        .nav-sidebar .nav-item .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #10b981 !important;
            /* أخضر زمردي */
            padding-right: 20px !important;
            /* حركة انزلاق لليمين */
        }

        /* 5. الرابط النشط (المختار حالياً) */
        .nav-sidebar .nav-item>.nav-link.active {
            background: linear-gradient(90deg, #10b981, #059669) !important;
            /* تدرج أخضر فخم */
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25) !important;
        }

        /* 6. العناوين الجانبية (Headers) */
        .nav-header {
            color: #475569 !important;
            font-weight: 800 !important;
            font-size: 0.7rem !important;
            padding: 1.5rem 1rem 0.5rem !important;
        }

        /* 7. السهم الصغير للقوائم المنسدلة */
        .nav-sidebar .nav-treeview {
            background-color: rgba(255, 255, 255, 0.02) !important;
            margin-top: 5px;
            border-radius: 8px;
        }

        /* 8. الجزء السفلي (User Panel) إذا وجد */
        .user-panel {
            border-bottom: 1px solid #1e293b !important;
        }
    </style>

    <style>
        /* 1. الخلفية العامة للموقع */
        body {
            font-family: 'Tajawal', sans-serif !important;
            background-color: #f8fafc !important;
            /* رمادي خفيف جداً لإبراز الكروت البيضاء */
        }

        /* 2. السايد بار (القائمة الجانبية) */
        .main-sidebar {
            background-color: #ffffff !important;
            border-left: 1px solid #eef2f6 !important;
            /* فاصل جانبي ناعم */
        }

        /* 3. شعار واصل (Brand) */
        .brand-link {
            background-color: #ffffff !important;
            border-bottom: 1px solid #f1f5f9 !important;
            padding: 1.2rem 1rem !important;
        }

        .brand-text {
            color: #1e293b !important;
            /* لون كحلي غامق للنص */
            font-weight: 800 !important;
        }

        /* 4. الروابط في السايد بار */
        .nav-sidebar .nav-item .nav-link {
            color: #64748b !important;
            /* رمادي احترافي */
            border-radius: 12px !important;
            padding: 12px 15px !important;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        /* 5. حالة الوقوف (Hover) */
        .nav-sidebar .nav-item .nav-link:hover {
            background-color: #f1f5f9 !important;
            color: #10b981 !important;
            /* أخضر واصل */
        }

        /* 6. الرابط النشط (Active) - تصميم "الكبسولة المضيئة" */
        .nav-sidebar .nav-link.active {
            background-color: #ecfdf5 !important;
            /* خلفية خضراء نعناعية باهتة */
            color: #059669 !important;
            /* أخضر غامق للوضوح */
            font-weight: 700;
        }

        /* 7. الأيقونات */
        .nav-link i {
            margin-left: 10px !important;
            font-size: 1.1rem;
            color: #94a3b8;
            /* أيقونات هادئة */
        }

        .nav-link.active i {
            color: #10b981 !important;
        }

        /* 8. العناوين الجانبية (Headers) */
        .nav-header {
            color: #cbd5e1 !important;
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            padding: 1.5rem 2rem 0.5rem !important;
        }

        /* 9. تعديل منطقة المحتوى لتبدو "نظيفة" */
        .content-wrapper {
            background-color: #f8fafc !important;
        }

        /* 10. إحصائيات الصفحة الرئيسية (Stats) */
        .small-box {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 15px !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02) !important;
        }

        .small-box .inner p {
            color: #64748b;
        }

        .small-box h3 {
            color: #1e293b;
            font-weight: 700;
        }
    </style>

    @include('adminlte::plugins', ['type' => 'css'])
    @yield('adminlte_css')
</head>

<body class="sidebar-mini rtl {{ config('adminlte.classes_body') }}">
    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts (depends on Laravel asset bundling tool) --}}
    @if (config('adminlte.enabled_laravel_mix', false))
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @else
        @switch(config('adminlte.laravel_asset_bundling', false))
            @case('mix')
                <script src="{{ mix(config('adminlte.laravel_js_path', 'js/app.js')) }}"></script>
            @break

            @case('vite')
            @case('vite_js_only')
            @break

            @default
                <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
                <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
                <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
        @endswitch
    @endif

    {{-- Extra Configured Plugins Scripts --}}
    @include('adminlte::plugins', ['type' => 'js'])

    {{-- Livewire Script --}}
    @if (config('adminlte.livewire'))
        @if (intval(app()->version()) >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')
    <script>
        $(document).ready(function() {
            // إعادة تهيئة القائمة يدوياً لضمان عمل الـ Treeview
            $('[data-widget="treeview"]').Treeview('init');

            // إصلاح مشكلة عدم استجابة الروابط في بعض إصدارات RTL
            $('.nav-item > .nav-link').on('click', function(e) {
                if (!$(this).parent().hasClass('has-treeview')) {
                    // السماح بالانتقال للرابط إذا لم يكن قائمة منسدلة
                    return true;
                }
            });
        });
    </script>
</body>

</html>
