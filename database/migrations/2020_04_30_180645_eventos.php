<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Eventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
      public function up()
      {
          Schema::create('eventos', function(Blueprint $table) {
              $table->engine = 'InnoDB';

              $table->increments('id');
              $table->string('titulo',255);
              $table->string('description',255);
              $table->dateTime('inicio');
              $table->dateTime('fin');

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
          Schema::drop('eventos');

      }
}