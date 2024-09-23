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
        Schema::table('order', function (Blueprint $table) {
            $table->foreign('account_id', 'add_fk_account_id_to_accounts')->references('id')->on('accounts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('menu_id', 'add_fk_menu_id_to_menu')->references('id')->on('menu')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('promo_id', 'add_fk_promo_id_to_promo')->references('id')->on('promo')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            Schema::dropForeign('add_fk_account_id_to_accounts');
            Schema::dropForeign('add_fk_menu_id_to_menu');
            Schema::dropForeign('add_fk_promo_id_to_promo');
        });
    }
};
