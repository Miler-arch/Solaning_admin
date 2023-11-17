<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('detail_register_id');

            $table->decimal('mount_update', 8, 2);
            $table->decimal('mount_inicial', 8, 2);
            $table->string('date_start');
            $table->timestamp('date_update')->nullable();
            $table->string('updated_type_payment')->nullable()->comment("0: 'Efectivo', 1 : 'DepositoBancario', 2: 'Transferencia', 3: 'QR'");
            $table->string('type_payment_inicial')->nullable()->comment("0: 'Efectivo', 1 : 'DepositoBancario', 2: 'Transferencia', 3: 'QR'");
            $table->string('file_path')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('detail_register_id')->references('id')->on('detail_registers');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
