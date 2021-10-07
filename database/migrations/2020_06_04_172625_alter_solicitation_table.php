<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSolicitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitations', function (Blueprint $table) {
            $table->string('center_number')->nullable()->after('document');
            $table->string('parkinglist')->nullable()->after('document');
            $table->string('information')->nullable()->after('document');
            $table->string('pi')->nullable()->after('document');

            $table->smallInteger('parcial')->default(1);

            $table->dropUnique(['voucher', 'sends']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitations', function (Blueprint $table) {
            $table->dropColumn('pi');
            $table->dropColumn('information');
            $table->dropColumn('parkinglist');
            $table->dropColumn('center_number');
            $table->dropColumn('parcial');

            $table->unique(['voucher', 'sends']);
        });
    }
}
