<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


		Schema::create('roles', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->string('nombre', 100)->unique();
  
				$table->timestamps();
			});
  
		Schema::create('departamento', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->string('nombre', 20)->unique();
  
				$table->timestamps();
			});
  
		Schema::create('instalacion', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->string('nombre', 100)->unique();
  
				$table->timestamps();
			});
  
		Schema::create('users', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
                $table->increments('id');
				$table->string('dni', 12);
				$table->string('name', 20);
				$table->string('apellido', 50);
			$table->string('email',100);
				$table->string('password', 512);
				$table->integer('fk_role_id')->unsigned();
			$table->integer('fk_departamento_id')->unsigned();
			$table->integer('fk_instalacion_id')->unsigned();
  
			$table->foreign('fk_role_id')
				->references('id')->on('roles')
				->onDelete('cascade');
  
			$table->foreign('fk_departamento_id')
				->references('id')->on('departamento')
				->onDelete('cascade');
  
			$table->foreign('fk_instalacion_id')
				->references('id')->on('instalacion')
				->onDelete('cascade');
  
				$table->timestamps();
			});
  
		Schema::create('actividad', function(Blueprint $table) {
			$table->engine = 'InnoDB';
  
			$table->increments('id');
			$table->string('nombre', 30)->nullable();
			$table->decimal('precio', 5, 2)->nullable();
  
			$table->timestamps();
		});
  
		Schema::create('actividad_has_users', function(Blueprint $table) {
				$table->integer('fk_actividad_id')->unsigned();
				$table->integer('fk_users_id')->unsigned();
  
				$table->foreign('fk_actividad_id')
					->references('id')->on('actividad');
  
				$table->foreign('fk_users_id')
					->references('id')->on('users');
  
				$table->timestamps();
			});
  
		Schema::create('horas_extra', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->date('fecha');
				$table->time('hora_inicio');
				$table->time('hora_fin');
				$table->integer('hora_total');
				$table->string('motivo', 150)->nullable()->default(null);
				$table->boolean('dia_festivo')->nullable()->default(null);
				$table->boolean('compensar')->nullable()->default(null);
				$table->integer('fk_users_id')->unsigned();
			$table->integer('fk_actividad_id')->unsigned();
  
				$table->foreign('fk_users_id')
					->references('id')->on('users');
  
			$table->foreign('fk_actividad_id')
					->references('id')->on('actividad');
  
				$table->timestamps();
			});
  
		Schema::create('comunicados', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->date('fecha');
				$table->string('asunto', 45);
				$table->string('descripcion', 400);
				$table->integer('user_remitente');
				$table->string('respuesta', 400)->nullable();
				$table->integer('user_sustitucion')->nullable()->default(null);
  
				$table->timestamps();
			});
  
		Schema::create('users_has_comunicados', function(Blueprint $table) {
				$table->integer('fk_users_id')->unsigned();
				$table->integer('fk_comunicado_id')->unsigned();
  
				$table->foreign('fk_users_id')
					->references('id')->on('users');
  
				$table->foreign('fk_comunicado_id')
					->references('id')->on('comunicados');
  
				$table->timestamps();
			});
  
		Schema::create('tipo_sala', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->string('nombre', 100);
  
				$table->timestamps();
			});
  
		Schema::create('sala', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->date('fecha');
				$table->integer('fk_tipo_sala_id')->unsigned();
  
				$table->foreign('fk_tipo_sala_id')
					->references('id')->on('tipo_sala');
  
				$table->timestamps();
			});
  
		Schema::create('mensaje', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->string('mensaje', 400)->nullable();
				$table->date('fecha');
				$table->string('url', 3000)->nullable();
				$table->integer('sala_id')->unsigned();
				$table->integer('fk_users_id')->unsigned();
  
				$table->foreign('sala_id')
					->references('id')->on('sala');
  
				$table->foreign('fk_users_id')
					->references('id')->on('users');
  
				$table->timestamps();
			});
  
		Schema::create('users_has_sala', function(Blueprint $table) {
			$table->integer('fk_users_id')->unsigned();
				$table->integer('fk_sala_id')->unsigned();
  
				$table->foreign('fk_users_id')
					->references('id')->on('users');
  
				$table->foreign('fk_sala_id')
					->references('id')->on('sala');
  
				$table->timestamps();
			});
  
		Schema::create('comentario', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->string('asunto', 45);
				$table->string('mensaje', 600)->nullable();
				$table->string('url', 3000)->nullable();
				$table->dateTime('fecha');
			$table->integer('fk_users_id')->unsigned();
  
				$table->foreign('fk_users_id')
					->references('id')->on('users');
  
				$table->timestamps();
			});
  
			Schema::create('respuesta', function(Blueprint $table) {
				$table->engine = 'InnoDB';
  
				$table->increments('id');
				$table->string('mensaje', 200);
				$table->dateTime('fecha');
			$table->integer('fk_users_id')->unsigned();
				$table->integer('fk_comentario_id')->unsigned();
  
				$table->foreign('fk_users_id')
					->references('id')->on('users');
  
				$table->foreign('fk_comentario_id')
					->references('id')->on('comentario');
  
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
		  Schema::drop('roles');
		  Schema::drop('departamento');
		  Schema::drop('instalacion');
		  Schema::drop('users');
		  Schema::drop('actividad');
		  Schema::drop('horas_extra');
		  Schema::drop('comunicados');
		  Schema::drop('actividad_has_users');
		  Schema::drop('tipo_sala');
		  Schema::drop('sala');
		  Schema::drop('mensaje');
		  Schema::drop('users_has_sala');
		  Schema::drop('respuesta');
		  Schema::drop('comentario');
  
	  }
}
