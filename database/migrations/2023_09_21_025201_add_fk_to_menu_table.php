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
        Schema::table('menu', function (Blueprint $table) {
            $table->foreign('outlet_id', 'fk_outlet_id_to_outlets')->references('id')->on('outlets')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            Schema::dropForeign('fk_outlet_id_to_outlets');
        });
    }
};
