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
        Schema::create('tb_order', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->string('customer_name', 50);
            $table->string('customer_ap_paterno', 50);
            $table->string('customer_ap_materno', 50);
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('customer_email');
            $table->string('customer_note')->nullable();
            $table->string('payment_method');
            $table->decimal('subtotal', 8, 2)->default(0);
            $table->decimal('tax', 8, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);
            $table->enum('status', ['pending', 'processing', 'completed', 'decline', 'cancel']);
            $table->foreignId('user_id');
            $table->foreignId('delivery_id')->nullable();
            $table->foreignId('establishment_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('delivery_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('establishment_id')->references('id')->on('tb_establishments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_order');
    }
};
