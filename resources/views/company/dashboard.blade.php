@extends('adminlte::page')

@section('title', 'لوحة التحكم | واصل')

@section('content_header')
    <div
        class="flex flex-col md:flex-row justify-between items-center p-6 bg-white rounded-2xl shadow-sm border border-slate-100 gap-4 mb-4">
        <div class="text-right w-full md:w-auto">
            <h1 class="text-2xl font-black text-slate-800">مرحباً بك، {{ auth('company')->user()->company_name }} 👋</h1>
            <p class="text-slate-400 text-xs font-bold mt-1">ملخص نشاط الحجوزات والعمليات اليوم</p>
        </div>
        <div
            class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100 w-full md:w-auto justify-center md:justify-start">
            <i class="fas fa-calendar-alt text-indigo-300 text-xl"></i>
            <div class="text-right">
                <span class="text-[10px] font-black text-slate-400 block uppercase tracking-widest">التاريخ الحالي</span>
                <span class="text-sm font-bold text-indigo-600">{{ now()->format('d M, Y') }}</span>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid pb-8" dir="rtl text-right">

        {{-- 1. كروت الإحصائيات --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-3xl shadow-sm border-b-4 border-indigo-500 transition-all">
                <h3 class="text-slate-400 font-bold text-[11px] uppercase">إجمالي الحجوزات</h3>
                <p class="text-3xl font-black text-slate-800">{{ number_format($stats['bookings_count']) }}</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border-b-4 border-emerald-500 transition-all">
                <h3 class="text-slate-400 font-bold text-[11px] uppercase">حجوزات مقبولة</h3>
                <p class="text-3xl font-black text-slate-800">{{ number_format($stats['confirmed_total']) }}</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border-b-4 border-orange-500 transition-all">
                <h3 class="text-slate-400 font-bold text-[11px] uppercase">إجمالي الإيرادات</h3>
                <p class="text-3xl font-black text-slate-800">{{ number_format($stats['total_revenue'], 2) }} <span
                        class="text-xs">ر.س</span></p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border-b-4 border-red-500 transition-all">
                <h3 class="text-slate-400 font-bold text-[11px] uppercase">بانتظار المراجعة</h3>
                <p class="text-3xl font-black text-slate-800">{{ sprintf('%02d', $stats['pending_count']) }}</p>
            </div>
        </div>

        {{-- 2. الجدول --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-right">
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-lg font-black text-slate-800 text-right">أحدث الحجوزات</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-right" dir="rtl">
                        <thead>
                            <tr class="text-slate-400 text-[10px] uppercase font-black border-b border-slate-50">
                                <th class="px-6 py-4">رقم الحجز</th>
                                <th class="px-6 py-4">المشرف</th>
                                <th class="px-6 py-4">الحالة</th>
                                <th class="px-6 py-4">إجراء</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs font-bold text-slate-600">
                            @forelse($latest_bookings as $booking)
                                <tr class="border-b border-slate-50 hover:bg-slate-50/50">
                                    <td class="px-6 py-4 text-indigo-600">#BK-{{ $booking->id }}</td>
                                    <td class="px-6 py-4">{{ $booking->supervisor_name }}</td>
                                    <td class="px-6 py-4">
                                        @if ($booking->status == 'accepted')
                                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded-lg text-[9px]">تم
                                                القبول</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded-lg text-[9px]">قيد
                                                المراجعة</span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-600 px-2 py-1 rounded-lg text-[9px]">مرفوض</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('booking.show', $booking->id) }}"
                                            class="text-slate-400 hover:text-indigo-600"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-10">لا توجد بيانات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- الجانب الأيسر: الرسم البياني --}}
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 text-right">
                <h3 class="text-sm font-black text-slate-800 mb-6">توزيع الحالات</h3>
                <canvas id="miniChart"></canvas>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Tajawal', sans-serif !important;
        }

        .content-wrapper {
            background: #f8fafc !important;
        }

        th,
        td {
            text-align: right !important;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('miniChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['مقبول', 'مراجعة'],
                datasets: [{
                    data: [{{ $stats['confirmed_total'] }}, {{ $stats['pending_count'] }}],
                    backgroundColor: ['#10b981', '#f59e0b'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        rtl: true
                    }
                }
            }
        });
    </script>
@stop
