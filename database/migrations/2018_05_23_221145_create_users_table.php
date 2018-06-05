<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function boot()
    {
        Schema::defaultStringLength(191);
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('company_id')->unsigned();
                $table->integer('branch_id')->unsigned()->nullable();
                $table->integer('role_id')->unsigned();
                $table->string('username')->unique();
                $table->string('firstName');
                $table->string('lastName');
                $table->string('email')->unique();
                $table->bigInteger('phoneNo')->nullable();
                $table->string('address')->nullable();;
                $table->string('password');
                $table->boolean('status');
                $table->rememberToken();
                $table->timestamps();

                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            });
        }
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
