@extends('adminlte::page')

@section('title', 'تفاصيل الحجز #' . $booking->id)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center p-3 bg-white shadow-sm rounded-lg">
        <div>
            <div class="d-flex align-items-center">
                <h1 class="font-weight-bold text-dark mb-0 ml-3">تفاصيل الحجز رقم #{{ $booking->id }}</h1>

                {{-- عرض الحالة --}}
                @if ($booking->status == 'pending')
                    <span class="badge badge-warning px-3 py-2 rounded-pill font-weight-bold text-white shadow-sm">
                        <i class="fas fa-clock ml-1"></i> قيد المراجعة
                    </span>
                @elseif($booking->status == 'confirmed')
                    <span class="badge badge-success px-3 py-2 rounded-pill font-weight-bold shadow-sm">
                        <i class="fas fa-check-circle ml-1"></i> تمت الموافقة
                    </span>
                @elseif($booking->status == 'rejected')
                    <span class="badge badge-danger px-3 py-2 rounded-pill font-weight-bold shadow-sm">
                        <i class="fas fa-times-circle ml-1"></i> مرفوض
                    </span>
                @endif
            </div>
            <p class="text-muted mb-0 mt-2">تم إنشاء الحجز في: {{ $booking->created_at->format('Y-m-d') }}</p>
        </div>
        <button onclick="window.print()" class="btn btn-outline-primary">
            <i class="fas fa-print mr-2"></i> طباعة الحجز
        </button>
    </div>
@stop

@section('content')
    <div class="container-fluid pb-5" dir="rtl">
        <div class="row">

            {{-- 1. معلومات العميل والمشرف --}}
            <div class="col-md-4">
                <div class="card card-outline card-indigo shadow-sm border-0 rounded-xl">
                    <div class="card-header font-weight-bold">
                        <i class="fas fa-user-tie mr-2"></i> معلومات التواصل
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted small">اسم المشرف:</span>
                                <span class="font-weight-bold">{{ $booking->supervisor_name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted small">جوال (سعودي):</span>
                                <span class="text-indigo font-weight-bold">{{ $booking->supervisor_phone_sa }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted small">جوال (مصر):</span>
                                <span>{{ $booking->supervisor_phone_eg }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted small">شركة العميل:</span>
                                <span class="badge badge-light p-2">{{ $booking->company }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- تفاصيل النقل --}}
                <div class="card shadow-sm border-0 rounded-xl mt-4">
                    <div class="card-header bg-dark text-white font-weight-bold">
                        <i class="fas fa-bus mr-2"></i> تفاصيل النقل والعدد
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-6 border-right">
                                <h5 class="font-weight-black mb-0">{{ $booking->passengers }}</h5>
                                <small class="text-muted">راكب</small>
                            </div>
                            <div class="col-6">
                                <h5 class="font-weight-black mb-0">{{ $booking->buses }}</h5>
                                <small class="text-muted">حافلة</small>
                            </div>
                        </div>
                        <hr>
                        <div class="text-indigo font-weight-bold">نوع الحافلة: {{ $booking->bus_type }}</div>
                    </div>
                </div>
            </div>

            {{-- 2. تفاصيل الرحلات (طيران) وفنادق --}}
            <div class="col-md-8">
                {{-- الرحلات الجوية --}}
                <div class="card shadow-sm border-0 rounded-xl">
                    <div class="card-header bg-white border-bottom font-weight-bold">
                        <i class="fas fa-plane-arrival text-primary mr-2"></i> تفاصيل الرحلات الجوية (الطيران)
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr class="small text-muted font-weight-bold">
                                    <th>النوع</th>
                                    <th>الخطوط</th>
                                    <th>رقم الرحلة</th>
                                    <th>المسار</th>
                                    <th>التاريخ والوقت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking->flights as $flight)
                                    <tr>
                                        <td>
                                            <span class="badge badge-{{ $flight->type == 'arrival' ? 'success' : 'info' }}">
                                                {{ $flight->type == 'arrival' ? 'وصول' : 'مغادرة' }}
                                            </span>
                                        </td>
                                        <td>{{ $flight->airline }}</td>
                                        <td class="font-weight-bold">{{ $flight->flight_no }}</td>
                                        <td>{{ $flight->from_airport }} <i class="fas fa-arrow-left mx-1 small"></i>
                                            {{ $flight->to_airport }}</td>
                                        <td>{{ $flight->date->format('Y-m-d') }} | {{ $flight->time->format('H:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- الفنادق المحجوزة --}}
                <div class="card shadow-sm border-0 rounded-xl mt-4">
                    <div class="card-header bg-white border-bottom font-weight-bold">
                        <i class="fas fa-hotel text-warning mr-2"></i> السكن والإقامة
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($booking->hotels as $hotel)
                                <div class="col-md-6 mb-3">
                                    <div class="p-3 border rounded-lg bg-light h-100">
                                        <h6 class="font-weight-bold text-indigo"><i class="fas fa-map-marker-alt"></i>
                                            {{ $hotel->city == 'makkah' ? 'مكة المكرمة' : 'المدينة المنورة' }}</h6>
                                        <p class="mb-1"><strong>الفندق:</strong> {{ $hotel->name }}</p>
                                        <p class="small text-muted mb-0">دخول: {{ $hotel->checkin->format('Y-m-d') }}</p>
                                        <p class="small text-muted mb-0">خروج: {{ $hotel->checkout->format('Y-m-d') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- التوصيلات والزيارات --}}
                <div class="card shadow-sm border-0 rounded-xl mt-4">
                    <div class="card-header bg-white border-bottom font-weight-bold text-success">
                        <i class="fas fa-route mr-2"></i> المزارات والتحركات الداخلية
                    </div>
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            {{-- التوصيلات --}}
                            <div class="col-md-6 border-right">
                                <div class="p-3">
                                    <h6 class="font-weight-bold small text-muted mb-3 uppercase tracking-wider text-right">
                                        قائمة التوصيلات (Transfers)</h6>
                                    @foreach ($booking->transfers as $transfer)
                                        <div class="d-flex align-items-center mb-2 p-2 bg-light rounded shadow-xs">
                                            <i class="fas fa-exchange-alt text-muted mx-2"></i>
                                            <span class="small font-weight-bold">{{ $transfer->from }} <i
                                                    class="fas fa-caret-left mx-1"></i> {{ $transfer->to }}</span>
                                            <span
                                                class="mr-auto badge badge-white border">{{ $transfer->date->format('m/d') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- أيام المزارات --}}
                            <div class="col-md-6">
                                <div class="p-3 text-right">
                                    <h6 class="font-weight-bold small text-muted mb-3 uppercase tracking-wider">أيام
                                        الزيارات (Visit Days)</h6>
                                    @foreach ($booking->visitDays as $visit)
                                        <div class="mb-1">
                                            <span class="badge badge-success px-3 py-2 w-100 text-right">
                                                <i class="fas fa-calendar-check ml-2"></i>
                                                زيارة في {{ $visit->city == 'makkah' ? 'مكة' : 'المدينة' }} بتاريخ
                                                {{ $visit->date->format('Y-m-d') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        body {
            font-family: 'Tajawal', sans-serif !important;
        }

        .rounded-xl {
            border-radius: 15px !important;
        }

        .text-indigo {
            color: #6610f2;
        }

        .card-indigo {
            border-top: 3px solid #6610f2 !important;
        }

        @media print {

            .btn,
            .main-footer,
            .nav-link {
                display: none !important;
            }

            .content-wrapper {
                background: white !important;
            }
        }
    </style>
@stop
