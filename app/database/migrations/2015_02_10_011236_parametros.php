<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parametros extends Migration {

/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parametros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('humedad',15,2);
			$table->double('merma',15,2);
			$table->double('leyesZn',15,2);
			$table->double('leyesAg',15,2);
			$table->double('cotizacionesZn',15,2);
			$table->double('cotizacionesAg',15,2);
			$table->double('alicuotasZn',15,2);
			$table->double('alicuotasAg',15,2);
			$table->double('tipoCambioANB',15,2);
			$table->double('tipoCambioOficial',15,2);			
			$table->string('puertoDestino',50);
			$table->string('paisDestino',50);
	        $table->double('factorKg1',15,7);
            $table->double('factorKg2',15,2);
            $table->double('externo',15,2);
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
		Schema::drop('parametros');
	}

}
