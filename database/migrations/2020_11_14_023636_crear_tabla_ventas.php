<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table){
      $table->id();
      $table->timestamps();

      $table->bigInteger('user_id')->unsigned()->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')
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
