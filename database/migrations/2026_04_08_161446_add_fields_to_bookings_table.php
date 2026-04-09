<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {

            if (!Schema::hasColumn('bookings', 'type')) {
                $table->string('type')->nullable();
            }

            if (!Schema::hasColumn('bookings', 'status')) {
                $table->string('status')->default('pending');
            }

            if (!Schema::hasColumn('bookings', 'price')) {
                $table->decimal('price', 10, 2)->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'status',
                'from_location',
                'to_location',
                'to_city',
                'date',
                'time',
                'price'
            ]);
        });
    }
};
