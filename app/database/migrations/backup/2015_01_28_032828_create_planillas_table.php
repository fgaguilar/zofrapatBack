<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanillasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planillas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('planilla',10);
			$table->double('pesoKilosNetosHumedosPeso',15,2);
			$table->double('pesoKilosNetosHumedosFactores',15,7);
			$table->double('pesoHumedadPesos',6,2);
			$table->double('pesoHumedadPeso',15,2);
		    $table->double('pesoHumedadFactores',15,7);
			$table->double('pesoMermaPesos',6,2);
		    $table->double('pesoMermaPeso',15,2);
		    $table->double('pesoMermaFactores',6,2);
		    $table->double('pesoKilosNetosSecosPeso',15,2);
		    $table->date('pesoKilosNetosSecosFactores');
		    $table->string('pesoLoteFactores',50);			
		    $table->string('contenidoListaEmpaqueFactores',10);
		    $table->double('contenidoZnLeyes',6,2);
		    $table->double('contenidoZnPesokg',15,2);
		    $table->double('contenidoZnTipoDeCambioFactores',6,2);
		    $table->double('contenidoZnPesolf',15,2);
		    $table->double('contenidoAgLeyes',8,2);		    
		    $table->double('contenidoAgPesokg',8,2);
		    $table->double('contenidoAgFleteTotalFactores',8,2);		    
		    $table->double('contenidoAgPesoot',15,2);
		    $table->double('contenidoAgInternoFactores',8,2);
		    $table->double('contenidoAgExternoFactores',8,2);
		    $table->double('baseZnCotizaciones',6,2);		    
		    $table->double('baseZnSus',15,2);
		    $table->double('baseZnContenedoresFactores',6,2);
		    $table->double('baseAgCotizaciones',8,2);		    
		    $table->double('baseAgSus',15,2);
		    $table->double('baseAgTaraTotalFactores',15,2);		    
		    $table->double('baseTotalSus',15,2);
		    $table->double('baseTotalPesoBrutoFactores',15,2);		    
		    $table->double('basePromedioSus',15,2);
		    $table->double('baseDiferenciaSus',15,2);
		    $table->string('baseDiferenciaDueFactores',15);
		    $table->string('impuestoFacturaFactores',15);
		    $table->double('impuestoZnAlicuota',15,2);		    
		    $table->double('impuestoZnSus',15,2);
		    $table->double('impuestoZnValorConcentradoFactores',15,6);
		    $table->double('impuestoAgAlicuota',15,2);		    
		    $table->double('impuestoAgSus',15,2);
		    $table->double('impuestoTotalSusSus',15,2);
		    $table->double('impuestoTotalBsSus',15,2);
		    $table->string('puertoDestino',50);
		    $table->string('paisDestino',50);
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
		Schema::drop('planillas');
	}

}
