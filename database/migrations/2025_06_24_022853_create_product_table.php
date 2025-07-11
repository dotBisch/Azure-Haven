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
            Schema::create('rooms', function (Blueprint $table) {
                $table->id(); 
                $table->string('room_number');
                $table->string('room_type');
                $table->decimal('room_price', 10, 2);
                $table->text('room_description');
                $table->integer('room_pax');
                $table->text('room_features')->nullable();
                $table->text('room_inclusions')->nullable();
                $table->enum('room_status', ['available', 'occupied', 'maintenance']);
                $table->string('room_image');
                $table->timestamps();
            });
        
            Schema::create('services', function (Blueprint $table) {
                $table->id(); // ← changed from service_id
                $table->string('service_name');
                $table->decimal('service_price', 10, 2);
                $table->text('service_description');
                $table->integer('service_pax');
                $table->timestamps();
            });
        
            // users table assumed to already exist — otherwise define it here
        
            Schema::create('bookings', function (Blueprint $table) {
                $table->id('booking_id');
                $table->foreignId('room_id')->constrained('rooms');
                $table->foreignId('user_id')->constrained('users');
                $table->enum('booking_status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled']);
                $table->decimal('total_amount', 10, 2);
                $table->date('check_in_date');
                $table->date('check_out_date');
                $table->timestamps();
            });

            Schema::create('booking_service', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('booking_id');
                $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
                $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
                $table->timestamps();
            });
        }
    

    /**
     * Reverse the migrations.
     */

        public function down(): void
        {
            Schema::dropIfExists('booking_service');
            Schema::dropIfExists('bookings');
            Schema::dropIfExists('services');
            Schema::dropIfExists('rooms');
        }

};
