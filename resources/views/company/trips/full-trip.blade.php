@extends('adminlte::page')

@section('title', 'بوابة حجز واصل')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 text-center">
                <h1 class="m-0 text-success font-weight-bold">نموذج حجز خدمات واصل</h1>
                <p class="text-muted">يرجى تعبئة كافة البيانات المطلوبة لإتمام عملية الحجز</p>
            </div>
        </div>
    </div>
@stop

@section('content')
    {{-- رسالة النجاح --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
            style="border-radius: 15px;">
            <i class="fas fa-check-circle mr-2"></i>
            <strong>تمت العملية!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- رسالة الخطأ --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
            style="border-radius: 15px;">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <strong>عذراً!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- أخطاء التحقق من البيانات (Validation Errors) --}}
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
            style="border-radius: 15px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-info-circle mr-2"></i> {{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ route('bookings.store') }}" method="POST" id="fullBookingForm">
        @csrf

        <div class="row justify-content-center">
            <div class="col-md-11">

                <div class="card card-outline card-success shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title text-bold"><i class="fas fa-user-tie mr-2"></i> 1. البيانات الأساسية للمشرف
                            والرحلة</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>اسم المشرف <span class="text-danger">*</span></label>
                                <input type="text" name="supervisor_name" class="form-control"
                                    placeholder="الاسم الرباعي" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>رقم الجوال (سعودي) <span class="text-danger">*</span></label>
                                <input type="text" name="supervisor_phone_sa" class="form-control text-left"
                                    dir="ltr" placeholder="+966" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>رقم التواصل (مصري) <span class="text-danger">*</span></label>
                                <input type="text" name="supervisor_phone_eg" class="form-control text-left"
                                    dir="ltr" placeholder="+20" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>الشركة السعودية المسؤولة <span class="text-danger">*</span></label>
                                <input type="text" name="company" class="form-control" placeholder="اسم الشركة" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>اسم الوكيل الخارجي</label>
                                <input type="text" name="external_agent_name" class="form-control"
                                    placeholder="اسم الوكيل">
                            </div>

                            <div class="form-group col-md-4">
                                <label>بلد الوكيل</label>
                                <input type="text" name="agent_country" class="form-control"
                                    placeholder="مثال: مصر، الأردن...">
                            </div>

                            <div class="form-group col-md-6">
                                <label>نوع الحافلة (السعة)</label>
                                <select id="bus_type" name="bus_type" class="form-control select2">
                                    <option value="">اختر نوع الحافلة...</option>
                                    <option value="50">حافلة كبرى (50 راكب)</option>
                                    <option value="32">حافلة متوسطة (32 راكب)</option>
                                    <option value="27">حافلة صغيرة (27 راكب)</option>
                                    <option value="8">فان عائلي (8 ركاب)</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>عدد الركاب</label>
                                <input type="number" id="passengers" name="passengers" class="form-control" placeholder="0"
                                    min="1">
                            </div>

                            <div class="form-group col-md-3">
                                <label>عدد الحافلات</label>
                                <input type="number" id="buses" name="buses" class="form-control" placeholder="0">
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const passengersInput = document.getElementById('passengers');
                                    const busTypeSelect = document.getElementById('bus_type');
                                    const busesInput = document.getElementById('buses');

                                    function calculateBuses() {
                                        const passengers = parseInt(passengersInput.value);
                                        const capacity = parseInt(busTypeSelect.value);

                                        if (passengers > 0 && capacity > 0) {
                                            // استخدام Math.ceil لتقريب النتيجة لأقرب عدد صحيح للأعلى
                                            // مثلاً: 51 راكب / 50 سعة = 1.02، التقريب يجعلها حافلتين
                                            const result = Math.ceil(passengers / capacity);
                                            busesInput.value = result;
                                        } else {
                                            busesInput.value = 0;
                                        }
                                    }

                                    // الاستماع للتغيير في عدد الركاب
                                    passengersInput.addEventListener('input', calculateBuses);

                                    // الاستماع للتغيير في نوع الحافلة (يدعم Select2)
                                    // إذا كنت تستخدم مكتبة Select2، يفضل استخدام التابع الخاص بها
                                    if (typeof jQuery !== 'undefined' && jQuery().select2) {
                                        jQuery('#bus_type').on('select2:select', calculateBuses);
                                    } else {
                                        busTypeSelect.addEventListener('change', calculateBuses);
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="card card-outline card-success shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title text-bold"><i class="fas fa-plane mr-2"></i> 3. تفاصيل حركات الوصول
                            والمغادرة
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-info card-outline">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title font-weight-bold"><i class="fas fa-plane-arrival"></i>
                                            بيانات
                                            الاستقبال</h3>
                                        <button type="button" class="btn btn-xs btn-info ml-auto" id="addArrivalFlight">
                                            <i class="fas fa-plus"></i> إضافة رحلة
                                        </button>
                                    </div>
                                    <div class="card-body" id="arrival_flights_container">
                                        <div class="arrival-flight-row border-bottom pb-3 mb-3">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="small">شركة الطيران</label>
                                                    <input type="text" name="arrival_airline[]"
                                                        class="form-control form-control-sm"
                                                        placeholder="مثلاً: الخطوط السعودية">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="small">رقم الرحلة</label>
                                                    <input type="text" name="arrival_flight_no[]"
                                                        class="form-control form-control-sm" placeholder="SV123">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="small">قادمة من مطار</label>
                                                    <input type="text" name="arrival_from_airport[]"
                                                        class="form-control form-control-sm" placeholder="مطار القاهرة">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="small">الصالة</label>
                                                    <input type="text" name="arrival_terminal[]"
                                                        class="form-control form-control-sm" placeholder="H1">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="small">مطار الوصول (السعودية)</label>
                                                    <select name="arrival_to_sa_airport[]"
                                                        class="form-control form-control-sm">
                                                        <option>جدة</option>
                                                        <option>المدينة</option>
                                                        <option>ينبع</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label class="small">تاريخ الاستقبال</label>
                                                    <input type="date" name="arrival_date[]"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label class="small">الساعة</label>
                                                    <input type="time" name="arrival_time[]"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <label class="small">&nbsp;</label>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm btn-block remove-flight-row">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-warning card-outline">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3 class="card-title font-weight-bold text-warning"><i
                                                class="fas fa-plane-departure"></i> بيانات التوديع</h3>
                                        <button type="button" class="btn btn-xs btn-warning ml-auto"
                                            id="addDepartureFlight">
                                            <i class="fas fa-plus"></i> إضافة رحلة
                                        </button>
                                    </div>
                                    <div class="card-body" id="departure_flights_container">
                                        <div class="departure-flight-row border-bottom pb-3 mb-3">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="small">شركة الطيران</label>
                                                    <input type="text" name="departure_airline[]"
                                                        class="form-control form-control-sm"
                                                        placeholder="مثلاً: مصر للطيران">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="small">رقم الرحلة</label>
                                                    <input type="text" name="departure_flight_no[]"
                                                        class="form-control form-control-sm" placeholder="MS600">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="small">مطار المغادرة (السعودية)</label>
                                                    <select name="departure_from_sa_airport[]"
                                                        class="form-control form-control-sm">
                                                        <option>جدة</option>
                                                        <option>المدينة</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="small">الصالة</label>
                                                    <input type="text" name="departure_terminal[]"
                                                        class="form-control form-control-sm" placeholder="1">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="small">متوجهة إلى</label>
                                                    <input type="text" name="departure_to_airport[]"
                                                        class="form-control form-control-sm" placeholder="مطار دبي">
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label class="small">تاريخ المغادرة</label>
                                                    <input type="date" name="departure_date[]"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label class="small">الساعة</label>
                                                    <input type="time" name="departure_time[]"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <label class="small">&nbsp;</label>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm btn-block remove-flight-row">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-outline card-success shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title text-bold"><i class="fas fa-hotel mr-2"></i> 2. تفاصيل الإقامة (مكة
                            والمدينة)</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h5 class="text-success font-weight-bold mb-0">فنادق مكة المكرمة</h5>
                                    <button type="button" class="btn btn-xs btn-outline-success"
                                        id="add_makkah_hotel_btn">
                                        <i class="fas fa-plus"></i> إضافة فندق بمكة
                                    </button>
                                </div>

                                <div id="makkah_hotels_container">
                                    <div class="makkah-hotel-group bg-light p-2 mb-3 border rounded">
                                        <div class="form-group">
                                            <label>اسم الفندق</label>
                                            <input type="text" name="makkah_hotel_name[]"
                                                class="form-control form-control-sm" placeholder="مثال: فندق برج الساعة">
                                        </div>
                                        <div class="form-group">
                                            <label>عنوان الفندق / الموقع</label>
                                            <input type="text" name="makkah_hotel_address[]"
                                                class="form-control form-control-sm"
                                                placeholder="مثال: أجياد، مقابل باب الملك عبد العزيز">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>تاريخ الدخول</label>
                                                <input type="date" name="makkah_checkin[]" id="makkah_checkin_1"
                                                    class="form-control form-control-sm makkah-checkin">
                                            </div>
                                            <div class="col-6">
                                                <label>تاريخ الخروج</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="date" name="makkah_checkout[]" id="makkah_checkout_1"
                                                        class="form-control makkah-checkout">
                                                    <div class="input-group-append remove-hotel-btn"
                                                        style="display:none;">
                                                        <button class="btn btn-danger" type="button"><i
                                                                class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h5 class="text-primary font-weight-bold mb-0">فنادق المدينة المنورة</h5>
                                    <button type="button" class="btn btn-xs btn-outline-primary"
                                        id="add_madinah_hotel_btn">
                                        <i class="fas fa-plus"></i> إضافة فندق بالمدينة
                                    </button>
                                </div>

                                <div id="madinah_hotels_container">
                                    <div class="madinah-hotel-group bg-light p-2 mb-3 border rounded">
                                        <div class="form-group">
                                            <label>اسم الفندق</label>
                                            <input type="text" name="madinah_hotel_name[]"
                                                class="form-control form-control-sm"
                                                placeholder="مثال: فندق أنوار المدينة">
                                        </div>
                                        <div class="form-group">
                                            <label>عنوان الفندق / الموقع</label>
                                            <input type="text" name="madinah_hotel_address[]"
                                                class="form-control form-control-sm"
                                                placeholder="مثال: المنطقة المركزية الشمالية">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>تاريخ الدخول</label>
                                                <input type="date" name="madinah_checkin[]" id="madinah_checkin_1"
                                                    class="form-control form-control-sm madinah-checkin">
                                            </div>
                                            <div class="col-6">
                                                <label>تاريخ الخروج</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="date" name="madinah_checkout[]"
                                                        id="madinah_checkout_1" class="form-control madinah-checkout">
                                                    <div class="input-group-append remove-hotel-btn"
                                                        style="display:none;">
                                                        <button class="btn btn-danger" type="button"><i
                                                                class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-outline card-success shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-bold"><i class="fas fa-bus mr-2"></i> 4. جدول التنقلات الداخلية</h3>
                        <button type="button" class="btn btn-sm btn-success ml-auto" id="addTransferBtn"><i
                                class="fas fa-plus"></i> إضافة رحلة</button>
                    </div>
                    <div class="card-body">
                        <div id="transfers_container">
                            <div class="row bg-light p-3 mb-2 rounded border transfer-row">
                                <div class="col-md-3">
                                    <label class="small text-muted font-weight-bold">من</label>
                                    <select name="from[]" class="form-control form-control-sm">
                                        <option>مكة</option>
                                        <option>المدينة</option>
                                        <option>جدة</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="small text-muted font-weight-bold">إلى</label>
                                    <select name="to[]" class="form-control form-control-sm">
                                        <option>المدينة</option>
                                        <option>مكة</option>
                                        <option>جدة</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="small text-muted font-weight-bold">التاريخ</label>
                                    <input type="date" name="transfer_date[]" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                    <label class="small text-muted font-weight-bold">الوقت</label>
                                    <input type="time" name="transfer_time[]" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-1">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-sm btn-block remove-row"><i
                                            class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-outline card-warning shadow-sm mb-5">
                    <div class="card-header py-2">
                        <h3 class="card-title text-bold small"><i class="fas fa-map-marked-alt mr-1"></i> 5. تحديد أيام
                            المزارات</h3>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <p class="text-success font-weight-bold mb-2 small"><i class="fas fa-kaaba"></i> مكة
                                    المكرمة</p>
                                <div id="makkah_days_selection" class="day-grid-container">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <p class="text-primary font-weight-bold mb-2 small"><i class="fas fa-mosque"></i> المدينة
                                    المنورة</p>
                                <div id="madinah_days_selection" class="day-grid-container">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white py-2">
                        <button type="submit" class="btn btn-success btn-block font-weight-bold shadow-sm">
                            إتمام وحفظ البيانات <i class="fas fa-save ml-1"></i>
                        </button>
                    </div>
                </div>

                <style>
                    .day-grid {
                        display: grid;
                        grid-template-columns: repeat(5, 1fr);
                        gap: 5px;
                        margin-bottom: 10px;
                    }

                    .day-item {
                        position: relative;
                        text-align: center;
                    }

                    /* إخفاء دائرة الراديو الأصلية */
                    .day-item input[type="radio"] {
                        display: none;
                    }

                    /* تصميم الزر */
                    .day-item label {
                        display: block;
                        padding: 5px 2px;
                        background: #f8f9fa;
                        border: 1px solid #ddd;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 11px;
                        transition: all 0.2s;
                        margin-bottom: 0;
                    }

                    /* لون الزر عند الاختيار */
                    .day-item input[type="radio"]:checked+label {
                        background: #28a745;
                        color: white;
                        border-color: #1e7e34;
                        font-weight: bold;
                    }

                    .hotel-label {
                        font-size: 10px;
                        color: #555;
                        margin-bottom: 3px;
                        display: block;
                        background: #e9ecef;
                        padding: 2px 8px;
                        border-radius: 3px;
                        border-right: 3px solid #28a745;
                    }
                </style>

            </div>
        </div>
    </form>
@endsection

@section('css')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            transition: 0.3s;
        }

        .card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, .05);
        }

        .form-control {
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, .1);
        }

        label {
            color: #495057;
            font-size: 0.9rem;
        }

        .border-right {
            border-right: 1px solid #eee !important;
        }

        @media (max-width: 768px) {
            .border-right {
                border-right: none !important;
                border-bottom: 1px solid #eee;
                padding-bottom: 15px;
                margin-bottom: 15px;
            }
        }
    </style>
    {{-- <style>
        /* تنسيق السايد بار */
        .main-sidebar {
            background-color: #1a2226 !important;
            /* لون داكن فخم */
        }

        /* تنسيق العناصر النشطة (Active) */
        .nav-sidebar .nav-link.active {
            background-color: #28a745 !important;
            /* اللون الأخضر الخاص بواصل */
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3) !important;
            border-radius: 8px;
            margin: 5px 10px;
        }

        /* تأثير عند تمرير الماوس */
        .nav-sidebar .nav-link:hover {
            background-color: rgba(40, 167, 69, 0.1) !important;
            color: #28a745 !important;
            border-radius: 8px;
        }

        /* تنسيق اسم الشركة أو اللوجو */
        .brand-link {
            border-bottom: 1px solid #4b545c !important;
            padding: 15px !important;
            text-align: center;
        }

        .brand-text {
            font-weight: bold !important;
            letter-spacing: 1px;
        }

        /* تنسيق المسافات بين الأيقونات والنص في العربي */
        .nav-sidebar .nav-link>p {
            margin-right: 10px;
            /* مسافة للأيقونة من اليمين */
        }

        /* إخفاء السكرول بار لجعل الشكل أنظف */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #343a40;
        }
    </style> --}}
    {{-- <style>
        body {
            font-family: 'Cairo', sans-serif !important;
        }

        /* تحسين شكل سايد بار AdminLTE ليتناسب مع واصل */
        .main-sidebar {
            background-color: #1e1b4b !important;
        }

        .content-wrapper {
            background-color: #f8fafc !important;
        }

        .nav-link.active {
            background-color: #4f46e5 !important;
            border-radius: 12px !important;
            margin: 0 8px !important;
        }
    </style> --}}
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // إضافة صف جديد في التنقلات
            $('#addTransferBtn').click(function() {
                let newRow = $('.transfer-row:first').clone();
                newRow.find('input').val(''); // مسح القيم القديمة
                $('#transfers_container').append(newRow);
            });

            // حذف صف
            $(document).on('click', '.remove-row', function() {
                if ($('.transfer-row').length > 1) {
                    $(this).closest('.transfer-row').fadeOut(300, function() {
                        $(this).remove();
                    });
                } else {
                    alert('يجب وجود رحلة واحدة على الأقل');
                }
            });

            // تفعيل الـ Select2 إذا كانت متوفرة
            if ($.fn.select2) {
                $('.select2').select2({
                    theme: 'bootstrap4',
                    dir: 'rtl'
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            // 1. إضافة رحلة وصول
            $('#addArrivalFlight').click(function() {
                // نأخذ نسخة من أول صف
                let newRow = $('.arrival-flight-row:first').clone();
                // نصفر المدخلات في النسخة الجديدة
                newRow.find('input').val('');
                // نلغي خاصية التعطيل إن وجدت
                newRow.find('.remove-flight-row').removeClass('disabled');
                // نضيفها للحاوية
                $('#arrival_flights_container').append(newRow);
            });

            // 2. إضافة رحلة مغادرة
            $('#addDepartureFlight').click(function() {
                let newRow = $('.departure-flight-row:first').clone();
                newRow.find('input').val('');
                newRow.find('.remove-flight-row').removeClass('disabled');
                $('#departure_flights_container').append(newRow);
            });

            // 3. حذف الرحلة (وصول أو مغادرة) - الربط الديناميكي
            $(document).on('click', '.remove-flight-row', function() {
                // تحديد الحاوية الأب (هل نحن في وصول أم مغادرة؟)
                let container = $(this).closest('.card-body');
                // تحديد نوع الصف (arrival-flight-row أو departure-flight-row)
                let rowClass = container.attr('id') === 'arrival_flights_container' ?
                    '.arrival-flight-row' : '.departure-flight-row';

                // التحقق من عدد الصفوف المتبقية
                if (container.find(rowClass).length > 1) {
                    $(this).closest(rowClass).fadeOut(300, function() {
                        $(this).remove();
                    });
                } else {
                    // تنبيه اختياري: لا يمكن حذف آخر رحلة
                    alert("يجب أن يحتوي الحجز على رحلة واحدة على الأقل.");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            // وظيفة عامة لإضافة مجموعة فندق جديد
            function addNewHotel(city) {
                let container = $(`#${city}_hotels_container`);
                let count = container.find(`.${city}-hotel-group`).length + 1;

                // نسخ المجموعة الأولى
                let newGroup = container.find(`.${city}-hotel-group:first`).clone();

                // تفريغ القيم وتحديث الـ IDs
                newGroup.find('input').val('');
                newGroup.find(`.${city}-checkin`).attr('id', `${city}_checkin_${count}`);
                newGroup.find(`.${city}-checkout`).attr('id', `${city}_checkout_${count}`);

                // إظهار زر الحذف في المجموعات المضافة فقط
                newGroup.find('.remove-hotel-btn').show();

                container.append(newGroup);
            }

            // أزرار الإضافة
            $('#add_makkah_hotel_btn').click(function() {
                addNewHotel('makkah');
            });
            $('#add_madinah_hotel_btn').click(function() {
                addNewHotel('madinah');
            });

            // وظيفة الحذف
            $(document).on('click', '.remove-hotel-btn', function() {
                $(this).closest('[class*="-hotel-group"]').fadeOut(300, function() {
                    $(this).remove();
                });
            });

            // مثال لما يمكنك فعله بالـ IDs (تنبيه عند تغيير التاريخ مثلاً)
            $(document).on('change', '[id^="makkah_checkin_"]', function() {
                let currentId = $(this).attr('id');
                console.log("تم تغيير تاريخ الدخول في مكة للفندق رقم: " + currentId.split('_').pop());
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            function renderSingleDaySelection(city) {
                let container = $(`#${city}_days_selection`);
                container.empty();

                // نمر على كل فندق تم إضافته في قسم الإقامة
                $(`input[name^="${city}_checkin"]`).each(function(index) {
                    let checkin = $(this).val();
                    let checkout = $(`input[name^="${city}_checkout"]`).eq(index).val();
                    let hotelName = $(`input[name^="${city}_hotel_name"]`).eq(index).val() ||
                        `فندق ${index + 1}`;

                    if (checkin && checkout) {
                        let startDate = new Date(checkin);
                        let endDate = new Date(checkout);
                        let dates = [];

                        for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                            dates.push(new Date(d).toISOString().split('T')[0]);
                        }

                        // عنوان الفندق
                        container.append(`<span class="hotel-label">${hotelName}</span>`);

                        // حاوية الأيام بنظام الـ 5 أعمدة
                        let gridHtml = '<div class="day-grid">';

                        dates.forEach((date, i) => {
                            if (i > 0 && i % 5 === 0) {
                                gridHtml += '</div><div class="day-grid">';
                            }

                            let displayDate = date.substring(5).replace('-',
                                '/'); // عرض الشهر/اليوم فقط

                            // استخدام radio بدلاً من checkbox 
                            // الـ name يحتوي على الـ index لضمان أن كل فندق له اختيار واحد مستقل
                            gridHtml += `
                        <div class="day-item">
                            <input type="radio" 
                                   name="${city}_visit_day_hotel_${index}" 
                                   value="${date}" 
                                   id="rad_${city}_${index}_${date}">
                            <label for="rad_${city}_${index}_${date}" title="${date}">
                                ${displayDate}
                            </label>
                        </div>`;
                        });

                        gridHtml += '</div>';
                        container.append(gridHtml);
                    }
                });

                if (container.is(':empty')) {
                    container.append('<p class="text-muted small text-center">أدخل تواريخ الفنادق أولاً</p>');
                }
            }

            // التحديث التلقائي عند تغيير تواريخ الفنادق
            $(document).on('change', 'input[name*="checkin"], input[name*="checkout"], input[name*="hotel_name"]',
                function() {
                    renderSingleDaySelection('makkah');
                    renderSingleDaySelection('madinah');
                });
        });
    </script>
    <script>
        // async function fetchFlightHistory(flightNumber) {
        //     const url = `/get-flight-data/${flightNumber}`;

        //     // الأوفست (جدة +3، القاهرة +2)
        //     const JED_OFFSET = 3;
        //     const CAI_OFFSET = 2;

        //     try {
        //         const response = await fetch(url);
        //         const html = await response.text();
        //         const parser = new DOMParser();
        //         const doc = parser.parseFromString(html, 'text/html');
        //         const rows = Array.from(doc.querySelectorAll('tr.data-row'));

        //         const flights = rows.map(row => {
        //             // دالة التحويل الآمنة
        //             const convertToLocal = (timeStr, offset) => {
        //                 // التأكد إن النص موجود وفيه علامة ":" عشان ميعملش Error
        //                 if (!timeStr || typeof timeStr !== 'string' || !timeStr.includes(':')) {
        //                     return {
        //                         text: "—",
        //                         dayShift: 0
        //                     };
        //                 }

        //                 try {
        //                     let clean = timeStr.trim().split(' ')[0]; // بناخد "21:55" بس ونرمي أي كلام تاني
        //                     let [hours, minutes] = clean.split(':').map(Number);

        //                     if (isNaN(hours) || isNaN(minutes)) return {
        //                         text: "—",
        //                         dayShift: 0
        //                     };

        //                     let totalHours = hours + offset;
        //                     let dayShift = 0;

        //                     if (totalHours >= 24) {
        //                         totalHours -= 24;
        //                         dayShift = 1;
        //                     } else if (totalHours < 0) {
        //                         totalHours += 24;
        //                         dayShift = -1;
        //                     }

        //                     const ampm = totalHours >= 12 ? 'PM' : 'AM';
        //                     const h12 = totalHours % 12 || 12;
        //                     return {
        //                         text: `${h12}:${minutes.toString().padStart(2, '0')} ${ampm}`,
        //                         dayShift
        //                     };
        //                 } catch (e) {
        //                     return {
        //                         text: "—",
        //                         dayShift: 0
        //                     };
        //                 }
        //             };

        //             // استهداف الأعمدة المحددة من نسخة الديسكتوب (أضمن مكان للداتا)
        //             const dateCell = row.querySelector('td:nth-child(3)');
        //             const stdCell = row.querySelector('td:nth-child(8)'); // STD الخلية رقم 8
        //             const staCell = row.querySelector('td:nth-child(10)'); // STA الخلية رقم 10

        //             const rawDate = dateCell ? dateCell.innerText.trim() : "";
        //             const rawStd = stdCell ? stdCell.innerText.trim() : "";
        //             const rawSta = staCell ? staCell.innerText.trim() : "";

        //             const std = convertToLocal(rawStd, JED_OFFSET);
        //             const sta = convertToLocal(rawSta, CAI_OFFSET);

        //             // تصحيح التاريخ
        //             let finalDate = rawDate;
        //             if (rawDate && std.dayShift !== 0) {
        //                 let dateObj = new Date(rawDate);
        //                 if (!isNaN(dateObj.getTime())) {
        //                     dateObj.setDate(dateObj.getDate() + std.dayShift);
        //                     finalDate = dateObj.toLocaleDateString('en-GB', {
        //                         day: '2-digit',
        //                         month: 'short',
        //                         year: 'numeric'
        //                     });
        //                 }
        //             }

        //             // 1. سحب كود مطار الإقلاع (من الخلية الرابعة عادةً)
        //             const fromCell = row.querySelector('td:nth-child(4)');
        //             const fromCode = fromCell?.querySelector('a.fbold')?.innerText.replace(/[()]/g, '')
        //                 .trim() || "—";

        //             // 2. سحب كود مطار الوصول (من الخلية الخامسة عادةً)
        //             const toCell = row.querySelector('td:nth-child(5)');
        //             const toCode = toCell?.querySelector('a.fbold')?.innerText.replace(/[()]/g, '').trim() ||
        //                 "—";

        //             // 3. تحديد الأوفست بناءً على الكود المسحوب (اختياري لو عايز تدعم مطارات تانية)
        //             const departureOffset = fromCode === 'JED' ? 3 : 3; // تقدر تضيف منطق هنا لو المطارات اتغيرت
        //             const arrivalOffset = toCode === 'CAI' ? 2 : 2;

        //             return {
        //                 Date: finalDate || "—",
        //                 From: fromCode, // دلوقت هيقرأها من الصفحة مباشرة
        //                 To: toCode, // دلوقت هيقرأها من الصفحة مباشرة
        //                 Departure: std.text,
        //                 Arrival: sta.text
        //             };
        //         });

        //         console.table(flights);
        //         return flights;
        //     } catch (error) {
        //         console.error("❌ حدث خطأ أثناء المعالجة:", error);
        //     }
        // }
        async function fetchFlightHistory(flightNumber) {
            const url = `/get-flight-data/${flightNumber}`;
            const JED_OFFSET = 3;

            try {
                const response = await fetch(url);
                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const rows = Array.from(doc.querySelectorAll('tr.data-row'));

                return rows.map(row => {
                    const convertToLocal = (timeStr, offset) => {
                        if (!timeStr || !timeStr.includes(':')) return {
                            text: "—",
                            dayShift: 0,
                            rawHours: 0
                        };
                        let clean = timeStr.trim().split(' ')[0];
                        let [hours, minutes] = clean.split(':').map(Number);

                        let totalHours = hours + offset;
                        let dayShift = 0;

                        if (totalHours >= 24) {
                            totalHours -= 24;
                            dayShift = 1;
                        } else if (totalHours < 0) {
                            totalHours += 24;
                            dayShift = -1;
                        }

                        const ampm = totalHours >= 12 ? 'PM' : 'AM';
                        const h12 = totalHours % 12 || 12;
                        return {
                            text: `${h12}:${minutes.toString().padStart(2, '0')} ${ampm}`,
                            dayShift,
                            rawHours: hours // بنحفظ الساعة الأصلية عشان نقارن التاريخ
                        };
                    };

                    const dateCell = row.querySelector('td:nth-child(3)');
                    const stdCell = row.querySelector('td:nth-child(8)');
                    const staCell = row.querySelector('td:nth-child(10)');

                    const rawDate = dateCell ? dateCell.innerText.trim() : "";
                    const std = convertToLocal(stdCell?.innerText, JED_OFFSET);
                    const sta = convertToLocal(staCell?.innerText, JED_OFFSET); // أو أوفست المطار الآخر

                    // --- المنطق الجديد لتصحيح التاريخ ---
                    let dateObj = new Date(rawDate);

                    // لا نزيد يوماً إلا إذا كانت الرحلة "ليلية متأخرة" في جرينتش (مثلاً بعد الساعة 21:00)
                    // وتسببت في عبور منتصف الليل بالتوقيت المحلي (dayShift === 1)
                    if (!isNaN(dateObj.getTime()) && std.dayShift === 1 && std.rawHours >= 21) {
                        dateObj.setDate(dateObj.getDate() + 1);
                    }

                    // تحويل التاريخ لصيغة YYYY-MM-DD بدون التلاعب بالمنطقة الزمنية
                    const y = dateObj.getFullYear();
                    const m = String(dateObj.getMonth() + 1).padStart(2, '0');
                    const d = String(dateObj.getDate()).padStart(2, '0');
                    const finalDateStr = `${y}-${m}-${d}`;


                    // ... داخل fetchFlightHistory ...
                    const doc = parser.parseFromString(html, 'text/html');

                    // سحب اسم شركة الطيران من العنوان
                    // النص بيبقى: "Flight history for Saudia flight SV332"
                    const headerText = doc.querySelector('#cnt-subpage-info h1')?.innerText || "";
                    const airlineName = headerText.split('for')[1]?.split('flight')[0]?.trim() ||
                        "الخطوط السعودية";

                    const rows = Array.from(doc.querySelectorAll('tr.data-row'));
                    return {
                        Date: finalDateStr,
                        From: row.querySelector('td:nth-child(4)')?.innerText.split('(')[1]?.replace(')', '')
                            .trim() || "—",
                        To: row.querySelector('td:nth-child(5)')?.innerText.split('(')[1]?.replace(')', '')
                            .trim() || "—",
                        Departure: std.text,
                        Arrival: sta.text,
                        Airline: airlineName, // أضفنا اسم الشركة هنا
                    };
                });
            } catch (e) {
                console.error(e);
                return [];
            }
        }

        // fetchFlightHistory('sv332');
        // دالة لتعبئة بيانات الرحلة في الـ Form
        $(document).ready(function() {
            // 1. مراقبة التغيير في (رقم الرحلة) أو (التاريخ) للقسمين
            const flightInputs =
                'input[name="arrival_flight_no[]"], input[name="arrival_date[]"], input[name="departure_flight_no[]"], input[name="departure_date[]"]';

            $(document).on('change', flightInputs, async function() {
                const isArrival = $(this).closest('.arrival-flight-row').length > 0;
                const row = isArrival ? $(this).closest('.arrival-flight-row') : $(this).closest(
                    '.departure-flight-row');

                const prefix = isArrival ? 'arrival' : 'departure';
                const flightNo = row.find(`input[name="${prefix}_flight_no[]"]`).val().trim();
                const selectedDate = row.find(`input[name="${prefix}_date[]"]`).val();

                if (flightNo.length > 3 && selectedDate) {
                    console.log(
                        `جاري البحث عن ${prefix === 'arrival' ? 'استقبال' : 'توديع'} للرحلة ${flightNo}...`
                    );

                    const allFlights = await fetchFlightHistory(flightNo);
                    if (!allFlights) return;

                    // البحث عن الرحلة المطابقة للتاريخ
                    const match = allFlights.find(f => f.Date === selectedDate);
                    if (match) {
                        console.log("تم العثور على البيانات:", match);

                        if (isArrival) {
                            // تعبئة شركة الطيران في الاستقبال
                            row.find('input[name="arrival_airline[]"]').val(match.Airline);
                            row.find('input[name="arrival_time[]"]').val(convertTo24Hour(match
                                .Arrival));
                            row.find('input[name="arrival_from_airport[]"]').val(match.From);
                            if (match.To === "JED") row.find('select[name="arrival_to_sa_airport[]"]')
                                .val("جدة");
                        } else {
                            // تعبئة شركة الطيران في التوديع
                            row.find('input[name="departure_airline[]"]').val(match.Airline);
                            row.find('input[name="departure_time[]"]').val(convertTo24Hour(match
                                .Departure));
                            row.find('input[name="departure_to_airport[]"]').val(match.To);
                            if (match.From === "JED") row.find(
                                'select[name="departure_from_sa_airport[]"]').val("جدة");
                        }
                        // ... باقي الكود ...
                    }
                    if (match) {
                        console.log("تم العثور على البيانات:", match);

                        if (isArrival) {
                            // في الاستقبال: بنهتم بوقت الوصول (Arrival) والمطار القادمة منه (From)
                            row.find('input[name="arrival_time[]"]').val(convertTo24Hour(match
                                .Arrival));
                            row.find('input[name="arrival_from_airport[]"]').val(match.From);
                            if (match.To === "JED") row.find('select[name="arrival_to_sa_airport[]"]')
                                .val("جدة");
                        } else {
                            // في التوديع: بنهتم بوقت الإقلاع (Departure) والمطار المتوجهة إليه (To)
                            row.find('input[name="departure_time[]"]').val(convertTo24Hour(match
                                .Departure));
                            row.find('input[name="departure_to_airport[]"]').val(match.To);
                            if (match.From === "JED") row.find(
                                'select[name="departure_from_sa_airport[]"]').val("جدة");
                        }

                        // تأثير بصري بسيط للنجاح
                        row.find('input').addClass('is-valid').delay(1000).queue(function(next) {
                            $(this).removeClass('is-valid');
                            next();
                        });
                    } else {
                        console.warn("الرحلة غير موجودة في هذا التاريخ بالسجلات.");
                    }
                }
            });
        });
        // دالة تحويل الوقت لـ 24 ساعة
        function convertTo24Hour(timeStr) {
            if (!timeStr || timeStr === "—") return "";
            let modifier = timeStr.slice(-2);
            let [hours, minutes] = timeStr.slice(0, -3).split(':');
            if (hours === '12') hours = '00';
            if (modifier === 'PM') hours = parseInt(hours, 10) + 12;
            return `${hours.toString().padStart(2, '0')}:${minutes}`;
        }


        // // تنفيذ
        // fetchFlightHistory('SV309');

        // fetch('/get-flight-data/SV309')
        //     .then(r => r.text())
        //     .then(html => {
        //         const doc = new DOMParser().parseFromString(html, 'text/html');
        //         const firstRow = doc.querySelector('tr.data-row');
        //         console.log(firstRow?.outerHTML);
        //     });
    </script>
@endsection
