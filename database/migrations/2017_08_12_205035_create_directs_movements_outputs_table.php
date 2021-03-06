<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectsMovementsOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directs_movements_outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movement');
            $table->string('company');
            $table->string('bank_destiny');
            $table->string('type');
            $table->float('quantity');
            $table->string('disperser');
            $table->string('bank_origen');
            $table->string('comment');
            $table->string('receipt');
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
        Schema::drop('directs_movements_outputs');
    }
}
