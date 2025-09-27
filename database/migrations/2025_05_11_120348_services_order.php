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
        Schema::create('services_order', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('customer');
            $table->dateTime('order_date')->nullable()->useCurrent();
            $table->integer('total_funds')->default(0);
            $table->integer('status')->default(0);
            $table->string('pickup_phone');
            $table->string('email');
            $table->string('booking_time');
            $table->integer('id_user');
            $table->integer('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('services_order');
    }
};