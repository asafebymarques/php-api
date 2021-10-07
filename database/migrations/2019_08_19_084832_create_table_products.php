<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->text('active_principle')->nullable();
            $table->string('cnpj',20);
            $table->string('laboratory')->nullable();
            $table->string('ggrem')->nullable();
            $table->string('registry')->nullable();
            $table->string('ean')->nullable();
            $table->string('product');
            $table->text('presentation');
            $table->string('information')->nullable();
            $table->string('manifestation')->nullable();
            $table->enum('discontinued',['sim','nao'])->default('nao');
            $table->date('release_date')->nullable();
            $table->string('code_protheus',15)->nullable();
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
        Schema::dropIfExists('products');
    }
}
