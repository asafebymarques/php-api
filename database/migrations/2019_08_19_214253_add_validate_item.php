<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValidateItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitation_items', function (Blueprint $table) {
            $table->date('expiration_date')->nullable()->after('pen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitation_items', function (Blueprint $table) {
            $table->dropColumn('expiration_date');
        });
    }
}
