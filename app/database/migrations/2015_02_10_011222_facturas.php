<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Facturas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facturas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('fecha');
			$table->string('factura',20);
			$table->string('nit',20);
			$table->string('comprador',50);
			$table->string('direccion',50);
			$table->string('puertoTransito',50);
			$table->string('puertoDestino',50);
			$table->string('paisDestino',50);
			$table->string('origen',50);
			$table->string('numeroLote',50);
			$table->double('pesoKilosNetosHumedosPeso',15,2);
			$table->double('pesoHumedadPesos',6,2);
			$table->double('pesoHumedadPeso',15,2);
			$table->double('pesoMermaPesos',6,2);
			$table->double('pesoMermaPeso',15,2);
			$table->double('contenidoZnLeyes',6,2);
			$table->double('contenidoZnPesokg',15,2);
			$table->double('baseZnCotizaciones',6,2);
			$table->double('contenidoZnPesolf',15,2);
			$table->double('pesoKilosNetosSecosPeso',15,2);
			$table->double('contenidoAgLeyes',8,2);
			$table->double('contenidoAgPesokg',8,2);
			$table->double('baseAgCotizaciones',8,2);
			$table->double('contenidoAgPesoot',15,2);
			$table->double('baseZnSus',15,2);
			$table->double('baseAgSus',15,2);
			$table->double('baseTotalSus',15,2);
			$table->double('basePromedioSus',15,2);
			$table->double('baseDiferenciaSus',15,2);
			$table->double('tipoCambio',6,2);
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
		Schema::drop('facturas');
	}

}
