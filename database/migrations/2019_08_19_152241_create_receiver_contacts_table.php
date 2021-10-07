<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePatientContactsTable.
 */
class CreateReceiverContactsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('receiver_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('receiver_id')->unsigned()->nullable();
            $table->foreign('receiver_id')->references('id')->on('receivers');
            $table->string('content');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->enum('type', ['phone', 'cellphone','email'])->default('phone');
            $table->boolean('principal')->default(false);
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
		Schema::drop('receiver_contacts');
	}
}
