@extends('adminlte::page')

@section('title', 'منصة إدارة العمليات | الحجوزات')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center py-4 px-2">
        <div>
            <h1 class="font-weight-bold saudi-page-title text-dark">
                إدارة الحجوزات والرحلات
            </h1>
            <p class="text-muted mb-0">نظرة عامة حية على كافة العمليات التشغيلية والحجوزات الحالية</p>
        </div>
        <a href="{{ route('company.trips.booking') }}"
            class="btn btn-saudi-primary btn-md px-4 py-2 shadow-sm font-weight-bold">
            <i class="fas fa-plus ml-2"></i> إضافة حجز جديد
        </a>
    </div>
@stop

@section('content')
    <div class="container-fluid pb-5">

        <div class="row mb-5">
            @php
                $widgets = [
                    ['title' => 'إجمالي الحجوزات', 'value' => $bookings->count(), 'icon' => 'fas fa-file-invoice'],
                    ['title' => 'عدد الركاب', 'value' => $bookings->sum('passengers'), 'icon' => 'fas fa-users'],
                    ['title' => 'الأسطول المشغل', 'value' => $bookings->sum('buses'), 'icon' => 'fas fa-bus'],
                    [
                        'title' => 'الدول المتعاقدة',
                        'value' => $bookings->pluck('agent_country')->unique()->count(),
                        'icon' => 'fas fa-globe-americas',
                    ],
                ];
            @endphp

            @foreach ($widgets as $widget)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm saudi-stat-card">
                        <div class="card-body p-4 text-right">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="saudi-icon-bg">
                                    <i class="{{ $widget['icon'] }} text-saudi-green"></i>
                                </div>
                                <div class="text-muted small">{{ $widget['title'] }}</div>
                            </div>
                            <h2 class="font-weight-bold text-dark mb-0">{{ number_format($widget['value']) }}</h2>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card border-0 shadow-sm saudi-main-card">
            <div class="card-header bg-white border-0 py-4 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title font-weight-bold text-dark mb-0">
                        سجل العمليات التشغيلية
                    </h5>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control form-control-saudi float-right"
                                placeholder="بحث برقم الحجز أو المشرف">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 saudi-table text-right">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 text-muted">رقم الحجز</th>
                                <th class="py-3 text-muted">المشرف / الشركة</th>
                                <th class="py-3 text-muted">التسكين (الفنادق)</th>
                                <th class="py-3 text-muted">نوع الرحلة</th>
                                <th class="py-3 text-muted">العدد</th>
                                <th class="py-3 px-4 text-muted text-center">إدارة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr
                                    class="
                                            @if ($booking->status == 'pending') bg-warning-light 
                                            @elseif($booking->status == 'rejected') bg-danger-light @endif">

                                    <td class="font-weight-bold px-4">#{{ $booking->id }}</td>

                                    <td class="py-3">
                                        <div class="text-dark font-weight-bold">{{ $booking->supervisor_name }}</div>
                                        <div class="small text-muted"><i class="fas fa-building ml-1"></i>
                                            {{ $booking->company }}</div>
                                    </td>

                                    <td>
                                        @foreach ($booking->hotels as $hotel)
                                            <div class="small mb-1">
                                                <i class="fas fa-hotel text-saudi-gold ml-1"></i> {{ $hotel->city }}:
                                                {{ $hotel->name }}
                                            </div>
                                        @endforeach
                                    </td>

                                    <td>
                                        {{-- شارة الحالة الديناميكية --}}
                                        @if ($booking->status == 'pending')
                                            <span
                                                class="badge badge-warning px-3 py-2 rounded-pill font-weight-bold text-white">قيد
                                                المراجعة</span>
                                        @elseif($booking->status == 'confirmed')
                                            <span
                                                class="badge badge-light px-3 py-2 rounded-pill font-weight-bold border text-dark">تمت
                                                الموافقة</span>
                                        @elseif($booking->status == 'rejected')
                                            <span
                                                class="badge badge-danger px-3 py-2 rounded-pill font-weight-bold text-white">مرفوض</span>
                                        @endif

                                        <div class="small text-muted mt-2">
                                            <i class="fas fa-bus-alt ml-1"></i> {{ $booking->bus_type }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="text-saudi-green font-weight-bold">{{ $booking->passengers }} <span
                                                class="small text-muted">راكب</span></div>
                                        <div class="text-muted small">{{ $booking->buses }} باص</div>
                                    </td>

                                    <td class="text-center px-4">
                                        <div class="btn-group">
                                            <a href="{{ route('booking.show', $booking->id) }}"
                                                class="btn btn-sm btn-light border-0 mx-1" title="عرض التفاصيل">
                                                <i class="fas fa-eye text-primary"></i>
                                            </a>
                                            {{-- لا نسمح بالتعديل إذا رُفض الحجز مثلاً --}}
                                            @if ($booking->status != 'rejected')
                                                <a href="#" class="btn btn-sm btn-light border-0 mx-1" title="تعديل">
                                                    <i class="fas fa-edit text-saudi-green"></i>
                                                </a>
                                            @endif

                                            <form action="" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-light border-0 mx-1" title="حذف"
                                                    onclick="return confirm('هل أنت متأكد؟')">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                {{-- كود الحالة الفارغة كما هو --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                <div class="small text-muted">عرض سجلات النظام المركزية</div>
                <div class="saudi-pagination">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        :root {
            --saudi-green: #006C35;
            --saudi-green-hover: #004d26;
            --saudi-mint: #ECFDF5;
            --saudi-gold: #D4AF37;
            --saudi-white: #FFFFFF;
            --saudi-bg-light: #F9FAFB;
            --saudi-border-color: #E5E7EB;
            --saudi-soft-shadow: 0 5px 15px rgba(0, 0, 0, 0.04);
        }

        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            text-align: right;
            background-color: var(--saudi-bg-light) !important;
            color: #1F2937;
        }

        .saudi-page-title {
            font-size: 1.75rem;
            color: #111827;
        }

        .btn-saudi-primary {
            background-color: var(--saudi-green);
            color: white;
            border: none;
            border-radius: 8px;
            transition: 0.2s;
        }

        .btn-saudi-primary:hover {
            background-color: var(--saudi-green-hover);
            color: white;
            transform: translateY(-1px);
        }

        .saudi-stat-card {
            border-radius: 12px;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
        }

        .saudi-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06);
        }

        .saudi-icon-bg {
            background-color: var(--saudi-mint);
            padding: 12px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .saudi-icon-bg i {
            font-size: 1.25rem;
        }

        .text-saudi-green {
            color: var(--saudi-green) !important;
        }

        .saudi-main-card {
            border-radius: 12px;
            box-shadow: var(--saudi-soft-shadow) !important;
            overflow: hidden;
        }

        .saudi-table {
            width: 100%;
            border-collapse: collapse;
        }

        .saudi-table thead th {
            background-color: white !important;
            color: #6B7280;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: 1px solid var(--saudi-border-color) !important;
            padding: 15px;
        }

        .saudi-table tbody td {
            border-bottom: 1px solid var(--saudi-border-color) !important;
            padding: 15px;
            color: #374151;
            font-size: 14px;
        }

        .saudi-table tbody tr:hover {
            background-color: #FDFDFD !important;
        }

        .badge-saudi-mint {
            background-color: var(--saudi-mint);
            color: #065f46;
        }

        .text-saudi-gold {
            color: var(--saudi-gold);
        }

        .form-control-saudi {
            border: 1px solid var(--saudi-border-color);
            border-radius: 6px;
            padding: 8px 12px;
        }

        .form-control-saudi:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            outline: none;
        }

        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
    </style>
    <style>
        /* تلوين خلفية الصف قيد المراجعة (أصفر خفيف جداً) */
        .bg-warning-light {
            background-color: rgba(255, 193, 7, 0.08) !important;
        }

        /* تلوين خلفية الصف المرفوض (أحمر خفيف جداً) */
        .bg-danger-light {
            background-color: rgba(220, 53, 69, 0.08) !important;
        }

        /* تحسين شكل شارة "تمت الموافقة" باللون الأبيض */
        .badge-light {
            background-color: #ffffff !important;
            border: 1px solid #dee2e6 !important;
            color: #28a745 !important;
            /* نص أخضر ليدل على الموافقة */
        }
    </style>
@stop
