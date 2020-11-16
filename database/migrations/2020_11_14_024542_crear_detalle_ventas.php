<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearDetalleVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
      Schema::create('ventas_detalle', function (Blueprint $table){
      $table->id();

      



    $table->bigInteger('producto_id')->unsigned()->nullable();
            
            $table->foreign('producto_id')->references('id')->on('productos')
            ->onDelete('SET NULL')
            ->onUpdate('CASCADE');

      $table->bigInteger('venta_id')->unsigned()->nullable();
            
            $table->foreign('venta_id')->references('id')->on('productos')
            ->onDelete('SET NULL')
            ->onUpdate('CASCADE');




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
