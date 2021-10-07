<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSchedulingAttempts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduling_attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone',100);
            $table->string('reason',100)->nullable();
            $table->string('duration',100)->nullable();
            $table->enum('sms',['sim','nao'])->default('sim');
            $table->enum('success',['sim','nao'])->default('sim');
            $table->uuid('solicitation_id')->index()->nullable();
            $table->foreign('solicitation_id')->references('id')->on('solicitations');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('scheduling_attempts');
    }
}
