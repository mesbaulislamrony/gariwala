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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->index();
            $table->foreignId('customer_id')->index();
            $table->string('pickup_address');
            $table->string('drop_address');
            $table->datetime('pickup_datetime');
            $table->datetime('drop_datetime');
            $table->enum('trip_type', ['one_way', 'round_trip', 'contractual'])->default('one_way');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('payable', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('booking_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->index();
            $table->foreignId('user_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('booking_user');
    }
};
