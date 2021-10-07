<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditStatusDateColumn extends Migration
{
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitations', function (Blueprint $table) {
            $table->datetime('data_atendimento')->change();
            $table->datetime('data_despachado')->change();
            $table->datetime('data_pendente')->change();
            $table->datetime('data_concluido')->change();
            $table->datetime('data_frustado')->change();
            $table->datetime('data_cancelado')->change();
            $table->datetime('data_agendado')->change();
            $table->datetime('data_aguardando')->change();
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
            $table->date('data_atendimento')->change();
            $table->date('data_despachado')->change();
            $table->date('data_pendente')->change();
            $table->date('data_concluido')->change();
            $table->date('data_frustado')->change();
            $table->date('data_cancelado')->change();
            $table->date('data_agendado')->change();
            $table->date('data_aguardando')->change();
        });
    }
}
