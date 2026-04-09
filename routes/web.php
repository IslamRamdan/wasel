<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Auth\CompanyAuthController;
use App\Http\Controllers\Company\BookingController;
use App\Http\Controllers\Company\DashboardController;
use App\Models\Booking;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-flight-data/{flight}', function ($flight) {
    $url = "https://www.flightradar24.com/data/flights/" . strtolower($flight);

    $response = Http::withHeaders([
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
    ])->get($url);

    $html = $response->successful() ? $response->body() : "";

    // لو فشل، جرب البروكسي المجاني AllOrigins
    if (empty($html) || str_contains($html, 'Access Denied')) {
        $proxyRes = Http::get("https://api.allorigins.win/get?url=" . urlencode($url));
        $html = $proxyRes->json()['contents'] ?? '';
    }

    // السحر هنا: بنضيف الهيدر اللي بيسمح بالـ CORS
    return response($html, 200)
        ->header('Content-Type', 'text/plain')
        ->header('Access-Control-Allow-Origin', '*') // بيسمح لأي موقع يكلمه (بما فيهم الـ Localhost)
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

Route::prefix('company')->group(function () {
    // Register
    Route::get('register', [CompanyAuthController::class, 'showRegisterForm'])->name('company.register');
    Route::post('register', [CompanyAuthController::class, 'register'])->name('company.register.submit');

    // Login
    Route::get('login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
    Route::post('login', [CompanyAuthController::class, 'login'])->name('company.login.submit');

    // Dashboard (يتم الوصول له عبر /company/dashboard)
    Route::middleware(['auth:company'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('company.dashboard');
        Route::post('logout', [CompanyAuthController::class, 'logout'])->name('company.logout');

        Route::get('trips',  function () {
            // 1. جلب الحجوزات مع العلاقات المرتبطة (الطيران والفنادق) لتحسين الأداء
            // تم استخدام paginate للعرض المنظم، يمكنك استخدام get() إذا كان العدد بسيطاً
            $bookings = Booking::with(['flights', 'hotels'])
                ->latest()
                ->get();

            // 2. حساب الإحصائيات لعرضها في الـ Widgets العلوية
            $stats = [
                'total_bookings'   => $bookings->count(),
                'total_passengers' => $bookings->sum('passengers'),
                'total_buses'      => $bookings->sum('buses'),
                'unique_countries' => $bookings->pluck('agent_country')->unique()->count(),
            ];
            return view('company.trips.index', compact('bookings', 'stats'));
        })->name('company.trips');

        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
        // أضف هنا أي صفحة تانية محتاجة حماية (مثل إضافة حافلة)
        Route::get('/booking', function () {
            return view('company.trips.booking');
        })->name('company.trips.booking');
        Route::get('/full-trip', function () {
            return view('company.trips.full-trip');
        })->name('company.full-trip');


        Route::get('/booking-show/{id}', [BookingController::class, 'show'])->name('booking.show');

        // روت عرض صفحة الإعدادات
        Route::get('/settings', [CompanyAuthController::class, 'editSettings'])->name('company.settings.edit');

        // روت معالجة تحديث البيانات (هذا الذي نستخدمه في الـ Form)
        Route::put('/settings/update', [CompanyAuthController::class, 'updateSettings'])->name('company.settings.update');
    });
});
