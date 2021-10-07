<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSolicitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitations', function (Blueprint $table) {
            $table->date('data_coletado')->nullable()->after('data_agendado');
            $table->date('data_expedido')->nullable()->after('data_agendado');
            $table->date('data_enviado')->nullable()->after('data_agendado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('solicitations', function (Blueprint $table) {
            $table->dropColumn('data_coletado');
            $table->dropColumn('data_expedido');
            $table->dropColumn('data_enviado');
        });
    }
}
