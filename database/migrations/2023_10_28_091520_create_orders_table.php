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
            $table->string('invoice_no')->length(250)->nullable();
            $table->string('first_name')->length(250)->nullable();
            $table->string('last_name')->length(250)->nullable();
            $table->string('address')->length(250)->nullable();
            $table->string('pincode')->length(250)->nullable();
            $table->string('country')->length(250)->nullable();
            $table->string('user_id')->length(250)->nullable();
            $table->string('product_id')->length(250)->nullable();
            $table->string('quantity')->length(250)->nullable();
            $table->string('name')->length(250)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('total_price', 8, 2)->nullable();
            $table->string('image')->length(250)->nullable();
            $table->text('description')->length(250)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
