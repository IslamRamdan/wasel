<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-light-emerald elevation-0') }}">

    {{-- 1. شعار البراند --}}
    @if (config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- 2. محتوى السايد بار --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if (config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                @if (!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>

                {{-- هنا يتم استدعاء الروابط بشكل صحيح داخل القائمة --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')

            </ul>
        </nav>
    </div>

</aside>

<style>
    /* رفع السايد بار فوق أي طبقة شفافة */
    .main-sidebar {
        z-index: 1050 !important;
        /* السماح بمرور النقرات للعناصر الداخلية */
        pointer-events: all !important;
    }

    /* إخفاء الطبقة التي تغطي الشاشة في الموبايل إذا ظهرت بالخطأ في الديسكتوب */
    @media (min-width: 992px) {
        #sidebar-overlay {
            display: none !important;
        }
    }

    .nav-link {
        margin: 0 !important;
    }
</style>
