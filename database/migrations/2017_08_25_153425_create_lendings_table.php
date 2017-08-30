<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user');
            $table->string('company_emit');
            $table->string('bank_emit');
            $table->integer('company_to');
            $table->string('bank_destiny');
            $table->float('quantity');
            $table->string('comment');
            $table->string('receipt');
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
        Schema::drop('lendings');
    }
}
