<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cnpj',20)->nullable();
            $table->string('name')->nullable();
            $table->string('contact_name',50)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('email',100)->unique()->nullable();
            $table->string('logo')->nullable();
            $table->text('status');
            $table->boolean('ativo')->default(true);
            $table->smallInteger('fiscal')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
