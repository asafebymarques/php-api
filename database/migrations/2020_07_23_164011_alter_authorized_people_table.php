<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAuthorizedPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authorized_people', function (Blueprint $table) {
            $table->string('name')->nullable()->change();;
            $table->string('document')->nullable()->change();;
            $table->string('phone')->nullable()->change();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authorized_people', function (Blueprint $table) {
            $table->date('name')->nullable(false)->change();
            $table->integer('document')->nullable(false)->change();
            $table->integer('phone')->nullable(false)->change();
        });
    }
}
