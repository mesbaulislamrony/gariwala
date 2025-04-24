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
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('number')->index();
            $table->foreignId('type_id')->index()->constrained()->onDelete();
            $table->foreignId('brand_id')->index()->constrained()->onDelete();
            $table->foreignId('metro_id')->index()->constrained()->onDelete();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price_per_hour', 8, 2);
            $table->enum('status', ['pending', 'running', 'closed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('user_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->index()->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('customer_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->index()->constrained()->onDelete('cascade');
            $table->timestamps();
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
    }
};
