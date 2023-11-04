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
        Schema::create('payfast_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('m_payment_id');
            $table->string('pf_payment_id');
            $table->string('payment_status');
            $table->string('item_name');
            $table->decimal('amount_gross', 10, 2);
            // Add other fields as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payfast_notifications');
    }
};
