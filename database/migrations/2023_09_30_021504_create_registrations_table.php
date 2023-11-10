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
            $table->timestamp('date_update')->nullable();
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
