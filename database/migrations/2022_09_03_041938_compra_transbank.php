<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompraTransbank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_transbank', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('session_id');
            $table->float('total',9,2);
            $table->tinyInteger('status')->comment('1: aceptado; 2:rechazado');
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
        //
    }
}
