<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulingSolicitations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduling_solicitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('solicitation_id')->index()->nullable();
            $table->foreign('solicitation_id')->references('id')->on('solicitations');
            $table->date('date_scheduling');
            $table->dateTime('date_canceled')->nullable();
            $table->string('schedule_time')->nullable();
            $table->string('auth_contact')->nullable();
            $table->string('user_create');
            $table->string('user_canceled')->nullable();
            $table->enum('period',['manha','tarde','comercial'])->default('manha');
            $table->enum('status',['ativo','inativo'])->default('ativo');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('scheduling_solicitations');
    }
}
