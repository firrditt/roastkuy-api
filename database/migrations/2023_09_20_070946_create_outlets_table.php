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
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('outlet_name');
            $table->string('address');
            $table->string('lat');
            $table->string('lon');
            $table->string('operation_time');
            $table->string('contact');
            $table->text('gofood_link')->nullable();
            $table->text('shopeefood_link')->nullable();
            $table->text('grabfood_link')->nullable();
            $table->text('travelokaeats_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
