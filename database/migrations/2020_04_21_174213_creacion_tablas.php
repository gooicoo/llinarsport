<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreacionTablas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('departamento', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->increments('departamento_id');
  		    $table->string('nombre', 20);

  		    $table->timestamps();
  		});

      Schema::create('instalacion', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->integer('instalacion_id');
  		    $table->string('nombre', 100);

  		    $table->primary('instalacion_id');

  		    $table->timestamps();
  		});

      Schema::create('user', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->string('dni', 12);
  		    $table->string('nombre', 20);
  		    $table->string('apellido', 50);
  		    $table->string('password', 512);
  		    $table->string('tipo_empleado', 15);
  		    $table->integer('departamento_id');
  		    $table->integer('instalacion_id')->unsigned();

  		    $table->primary('dni');

  		    $table->index('instalacion_id','fk_user_instalacion1_idx');

  		    $table->foreign('instalacion_id')
  		        ->references('instalacion_id')->on('instalacion');

  		    $table->timestamps();
  		});

      Schema::create('actividad', function(Blueprint $table) {
          $table->engine = 'InnoDB';

          $table->increments('actividad_id');
          $table->string('nombre', 30)->nullable();
          $table->float('precio', 5, 2)->nullable();

          $table->timestamps();
      });

      Schema::create('horas_extra', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->increments('extra_id');
  		    $table->date('fecha');
  		    $table->time('hora_inicio');
  		    $table->time('hora_fin');
  		    $table->integer('hora_total');
  		    $table->string('motivo', 150)->nullable()->default(null);
  		    $table->integer('actividad_id');
  		    $table->boolean('dia_festivo')->nullable()->default(null);
  		    $table->boolean('compensar')->nullable()->default(null);
  		    $table->string('user_dni', 12)->unsigned();

  		    $table->index('user_dni','fk_horas_extra_user1_idx');

  		    $table->foreign('user_dni')
  		        ->references('dni')->on('user');

  		    $table->timestamps();
  		});

      Schema::create('comunicados', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->increments('comunicado_id');
  		    $table->date('fecha');
  		    $table->string('asunto', 45);
  		    $table->string('descripcion', 400);
  		    $table->string('dni_remitente', 12);
  		    $table->string('respuesta', 400)->nullable();
  		    $table->string('dni_user_remp', 45)->nullable()->default(null);

  		    $table->timestamps();
  		});

      Schema::create('actividad_has_user', function(Blueprint $table) {
  		    $table->integer('actividad_actividad_id')->unsigned();
  		    $table->string('user_dni', 12)->unsigned();

  		    $table->primary('actividad_actividad_id', 'user_dni');

  		    $table->index('user_dni','fk_actividad_has_user_user1_idx');
  		    $table->index('actividad_actividad_id','fk_actividad_has_user_actividad1_idx');

  		    $table->foreign('actividad_actividad_id')
  		        ->references('actividad_id')->on('actividad');

  		    $table->foreign('user_dni')
  		        ->references('dni')->on('user');

  		    $table->timestamps();
  		});

      Schema::create('user_has_comunicados', function(Blueprint $table) {
  		    $table->string('dni', 12)->unsigned();
  		    $table->integer('comunicado_id')->unsigned();

  		    $table->primary('dni', 'comunicado_id');

  		    $table->index('comunicado_id','fk_user_has_comunicados_comunicados1_idx');
  		    $table->index('dni','fk_user_has_comunicados_user1_idx');

  		    $table->foreign('dni')
  		        ->references('dni')->on('user');

  		    $table->foreign('comunicado_id')
  		        ->references('comunicado_id')->on('comunicados');

  		    $table->timestamps();
  		});

      Schema::create('tipo_sala', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->increments('id_tipo_sala');
  		    $table->string('nombre', 100);

  		    $table->timestamps();
  		});

      Schema::create('sala', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->increments('sala_id');
  		    $table->date('fecha');
  		    $table->integer('tipo_sala_id')->unsigned();

  		    $table->index('tipo_sala_id','fk_sala_tipo_sala1_idx');

  		    $table->foreign('tipo_sala_id')
  		        ->references('id_tipo_sala')->on('tipo_sala');

  		    $table->timestamps();
  		});

      Schema::create('mensaje', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->increments('mensaje_id');
  		    $table->string('mensaje', 400)->nullable();
  		    $table->date('fecha');
  		    $table->string('url', 3000)->nullable();
  		    $table->integer('sala_id')->unsigned();
  		    $table->string('user_dni', 12)->unsigned();

  		    $table->index('sala_id','fk_mensaje_sala1_idx');
  		    $table->index('user_dni','fk_mensaje_user1_idx');

  		    $table->foreign('sala_id')
  		        ->references('sala_id')->on('sala');

  		    $table->foreign('user_dni')
  		        ->references('dni')->on('user');

  		    $table->timestamps();
  		});

      Schema::create('user_has_sala', function(Blueprint $table) {
  		    $table->string('user_dni', 12)->unsigned();
  		    $table->integer('sala_sala_id')->unsigned();

  		    $table->primary('user_dni', 'sala_sala_id');

  		    $table->index('sala_sala_id','fk_user_has_sala_sala1_idx');
  		    $table->index('user_dni','fk_user_has_sala_user1_idx');

  		    $table->foreign('user_dni')
  		        ->references('dni')->on('user');

  		    $table->foreign('sala_sala_id')
  		        ->references('sala_id')->on('sala');

  		    $table->timestamps();
  		});

      Schema::create('comentario', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->increments('comentario_id');
  		    $table->string('asunto', 45);
  		    $table->string('mensaje', 600)->nullable();
  		    $table->string('url', 3000)->nullable();
  		    $table->dateTime('fecha');
  		    $table->string('user_dni', 12)->unsigned();

  		    $table->index('user_dni','fk_comentario_user1_idx');

  		    $table->foreign('user_dni')
  		        ->references('dni')->on('user');

  		    $table->timestamps();
  		});

  		Schema::create('respuesta', function(Blueprint $table) {
  		    $table->engine = 'InnoDB';

  		    $table->increments('respuesta_id');
  		    $table->string('mensaje', 200);
  		    $table->dateTime('fecha');
  		    $table->string('user_dni', 12)->unsigned();
  		    $table->integer('comentario_id')->unsigned();

  		    $table->index('user_dni','fk_respuesta_user1_idx');
  		    $table->index('comentario_id','fk_respuesta_comentario1_idx');

  		    $table->foreign('user_dni')
  		        ->references('dni')->on('user');

  		    $table->foreign('comentario_id')
  		        ->references('comentario_id')->on('comentario');

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
        Schema::drop('departamento');
        Schema::drop('instalacion');
        Schema::drop('user');
        Schema::drop('actividad');
        Schema::drop('horas_extra');
        Schema::drop('comunicados');
        Schema::drop('actividad_has_user');
        Schema::drop('tipo_sala');
        Schema::drop('sala');
        Schema::drop('mensaje');
        Schema::drop('user_has_sala');
        Schema::drop('respuesta');
        Schema::drop('comentario');
    }
}
