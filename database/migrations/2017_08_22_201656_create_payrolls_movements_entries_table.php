<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsMovementsEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls_movements_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movement');
            $table->integer('company');
            $table->float('quantity');
            $table->string('bank');
            $table->string('account');
            $table->string('invoice');
            $table->integer('status');
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
        Schema::drop('payrolls_movements_entries');
    }
}
