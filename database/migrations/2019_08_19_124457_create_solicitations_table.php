<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->bigInteger('receiver_id')->unsigned()->nullable();
            $table->foreign('receiver_id')->references('id')->on('receivers');
            $table->bigInteger('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status',['aberto', 'atendimento','despachado','pendente','concluido','frustado','cancelado','agendado', 'aguardando'])->default('aberto');
            $table->string('voucher');
            $table->string('description_other_type')->nullable();
            $table->string('document')->nullable();
            $table->date('data_atendimento')->nullable();
            $table->date('data_despachado')->nullable();
            $table->date('data_pendente')->nullable();
            $table->date('data_concluido')->nullable();
            $table->date('data_frustado')->nullable();
            $table->date('data_cancelado')->nullable();
            $table->enum('type',['delivery','collect','other','exchange'])->default('delivery');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitations');
    }
}
