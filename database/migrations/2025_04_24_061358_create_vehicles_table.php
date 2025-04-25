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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('metros', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->index();
            $table->foreignId('brand_id')->index();
            $table->foreignId('metro_id')->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('number')->index();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('odometer')->default(0);
            $table->enum('status', array_column(\App\Enums\VehicleStatus::cases(), 'value'))->default(\App\Enums\VehicleStatus::Pending->value);
            $table->timestamps();
        });

        Schema::create('amenity_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('amenity_id')->index();
            $table->foreignId('vehicle_id')->index();
        });

        Schema::create('user_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('vehicle_id')->index();
            $table->enum('role', ['driver', 'helper'])->default('driver');
            $table->timestamps();
        });

        Schema::create('customer_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->index();
            $table->foreignId('vehicle_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('metros');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('user_vehicle');
        Schema::dropIfExists('customer_vehicle');
        Schema::dropIfExists('amenity_vehicle');
    }
};
