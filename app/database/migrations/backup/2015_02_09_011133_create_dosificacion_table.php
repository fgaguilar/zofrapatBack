<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosificacionTable extends Migration {
/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dosificaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('autorizacion');
			$table->string('clave');
			$table->date('inicio');
			$table->date('vencimiento');
			$table->integer('numero');
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
		Schema::drop('dosificaciones');
	}

}
