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
            $table->tinyInteger('method_payment')->default(0)->comment("0: 'Parcial', 1 : 'Completo'");
            $table->string('business_name')->nullable();
            $table->string('nit')->nullable();
            $table->decimal('mount', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('discounted_price', 8, 2)->default(0);
            $table->string('start_date');

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('course_id')->constrained('courses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
