<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarritoCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito_compras', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('usuario_id');
            $table->smallInteger('item');
            $table->smallInteger('repuestos_id');
            $table->smallInteger('cantidad');
            $table->double('precio_neto', 8, 2);
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
