<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Hotel;
use App\Models\Transfer;
use App\Models\VisitDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    //
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->only([
                'supervisor_name',
                'supervisor_phone_sa',
                'supervisor_phone_eg',
                'company',
                'external_agent_name',
                'agent_country',
                'bus_type',
                'passengers',
                'buses',
            ]);

            // إضافة معرف الشركة للبيانات
            $data['tourism_company_id'] = auth('company')->id();

            $booking = Booking::create($data);
            // -----------------------------------
            // ✈️ ARRIVAL FLIGHTS
            foreach ($request->arrival_flight_no ?? [] as $i => $val) {
                if (!$val) continue;

                Flight::create([
                    'booking_id' => $booking->id,
                    'type' => 'arrival',
                    'airline' => $request->arrival_airline[$i] ?? null,
                    'flight_no' => $val,
                    'from_airport' => $request->arrival_from_airport[$i] ?? null,
                    'to_airport' => $request->arrival_to_sa_airport[$i] ?? null,
                    'terminal' => $request->arrival_terminal[$i] ?? null,
                    'date' => $request->arrival_date[$i] ?? null,
                    'time' => $request->arrival_time[$i] ?? null,
                ]);
            }

            // ✈️ DEPARTURE
            foreach ($request->departure_flight_no ?? [] as $i => $val) {
                if (!$val) continue;

                Flight::create([
                    'booking_id' => $booking->id,
                    'type' => 'departure',
                    'airline' => $request->departure_airline[$i] ?? null,
                    'flight_no' => $val,
                    'from_airport' => $request->departure_from_sa_airport[$i] ?? null,
                    'to_airport' => $request->departure_to_airport[$i] ?? null,
                    'terminal' => $request->departure_terminal[$i] ?? null,
                    'date' => $request->departure_date[$i] ?? null,
                    'time' => $request->departure_time[$i] ?? null,
                ]);
            }

            // -----------------------------------
            // 🏨 HOTELS
            foreach ($request->makkah_hotel_name ?? [] as $i => $val) {
                if (!$val) continue;

                Hotel::create([
                    'booking_id' => $booking->id,
                    'city' => 'makkah',
                    'name' => $val,
                    'address' => $request->makkah_hotel_address[$i] ?? null,
                    'checkin' => $request->makkah_checkin[$i] ?? null,
                    'checkout' => $request->makkah_checkout[$i] ?? null,
                ]);
            }

            foreach ($request->madinah_hotel_name ?? [] as $i => $val) {
                if (!$val) continue;

                Hotel::create([
                    'booking_id' => $booking->id,
                    'city' => 'madinah',
                    'name' => $val,
                    'address' => $request->madinah_hotel_address[$i] ?? null,
                    'checkin' => $request->madinah_checkin[$i] ?? null,
                    'checkout' => $request->madinah_checkout[$i] ?? null,
                ]);
            }

            // -----------------------------------
            // 🚐 TRANSFERS
            foreach ($request->from ?? [] as $i => $val) {
                Transfer::create([
                    'booking_id' => $booking->id,
                    'from' => $val,
                    'to' => $request->to[$i] ?? null,
                    'date' => $request->transfer_date[$i] ?? null,
                    'time' => $request->transfer_time[$i] ?? null,
                ]);
            }

            // -----------------------------------
            // 🗓️ VISIT DAYS
            foreach ($request->all() as $key => $value) {
                if (str_contains($key, 'visit_day')) {

                    preg_match('/(makkah|madinah)_visit_day_hotel_(\d+)/', $key, $matches);

                    if ($matches) {
                        VisitDay::create([
                            'booking_id' => $booking->id,
                            'city' => $matches[1],
                            'hotel_index' => $matches[2],
                            'date' => $value,
                        ]);
                    }
                }
            }

            DB::commit();

            return back()->with('success', 'تم الحفظ بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
    public function show($id)
    {
        // جلب الحجز مع كل العلاقات المرتبطة به لتقليل الضغط على قاعدة البيانات
        $booking = Booking::with(['flights', 'hotels', 'transfers', 'visitDays'])
            ->where('tourism_company_id', auth('company')->id())
            ->findOrFail($id);

        return view('company.trips.full-trip-show', compact('booking'));
    }
}
