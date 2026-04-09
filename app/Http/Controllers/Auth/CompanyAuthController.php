<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourismCompany; // تأكد من استدعاء الموديل
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CompanyAuthController extends Controller
{
    // 1. الفنكشن اللي ناقصة لعرض صفحة التسجيل
    public function showRegisterForm()
    {
        return view('company.company-register');
    }

    // 2. الفنكشن اللي ناقصة لعرض صفحة الدخول (لو كنت عرفتها في الـ Route)
    public function showLoginForm()
    {
        return view('company.login');
    }

    // الفنكشن المسؤولة عن حفظ البيانات (Register Logic)

    public function register(Request $request)
    {
        // 1. التحقق من البيانات (Validation)
        $request->validate([
            'company_name'   => 'required|string|max:255',
            'license_number' => 'required',
            'password'       => 'required|min:6',
            'email'          => 'nullable|email|unique:tourism_companies,email',
            'phone'          => 'nullable|unique:tourism_companies,phone',
            'logo'           => 'nullable|image', // الأمان في الصور
        ]);

        // 2. التعامل مع رفع اللوجو (إذا وُجد)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('companies/logos', 'public');
        }

        // 3. إنشاء السجل في قاعدة البيانات
        $company = TourismCompany::create([
            'company_name'   => $request->company_name,
            'license_number' => $request->license_number,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'logo'           => $logoPath,
            'password'       => Hash::make($request->password),
            'status'         => 'pending',
        ]);

        // 4. السحر هنا: تسجيل الدخول يدوياً (Manual Login)
        // ده اللي بيعمل الـ Session ويدي المستخدم الـ Token المطلوب للأمان
        Auth::guard('company')->login($company);

        // 5. التوجيه للداشبورد وهو "مسجل دخول" فعلياً
        return redirect()->route('company.dashboard')
            ->with('success', 'تم إنشاء حسابك بنجاح، أهلاً بك في واصل!');
    }
    public function login(Request $request)
    {
        // 1. التحقق من البيانات المدخلة
        $request->validate([
            'email'    => 'required|string', // يمكن أن يكون إيميل أو رقم ترخيص
            'password' => 'required|string',
        ]);

        // 2. تحديد ما إذا كان المدخل بريد إلكتروني أم رقم ترخيص
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'license_number';

        // 3. محاولة تسجيل الدخول باستخدام الجارد الخاص بالشركات
        $credentials = [
            $fieldType => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('company')->attempt($credentials, $request->remember)) {
            // إذا نجح الدخول، يتم إنشاء الجلسة وتوجيهه للداشبورد
            $request->session()->regenerate();

            return redirect()->intended(route('company.dashboard'))
                ->with('success', 'مرحباً بعودتك مرة أخرى!');
        }

        // 4. في حال فشل الدخول، العودة مع رسالة خطأ
        throw ValidationException::withMessages([
            'email' => ['بيانات الاعتماد المدخلة غير صحيحة، يرجى المحاولة مرة أخرى.'],
        ]);
    }
    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        return redirect()->route('company.login');
    }
    public function editSettings()
    {
        // جلب بيانات الشركة المسجلة دخولها حالياً عبر الجارد الخاص بها
        // تأكد أن اسم الجارد 'company' مطابق لما هو معرف في config/auth.php
        $company = auth('company')->user();

        // التحقق من وجود بيانات (اختياري للأمان)
        if (!$company) {
            return redirect()->route('company.login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        // إرسال المتغير للملف الذي أنشأناه سابقاً
        return view('company.settings', compact('company'));
    }
    public function updateSettings(Request $request)
    {
        $company = auth('company')->user(); // تأكد من استخدام الجارد الصحيح

        $request->validate([
            'company_name' => 'required|string|max:255',
            'email'        => 'required|email|unique:tourism_companies,email,' . $company->id,
            'phone'        => 'nullable|string|unique:tourism_companies,phone,' . $company->id,
            'password'     => 'nullable|min:8|confirmed',
            'logo'         => 'nullable|image',
        ]);

        $data = $request->only(['company_name', 'email', 'phone', 'address']);

        // معالجة كلمة المرور إذا تم إدخالها
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // معالجة اللوجو
        if ($request->hasFile('logo')) {
            // حذف اللوجو القديم إذا وُجد
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($data);

        return back()->with('success', 'تم تحديث بيانات الشركة بنجاح');
    }
}
