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
            $table->unsignedBigInteger('customer_id'); 
            $table->foreign('customer_id')->references('id')->on('customers'); 
            $table->string('address_1'); 
            $table->string('address_2')->nullable(); 
            $table->string('state');
            $table->string('zip_code'); 
            $table->enum('status', ['PENDING', 'SHIPPED', 'COMPLETE', 'REFUNDED', 'CANCELED']);
            $table->double('amount', 9, 2); 
            $table->string('confirmation_number')->nullable(); 
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
