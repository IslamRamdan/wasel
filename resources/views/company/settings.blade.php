@extends('adminlte::page')

@section('title', 'إعدادات الحساب | الهوية الوطنية')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center py-4 px-3">
        <div>
            <h1 class="font-weight-bold saudi-title">إعدادات ملف الشركة</h1>
            <p class="text-muted mb-0">تحديث البيانات الرسمية وشعار المنشأة التشغيلي</p>
        </div>
        <div class="saudi-status-badge">
            <span class="dot"></span>
            حالة الحساب: {{ auth('company')->user()->status == 'active' ? 'نشط' : 'قيد المراجعة' }}
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid pb-5">
        <form action="{{ route('company.settings.update') }}" method="POST" enctype="multipart/form-data" class="saudi-form">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 saudi-main-card mb-4">
                        <div class="card-body p-4">
                            <h5 class="section-title mb-4">
                                <i class="fas fa-id-card-alt"></i> البيانات الأساسية والرسمية
                            </h5>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="saudi-label">اسم المنشأة</label>
                                    <div class="input-group-saudi">
                                        <i class="fas fa-building icon"></i>
                                        <input type="text" name="company_name" class="form-control"
                                            value="{{ $company->company_name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="saudi-label">رقم الترخيص (غير قابل للتعديل)</label>
                                    <div class="input-group-saudi disabled">
                                        <i class="fas fa-certificate icon"></i>
                                        <input type="text" class="form-control" value="{{ $company->license_number }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="saudi-label">البريد الإلكتروني الرسمي</label>
                                    <div class="input-group-saudi">
                                        <i class="fas fa-envelope icon"></i>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $company->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="saudi-label">رقم التواصل</label>
                                    <div class="input-group-saudi">
                                        <i class="fas fa-phone icon"></i>
                                        <input type="text" name="phone" class="form-control text-left"
                                            value="{{ $company->phone }}" dir="ltr">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="saudi-label">العنوان الوطني / المقر الرئيسي</label>
                                    <div class="input-group-saudi">
                                        <i class="fas fa-map-marker-alt icon mt-2"></i>
                                        <textarea name="address" class="form-control" rows="3">{{ $company->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 saudi-main-card">
                        <div class="card-body p-4">
                            <h5 class="section-title mb-4">
                                <i class="fas fa-shield-alt"></i> أمان الحساب
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="saudi-label">كلمة المرور الجديدة</label>
                                    <div class="input-group-saudi">
                                        <i class="fas fa-key icon"></i>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="أدخل كلمة مرور قوية">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="saudi-label">تأكيد كلمة المرور</label>
                                    <div class="input-group-saudi">
                                        <i class="fas fa-check-double icon"></i>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="أعد كتابة كلمة المرور">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 saudi-main-card mb-4">
                        <div class="card-body p-4 text-center">
                            <h5 class="section-title text-right mb-4">
                                <i class="fas fa-image"></i> هوية المنشأة
                            </h5>

                            <div class="logo-upload-wrapper">
                                <div class="preview-container mb-3 shadow-sm">
                                    <img id="logo_preview"
                                        src="{{ $company->logo ? Storage::url($company->logo) : 'https://cdn-icons-png.flaticon.com/512/300/300221.png' }}"
                                        alt="Logo">
                                    <label for="logoInput" class="btn-change-logo">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                </div>
                                <p class="text-muted small">يفضل استخدام صورة مربعة بجودة عالية (PNG/JPG)</p>
                                <input type="file" name="logo" id="logoInput" class="d-none" accept="image/*">
                            </div>

                            <hr class="my-4">

                            <button type="submit" class="btn btn-saudi-submit btn-block py-3 shadow-lg">
                                <i class="fas fa-check-circle ml-2"></i> اعتماد التغييرات
                            </button>
                        </div>
                    </div>

                    <div class="alert alert-soft-info border-0 p-3" style="border-radius: 12px;">
                        <small class="d-block mb-1 font-weight-bold"><i class="fas fa-lightbulb ml-1"></i> ملاحظة:</small>
                        <small class="d-block text-muted">سيتم تدقيق البيانات المحدثة من قبل الإدارة لضمان توافقها مع
                            معايير المنصة.</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('css')
    <style>
        :root {
            --saudi-green: #006C35;
            --saudi-gold: #D4AF37;
            --saudi-light-green: #ECFDF5;
            --saudi-dark-green: #004d26;
            --bg-body: #F4F7F6;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg-body) !important;
        }

        .saudi-title {
            color: #1e293b;
            font-size: 1.8rem;
            position: relative;
        }

        /* البطاقات */
        .saudi-main-card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03) !important;
            transition: 0.3s ease;
        }

        .saudi-main-card:hover {
            transform: translateY(-5px);
        }

        /* عناوين الأقسام */
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--saudi-green);
            border-right: 4px solid var(--saudi-gold);
            padding-right: 12px;
        }

        /* الحقول المتطورة */
        .saudi-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 8px;
            display: block;
        }

        .input-group-saudi {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-saudi .icon {
            position: absolute;
            right: 15px;
            color: #94a3b8;
            font-size: 1rem;
            z-index: 5;
        }

        .input-group-saudi .form-control {
            padding: 12px 45px 12px 15px;
            height: auto;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #334155;
            font-weight: 600;
            transition: 0.3s;
        }

        .input-group-saudi .form-control:focus {
            border-color: var(--saudi-green);
            box-shadow: 0 0 0 4px rgba(0, 108, 53, 0.08);
        }

        .input-group-saudi.disabled .form-control {
            background-color: #f8fafc;
            color: #64748b;
        }

        /* رفع الشعار */
        .preview-container {
            width: 140px;
            height: 140px;
            margin: 0 auto;
            position: relative;
            border: 4px solid #fff;
            border-radius: 50%;
            background: #f1f5f9;
        }

        .preview-container img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-change-logo {
            position: absolute;
            bottom: 5px;
            left: 5px;
            background: var(--saudi-green);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 3px solid #fff;
            transition: 0.3s;
        }

        .btn-change-logo:hover {
            background: var(--saudi-gold);
            transform: scale(1.1);
        }

        /* زر الحفظ */
        .btn-saudi-submit {
            background: linear-gradient(45deg, var(--saudi-green), var(--saudi-dark-green));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .btn-saudi-submit:hover {
            box-shadow: 0 8px 20px rgba(0, 108, 53, 0.3);
            transform: translateY(-2px);
            color: #fff;
        }

        /* شارة الحالة */
        .saudi-status-badge {
            background: var(--saudi-light-green);
            color: #065f46;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .saudi-status-badge .dot {
            height: 8px;
            width: 8px;
            background-color: #10b981;
            border-radius: 50%;
            display: inline-block;
            margin-left: 8px;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        .alert-soft-info {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap');
    </style>
@stop

@section('js')
    <script>
        document.getElementById('logoInput').onchange = function(evt) {
            var [file] = this.files;
            if (file) {
                document.getElementById('logo_preview').src = URL.createObjectURL(file);
            }
        }
    </script>
@stop
