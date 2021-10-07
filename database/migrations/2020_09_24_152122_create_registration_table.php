<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('solicitation_id')->index()->nullable();
            $table->foreign('solicitation_id')->references('id')->on('solicitations');
            $table->integer('attempt')->default(1);
            $table->dateTime('date_attempt');
            $table->string('document')->nullable();
            $table->enum('status',['success','failure'])->default('failure');
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
        Schema::dropIfExists('registration');
    }
}
