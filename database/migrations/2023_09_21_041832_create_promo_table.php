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
        Schema::create('promo', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->nullable();
            $table->string('image');
            $table->string('type');
            $table->string('promo_name');
            $table->text('description');
            $table->date('outdate_promo');
            $table->text('detail_tutorial');
            $table->text('detail_condition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo');
    }
};
