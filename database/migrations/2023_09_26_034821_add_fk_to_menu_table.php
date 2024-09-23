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
            $table->foreign('category_id', 'fk_category_id_to_menu_category')->references('id')->on('menu_category')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            Schema::dropForeign('fk_category_id_to_menu_category');
        });
    }
};
