<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // مهم جداً عشان تقدر تعمل تسجيل دخول للشركة
use Illuminate\Notifications\Notifiable;

class TourismCompany extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * الحقول القابلة للتعبئة (Mass Assignment)
     */
    protected  $fillable = [
        'company_name',
        'email',
        'phone',
        'password',
        'address',
        'logo',
        'status', // أضف أي حقول أخرى تريد تحديثها
    ];

    /**
     * الحقول المخفية (لا تظهر عند تحويل الموديل إلى Array أو JSON)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * تحويل البيانات تلقائياً (Casting)
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10+ بيعمل Hash تلقائي لو استخدمت الـ Cast ده
    ];

    /**
     * SCOPES: وظائف مساعدة لفلترة البيانات بسهولة في الـ Controller
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
