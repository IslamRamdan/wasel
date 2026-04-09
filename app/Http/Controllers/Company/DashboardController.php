<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $companyId = auth('company')->id();

        $stats = [
            'bookings_count'  => Booking::where('tourism_company_id', $companyId)->count(),
            'confirmed_total' => Booking::where('tourism_company_id', $companyId)->where('status', 'accepted')->count(),
            'total_revenue'   => Booking::where('tourism_company_id', $companyId)->where('status', 'accepted')->sum('price'),
            'pending_count'   => Booking::where('tourism_company_id', $companyId)->where('status', 'pending')->count(),
        ];

        $latest_bookings = Booking::where('tourism_company_id', $companyId)
            ->latest()
            ->take(5)
            ->get();

        return view('company.dashboard', compact('stats', 'latest_bookings'));
    }
}
