<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nature_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->string('account_name');
            $table->bigInteger('account_number');
            $table->string('account_desc');
            $table->bigInteger('account_contactNo');
            $table->string('account_Address');
            $table->double('opening_debit');
            $table->double('opening_credit');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('nature_id')->references('id')->on('account_natures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
