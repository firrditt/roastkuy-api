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
        Schema::table('menu_has_complement', function (Blueprint $table) {
            $table->foreign('menu_id', 'fk_menu_id_to_menu')->references('id')->on('menu')->onDelete('CASCADE')->onDelete('CASCADE');
            $table->foreign('complement_id', 'fk_complement_id_to_complement')->references('id')->on('complement')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_has_complement', function (Blueprint $table) {
            Schema::dropForeign('fk_menu_id_to_menu');
            Schema::dropForeign('fk_complement_id_to_complement');
        });
    }
};
