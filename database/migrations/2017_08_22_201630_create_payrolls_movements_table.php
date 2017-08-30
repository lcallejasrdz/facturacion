<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer');
            $table->integer('user');
            $table->integer('status');
            $table->integer('facturation_invoices');
            $table->integer('facturation_payments');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payrolls_movements');
    }
}
