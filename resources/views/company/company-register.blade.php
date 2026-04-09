@extends('adminlte::master')

@section('adminlte_css')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            background-color: #ffffff;
        }

        .main-wrapper {
            height: 100vh;
            display: flex;
            flex-direction: row-reverse;
        }

        /* الجانب الأيمن: الصورة مع تحسين التدرج */
        .side-img {
            flex: 1.2;
            background-image: url('{{ asset('image/bus-saudi.webp') }}');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .side-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, #ffffff 0%, rgba(255, 255, 255, 0) 25%, rgba(0, 0, 0, 0.4) 100%);
        }

        .form-section {
            flex: 0.8;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            padding: 1rem;
        }

        /* حقول إدخال رشيقة */
        .compact-input {
            transition: all 0.2s ease;
            border: 1px solid #f1f5f9;
            background-color: #f8fafc;
            padding: 0.55rem 0.75rem !important;
            font-size: 0.75rem !important;
            border-radius: 0.75rem !important;
        }

        .compact-input:focus {
            border-color: #6366f1;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            outline: none;
        }

        /* إخفاء السكرول بار في التكست أريا */
        textarea.compact-input {
            resize: none;
            overflow: hidden;
        }
    </style>
@stop

@section('body')
    <div class="main-wrapper">

        <div class="hidden md:flex side-img relative">
            <div class="side-overlay"></div>
            <div class="relative z-10 flex flex-col justify-end p-12 text-white text-right w-full">
                <h2 class="text-3xl font-black mb-1 drop-shadow-lg tracking-tight">شريكك اللوجستي</h2>
                <p class="text-[12px] font-medium text-slate-100 opacity-90 max-w-xs ml-auto leading-relaxed">
                    حلول نقل ذكية متكاملة لخدمة قطاع السياحة بالمملكة.
                </p>
            </div>
        </div>

        <div class="form-section">
            <div class="w-full max-w-[340px]">
                <div class="mb-2 text-right flex flex-col items-end">
                    <img src="{{ asset('image/logo.png') }}" alt="واصل" class="h-9 w-auto object-contain">
                    <div class="h-0.5 w-8 bg-orange-500 mt-1 rounded-full"></div>
                </div>

                <div class="mb-3 text-right">
                    <h2 class="text-lg font-black text-slate-800 leading-none">تسجيل منشأة</h2>
                    <p class="text-slate-400 text-[10px] font-bold mt-1.5">أدخل بيانات الشركة للبدء</p>
                </div>

                <form action="{{ route('company.register.submit') }}" method="post" enctype="multipart/form-data"
                    class="space-y-3">
                    @csrf

                    <div class="grid grid-cols-2 gap-2 text-right">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-500 mr-1 uppercase">اسم الشركة</label>
                            <input type="text" name="company_name" placeholder="واصل" required
                                class="compact-input w-full">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-500 mr-1 uppercase">الترخيص</label>
                            <input type="text" name="license_number" placeholder="xxx" required
                                class="compact-input w-full">
                        </div>
                    </div>

                    <div class="space-y-1 text-right">
                        <label class="text-[10px] font-bold text-slate-500 mr-1 uppercase">البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="corp@wasel.sa" class="compact-input w-full">
                    </div>

                    <div class="space-y-1 text-right">
                        <label class="text-[10px] font-bold text-slate-500 mr-1 uppercase">رقم الجوال</label>
                        <input type="text" name="phone" placeholder="05xxxxxxxx" class="compact-input w-full">
                    </div>

                    <div class="space-y-1 text-right">
                        <label class="text-[10px] font-bold text-slate-500 mr-1 uppercase">مقر الإدارة</label>
                        <textarea name="address" rows="1" placeholder="المدينة، الشارع..." class="compact-input w-full"></textarea>
                    </div>

                    <div class="space-y-1 text-right">
                        <label class="text-[10px] font-bold text-slate-500 mr-1 uppercase">كلمة المرور</label>
                        <input type="password" name="password" placeholder="••••••••" required class="compact-input w-full">
                    </div>

                    <div
                        class="group relative py-2 border border-dashed border-slate-200 rounded-xl bg-slate-50 hover:bg-indigo-50/50 transition-colors text-center cursor-pointer">
                        <input type="file" name="logo" class="absolute inset-0 opacity-0 cursor-pointer">
                        <p class="text-[9px] font-bold text-slate-400 flex items-center justify-center gap-1">
                            <span class="fas fa-camera"></span> تحميل شعار المنشأة
                        </p>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs rounded-xl shadow-md transition-all active:scale-95">
                        إنشاء الحساب
                    </button>
                </form>

                <div class="mt-4 text-center border-t border-slate-50 pt-3">
                    <p class="text-slate-400 font-bold text-[10px]">
                        لديك حساب؟
                        <a href="{{ route('company.login') }}"
                            class="text-indigo-600 font-black hover:text-orange-500 transition-colors">دخول</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
