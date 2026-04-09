@extends('adminlte::page')

@section('title', 'الخدمات التشغيلية | الهوية السعودية')

@section('content_header')
    <div class="py-4 px-3">
        <h1 class="font-weight-bold text-dark" style="font-family: 'Cairo', sans-serif;">الخدمات التشغيلية المركزية</h1>
        <p class="text-muted">اختر القسم المطلوب لإدارة العمليات اليومية</p>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('company.full-trip') }}" class="saudi-service-card text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="icon-wrapper mx-auto mb-4 bg-soft-green">
                            <i class="fas fa-sync-alt fa-3x text-saudi-green"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark">دورة كاملة</h4>
                        <p class="text-muted small px-2">إدارة البرامج المتكاملة من البداية وحتى النهاية</p>
                        <div class="card-footer-link">
                            <span>دخول القسم</span> <i class="fas fa-chevron-left mr-2"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <a href="#" class="saudi-service-card text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="icon-wrapper mx-auto mb-4 bg-soft-gold">
                            <i class="fas fa-map-marked-alt fa-3x text-saudi-gold"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark">مزارات</h4>
                        <p class="text-muted small px-2">تنظيم الجولات السياحية والدينية والمواقع التاريخية</p>
                        <div class="card-footer-link">
                            <span>دخول القسم</span> <i class="fas fa-chevron-left mr-2"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <a href="#" class="saudi-service-card text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="icon-wrapper mx-auto mb-4 bg-soft-blue">
                            <i class="fas fa-bus-alt fa-3x text-saudi-blue"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark">خطوط</h4>
                        <p class="text-muted small px-2">إدارة مسارات النقل البري بين المدن والمحطات</p>
                        <div class="card-footer-link">
                            <span>دخول القسم</span> <i class="fas fa-chevron-left mr-2"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <a href="#" class="saudi-service-card text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="icon-wrapper mx-auto mb-4 bg-soft-red">
                            <i class="fas fa-plane-arrival fa-3x text-saudi-red"></i>
                        </div>
                        <h4 class="font-weight-bold text-dark">استقبال ومغادرة</h4>
                        <p class="text-muted small px-2">متابعة حركة المطارات والخدمات اللوجستية للركاب</p>
                        <div class="card-footer-link">
                            <span>دخول القسم</span> <i class="fas fa-chevron-left mr-2"></i>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@stop

@section('css')
    <style>
        :root {
            --saudi-green: #006C35;
            --saudi-gold: #D4AF37;
            --saudi-blue: #2563eb;
            --saudi-red: #dc2626;
            --bg-light: #f8fafc;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg-light) !important;
        }

        /* ستايل المربع الرئيسي */
        .saudi-service-card .card {
            border-radius: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.02) !important;
        }

        .saudi-service-card:hover .card {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08) !important;
            border-color: var(--saudi-green) !important;
        }

        /* حاوية الأيقونة */
        .icon-wrapper {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: 0.3s;
        }

        .saudi-service-card:hover .icon-wrapper {
            transform: scale(1.1);
        }

        /* ألوان الخلفيات الناعمة للأيقونات */
        .bg-soft-green {
            background-color: #ecfdf5;
        }

        .bg-soft-gold {
            background-color: #fffbeb;
        }

        .bg-soft-blue {
            background-color: #eff6ff;
        }

        .bg-soft-red {
            background-color: #fef2f2;
        }

        /* ألوان الأيقونات */
        .text-saudi-green {
            color: var(--saudi-green);
        }

        .text-saudi-gold {
            color: var(--saudi-gold);
        }

        .text-saudi-blue {
            color: var(--saudi-blue);
        }

        .text-saudi-red {
            color: var(--saudi-red);
        }

        /* الرابط السفلي */
        .card-footer-link {
            margin-top: 20px;
            font-weight: 700;
            color: var(--saudi-green);
            font-size: 0.9rem;
            opacity: 0.7;
            transition: 0.3s;
        }

        .saudi-service-card:hover .card-footer-link {
            opacity: 1;
            letter-spacing: 0.5px;
        }

        h4 {
            margin-top: 10px;
            color: #1e293b;
            letter-spacing: -0.5px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
    </style>
@stop
