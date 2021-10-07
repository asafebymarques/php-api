<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivers', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->nullable()->after('id');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eceivers', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropForeign('user_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropForeign('company_id');
        });
    }
}
