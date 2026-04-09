<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tourism_companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name'); // اسم الشركة
            $table->string('license_number')->unique(); // رقم الترخيص

            // بيانات الدخول
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('password');

            // بيانات التواصل
            $table->text('address')->nullable(); // العنوان فقط (Address)

            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->string('logo')->nullable(); // مسار لوجو الشركة الخاص بيهم

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_companies');
    }
};
