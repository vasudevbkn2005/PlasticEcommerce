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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Foreign key to the users table
            $table->string('fullName');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('city');
            $table->string('pin');
            $table->enum('payment_method', ['cod', 'online'])->default('cod');  // Either 'online' or 'cod'
            $table->string('screenshot')->nullable();  // Path to the payment screenshot
            $table->decimal('total', 10, 2);  // Total order price
            $table->decimal('gst', 10, 2);  // GST value
            $table->enum('status', ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
