<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city')->nullable();
            $table->string('city_without_accent')->nullable();
            $table->string('key_primary')->nullable();
            $table->string('uf')->nullable();
            $table->string('fly_agent')->nullable();
            $table->string('fly_airline_highway')->nullable();
            $table->string('fly_sla')->nullable();
            $table->string('spd_agent')->nullable();
            $table->string('spd_airline_highway')->nullable();
            $table->string('spd_sla')->nullable();
            $table->string('std_agent')->nullable();
            $table->string('std_airline_highway')->nullable();
            $table->string('std_sla')->nullable();
            $table->text('obs')->nullable();
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
        Schema::dropIfExists('capabilities');
    }
}
