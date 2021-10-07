<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('role',['admin','cli-admin','cli-user','drs-supervisor','drs-analyst','drs-attendant'])
                ->default('drs-attendant');
            $table->enum('status',['ativo','inativo'])->default('ativo');
            $table->string('email')->unique();
            $table->string('img_profile')->default('default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('extension')->nullable();
            $table->rememberToken();
            $table->datetime('last_login_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
