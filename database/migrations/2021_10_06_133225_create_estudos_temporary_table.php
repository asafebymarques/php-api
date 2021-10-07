<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudosTemporaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudos_temporary', function (Blueprint $table) {
            $table->string('voucher')->nullable();
            $table->string('cod_depositante')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('empresa_logix')->nullable();
            $table->string('cod_tp_estoque')->nullable();
            $table->string('desc_reduz_tp_estoque')->nullable();
            $table->string('descricao_tp_estoque')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudos_temporary');
    }
}
