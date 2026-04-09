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

        /* الجانب الأيمن (الصورة) */
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
            padding: 2rem;
        }

        .compact-input {
            transition: all 0.2s ease;
            border: 1px solid #f1f5f9;
            background-color: #f8fafc;
            padding: 0.75rem 1rem !important;
            font-size: 0.85rem !important;
            border-radius: 0.75rem !important;
        }

        .compact-input:focus {
            border-color: #6366f1;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }
    </style>
@stop

@section('body')
    <div class="main-wrapper">

        <div class="hidden md:flex side-img">
            <div class="side-overlay"></div>
            <div class="relative z-10 flex flex-col justify-end p-16 text-white text-right w-full">
                <h2 class="text-4xl font-black mb-2 drop-shadow-lg">مرحباً بعودتك</h2>
                <p class="text-sm font-medium text-slate-100 opacity-90 max-w-xs ml-auto leading-relaxed">
                    سجل دخولك لمتابعة إدارة أسطولك والتحكم في رحلاتك بكل سهولة.
                </p>
            </div>
        </div>

        <div class="form-section">
            <div class="w-full max-w-[350px]">

                <div class="mb-8 text-right flex flex-col items-end">
                    <img src="{{ asset('image/logo.png') }}" alt="واصل" class="h-10 w-auto object-contain">
                    <div class="h-1 w-10 bg-orange-500 mt-2 rounded-full"></div>
                </div>

                <div class="mb-8 text-right">
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">تسجيل الدخول</h2>
                    <p class="text-slate-400 text-xs font-bold mt-2 italic text-indigo-600">لوحة تحكم الشركات</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border-r-4 border-red-500 rounded-lg">
                        <p class="text-[11px] font-bold text-red-600 text-right">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form action="{{ route('company.login.submit') }}" method="post" class="space-y-5">
                    @csrf

                    <div class="space-y-2 text-right">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider mr-1">البريد الإلكتروني
                            أو الترخيص</label>
                        <input type="text" name="email" placeholder="example@wasel.sa" required
                            class="compact-input w-full text-right" dir="ltr">
                    </div>

                    <div class="space-y-2 text-right">
                        <div class="flex justify-between items-center px-1">
                            <a href="#" class="text-[10px] font-bold text-indigo-400 hover:text-orange-500">نسيت كلمة
                                المرور؟</a>
                            <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">كلمة
                                المرور</label>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required
                            class="compact-input w-full text-right" dir="ltr">
                    </div>

                    <div class="flex items-center justify-end gap-2 px-1">
                        <label class="text-[11px] font-bold text-slate-400 cursor-pointer" for="remember">تذكرني</label>
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-slate-200 text-indigo-600 focus:ring-indigo-500">
                    </div>

                    <button type="submit"
                        class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-sm rounded-xl shadow-lg shadow-indigo-100 transition-all active:scale-[0.97]">
                        دخول للمنصة
                    </button>
                </form>

                <div class="mt-8 text-center border-t border-slate-50 pt-6">
                    <p class="text-slate-400 font-bold text-xs">
                        ليس لديك حساب منشأة؟
                        <a href="{{ route('company.register') }}"
                            class="text-indigo-600 font-black hover:text-orange-500 transition-colors underline-offset-4 decoration-2 hover:underline">سجل
                            الآن</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
