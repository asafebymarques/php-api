<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizedPeopleSolicitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorized_people_solicitation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('solicitation_id')->index()->nullable();
            $table->foreign('solicitation_id')->references('id')->on('solicitations');
            $table->string('name')->nullable();
            $table->string('document')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('authorized_people_solicitation');
    }
}
