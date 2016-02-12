<?php
require_once('codigoControl/codigo_control.class.php');

class CodigoControlController extends \BaseController {

	public function index()
	{
	    try{
	        $statusCode = 200;
	        $response = [
	          'photos'  => []
	        ];
	 
	        $photos = Planilla::all()->take(9);
	 
	        foreach($photos as $photo){
	 
	            $response['photos'][] = [
	                'id' => $photo->id,
	            ];
	        }
	 
	    }catch (Exception $e){
	        $statusCode = 400;
	    }finally{
	        return Response::json($response, $statusCode);
	    }
	 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try{
			//$node = Planilla::find($id);

			/*$autorizacion='29040011007';
			$factura=$node->impuestoFacturaFactores;
			$nit='3363812015';
			$fecha=str_replace("-","",$node->pesoKilosNetosSecosFactores);
			$monto=(integer)$node->impuestoTotalBsSus;
			$CodigoControl = new CodigoControl(
				$autorizacion,
				$factura,
				$nit,
				$fecha,
				$monto,
				'9rCB7Sv4X29d)5k7N%3ab89p-3(5[A'
			);*/
			//$control=$CodigoControl->generar();


			/*$CodigoControl = new CodigoControl(
				'30040010595',
				'10015',
				'953387014',
				'20070825',
				'5726',
				'33E265B43C4435sdTuyBVssD355FC4A6F46sdQWasdA)d56666fDsmp9846636B3'
			);
			$control=$CodigoControl->generar();*/
			
			$statusCode = 200;

			$response = [
			'id'  => $node->id,
			'autorizacion' => $autorizacion,
			'factura' => $factura,
			'nit' => $nit,
			'fecha' => $fecha,
			'monto' => $monto
			];
		}catch (Exception $e){
			$statusCode = 400;
		}finally{
			return Response::json($response, $statusCode);
		}
	}

}

	//public function show($id)
	//{
		//$dosificacion = Dosificacione::find($id);
		//$auto='ZINC';
		//$node = Planilla::where('planilla', $auto)->get();
		//$dosificacion = Dosificacione::where('autorizacion', $auto)->get();
		//$node = Planilla::find($id);
		/*Buscar la informacion para la factura
		NumeroAutorizacion='29040011007' constante
	    NumeroFactura='1503' variable $node->impuestoFacturaFactores
	    NIT/CI:'4189179011' constante 3363812015
	    FechaFactura='20070702' variable $node->pesoKilosNetosSecosFactores
	    MontoFactura='2500' variable $node->impuestoTotalBsSus
	    Clave='9rCB7Sv4X29d)5k7N%3ab89p-3(5[A' constante
		*/
		// Ejemplo de generacion
		//$autorizacion=$dosificacion.autorizacion;

		/*$autorizacion='29040011007';
		$factura=$node->impuestoFacturaFactores;
        $nit='3363812015';
        $fecha=str_replace("-","",$node->pesoKilosNetosSecosFactores);
        $monto=(integer)$node->impuestoTotalBsSus;
        $CodigoControl = new CodigoControl(
		    $autorizacion,
		    $factura,
		    $nit,
		    $fecha,
		    $monto,
		    '9rCB7Sv4X29d)5k7N%3ab89p-3(5[A'
		    );
        $control=$CodigoControl->generar();
        return Response::json($control);*/
        //return $node->id;
	//}
//}