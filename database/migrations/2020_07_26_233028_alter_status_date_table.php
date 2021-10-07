<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStatusDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("ALTER TABLE solicitations CHANGE COLUMN status status ENUM('aberto', 'atendimento','despachado','pendente','concluido','frustado','cancelado','agendado', 'aguardando', 'coletado', 'expedido', 'enviado') DEFAULT 'aberto'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::statement("ALTER TABLE solicitations CHANGE status status ENUM('aberto', 'atendimento','despachado','pendente','concluido','frustado','cancelado','agendado', 'aguardando', 'coletado', 'expedido', 'enviado')");
    }
}
