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
            $table->string('code', 25)->unique();
            $table->string('order_status');
            $table->float('order_total_paid', 8, 2);
            $table->float('order_fee', 8, 2);
            $table->float('order_cost', 8, 2);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_payment')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_payment')->references('id')->on('payments');
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
