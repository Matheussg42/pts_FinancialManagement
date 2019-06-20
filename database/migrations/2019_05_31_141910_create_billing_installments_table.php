billing_installments<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billingInstallments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('fk_user_id');
            $table->foreign('fk_user_id')->references('id')->on('users');
            $table->string('name');
            $table->float('value');
            $table->longText('comment');
            $table->integer('installments');
            $table->string('begin');
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
        Schema::dropIfExists('billingInstallments');
    }
}
