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
        Schema::create('detail_registers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');


            $table->tinyInteger('method_payment')->default(0)->comment("0: 'Parcial', 1 : 'Completo'");
            $table->string('business_name')->nullable();
            $table->string('nit')->nullable();
            $table->decimal('mount', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('discounted_price', 8, 2)->default(0);
            $table->string('type_payment')->nullable()->comment("0: 'Efectivo', 1 : 'DepositoBancario', 2: 'Transferencia', 3: 'QR'");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_registers');
    }
};
