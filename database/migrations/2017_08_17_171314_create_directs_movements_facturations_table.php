<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectsMovementsFacturationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directs_movements_facturations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movement');
            $table->integer('company_emit');
            $table->string('bank_emit');
            $table->integer('company_to');
            $table->string('bank_destiny');
            $table->float('quantity');
            $table->integer('final_account');
            $table->string('invoice');
            $table->integer('receipt');
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
        Schema::drop('directs_movements_facturations');
    }
}
