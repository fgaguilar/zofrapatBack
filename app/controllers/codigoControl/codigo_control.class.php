<?php 
/**
 * Generacion del codigo de control v7 para impuestos internos de Bolivia
 * 
 * Copyright (c) 2010 Felix A. Carreño B. felix.carreno@gmail.com
 * 
 * Permission is hereby granted, free of charge, to any
 * person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the
 * Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the
 * Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice
 * shall be included in all copies or substantial portions of
 * the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
 * KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
//include 'ChromePhp.php';
class CodigoControl {
	
	// Verhoeff Digit table variables
	var $table_d  = array(
		array(0,1,2,3,4,5,6,7,8,9),
		array(1,2,3,4,0,6,7,8,9,5),
		array(2,3,4,0,1,7,8,9,5,6),
		array(3,4,0,1,2,8,9,5,6,7),
		array(4,0,1,2,3,9,5,6,7,8),
		array(5,9,8,7,6,0,4,3,2,1),
		array(6,5,9,8,7,1,0,4,3,2),
		array(7,6,5,9,8,2,1,0,4,3),
		array(8,7,6,5,9,3,2,1,0,4),
		array(9,8,7,6,5,4,3,2,1,0),
		);
	var $table_p = array(
		array(0,1,2,3,4,5,6,7,8,9),
		array(1,5,7,6,2,8,3,0,9,4),
		array(5,8,0,3,7,9,6,1,4,2),
		array(8,9,1,6,0,4,3,5,2,7),
		array(9,4,5,3,1,2,6,8,7,0),
		array(4,2,8,6,5,7,3,9,0,1),
		array(2,7,9,3,8,0,6,4,1,5),
		array(7,0,4,6,9,1,3,2,5,8),
		);
	var $table_inv = array(0,4,3,2,1,5,6,7,8,9);
	
	var $autorizacion = "";
	var $factura = "";
	var $nitci = "";
	var $fecha = "";
	var $monto = "";
	var $llave = "";
	
	/**
	 * @param string $autorizacion: nro de autorizacion de la factura
	 * @param string $factura: nro de factura
	 * @param string $nitci: nit o ci del cliente
	 * @param string $fecha: fecha de la transaccion (Ymd) e.g. para el 10/08/2010: 20100810
	 * @param string $monto: monto de la transaccion sin decimales
	 * @param string $llave: llave de dosificacion
	 * @return string: codigo de control generado
	 */
	function CodigoControl($autorizacion, $factura, $nitci, $fecha, $monto, $llave) {
		
		$this->autorizacion = $autorizacion;
		$this->factura = $factura;
		$this->nitci = $nitci;
		$this->fecha = $fecha;
		$this->monto = $monto;
		$this->llave = $llave;
		
	}
	/**
	 * Algoritmo de generacion del codigo de control
	 */
	public function generar() {
		//ChromePhp::log('Ingreso a generar');
		//ChromePhp::log($_SERVER);
		//ChromePhp::warn('something went wrong!');
		$autorizacion = $this->autorizacion;
		$factura = $this->factura;
		$nitci = $this->nitci;
		$fecha = $this->fecha;
		$monto = $this->monto;
		$llave = $this->llave;
		// paso 1
		//ChromePhp::log('Factura : '.$factura);
		//ChromePhp::log('NIT : '.$nitci);
		//ChromePhp::log('FECHA ; '.$fecha);
		//ChromePhp::log('MONTO : '.$monto);
		$factura = $this->verhoeff_add_recursive($factura, 2);
		$nitci = $this->verhoeff_add_recursive($nitci, 2);
		$fecha = $this->verhoeff_add_recursive($fecha, 2);
		$monto = $this->verhoeff_add_recursive($monto, 2);
		//ChromePhp::log('Factura : '.$factura);
		//ChromePhp::log('NIT : '.$nitci);
		//ChromePhp::log('FECHA ; '.$fecha);
		//ChromePhp::log('MONTO : '.$monto);
		$suma1 = bcadd($factura, $nitci);
		$suma2 = bcadd($suma1, $fecha);
		$suma3 = bcadd($suma2, $monto);
		$sumat = $factura+$nitci+$fecha+$monto;
		//$suma = bcadd(bcadd(bcadd($factura, $nitci), $fecha), $monto);
		//ChromePhp::log('SUMA1 : '.$suma1);
		//ChromePhp::log('SUMA2 : '.$suma2);
		//ChromePhp::log('SUMA3 : '.$suma3);
		//ChromePhp::log('SUMAT : '.$sumat);
		//ChromePhp::log($_SERVER['DOCUMENT_ROOT']);
		$suma = $this->verhoeff_add_recursive($sumat, 5);
		// paso2
		$digitos = "" . substr($suma, -5);
		$digitossum = array();
		$cadenas = array();
		$inicio = 0;
		foreach (str_split($digitos) as $d) {
			$digitossum[] = $d + 1;
			$cadenas[] = substr($llave, $inicio, $d + 1);
			$inicio += $d + 1;
		}
		$autorizacion .= $cadenas[0];
		$factura .= $cadenas[1];
		$nitci .= $cadenas[2];
		$fecha .= $cadenas[3];
		$monto .= $cadenas[4];
		// paso3
		$arc4 = $this->allegedrc4($autorizacion.$factura.$nitci.$fecha.$monto, $llave.$digitos);
		// paso4
		$suma_total = 0;
		$sumas = array_fill(0, 5, 0);
		$strlen_arc4 = strlen($arc4);
		for ($i = 0; $i < $strlen_arc4; $i++) {
			$x = ord($arc4[$i]);
			$sumas[$i % 5] += $x;
			$suma_total += $x;
		}
		// paso5
		$total = "0";
		foreach ($sumas as $i => $sp) {
			$total = bcadd($total, bcdiv(bcmul($suma_total, $sp), $digitossum[$i]));
		}
		$mensaje = $this->big_base_convert($total);
		return implode("-", str_split($this->allegedrc4($mensaje, $llave.$digitos), 2));
	}
	
	/**
	 * Conversion de numeros en base 10 a base 64 o 16
	 * @param string $numero: numero a convertir
	 * @param string $base: Opcional, convierte a la base indicada
	 * @return string: numero convertido
	 */
	private function big_base_convert($numero, $base = "64") {
		$dic = array(
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
			'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 
			'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 
			'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 
			'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 
			'y', 'z', '+', '/' );
		$cociente = "1";
		$resto = "";
		$palabra = "";
		while (bccomp($cociente, "0")) {
			$cociente = bcdiv($numero, $base);
			$resto = bcmod($numero, $base);
			$palabra = $dic[0 + $resto] . $palabra;
			$numero = "" . $cociente;
		}
		return $palabra;
	}
	
	/**
	 * Algoritmo Alleged RC4
	 * @param string $mensaje: mensaje a cifrar
	 * @param string $llave: llave a utilizar para el cifrado
	 * @return string: cadena cifrada
	 */
	private function allegedrc4($mensaje, $llaverc4) {
		$state = array();
		$x = 0;
		$y = 0;
		$index1 = 0;
		$index2 = 0;
		$nmen = 0;
		$i = 0;
		$cifrado = "";
		
		$state = range(0, 255);
		
		$strlen_llave = strlen($llaverc4);
		$strlen_mensaje = strlen($mensaje);
		for ($i = 0; $i < 256; $i++) {
			$index2 = ( ord($llaverc4[$index1]) + $state[$i] + $index2 ) % 256;
			list($state[$i], $state[$index2]) = array($state[$index2], $state[$i]);
			$index1 = ($index1 + 1) % $strlen_llave;
		}
		for ($i = 0; $i < $strlen_mensaje; $i++) {
			$x = ($x + 1) % 256;
			$y = ($state[$x] + $y) % 256;
			list($state[$x], $state[$y]) = array($state[$y], $state[$x]);
			// ^ = XOR function
			$nmen = ord($mensaje[$i]) ^ $state[ ( $state[$x] + $state[$y] ) % 256];
			$cifrado .= substr("0" . $this->big_base_convert($nmen, "16"), -2);
		}
		return $cifrado;
	}
	/**
	 * Digito Verhoeff
	 */
	private function calcsum($number) {
		$c = 0;
		$n = strrev($number);
	
		$len = strlen($n);
		for ($i = 0; $i < $len; $i++) {
			$c = $this->table_d[ $c ][ $this->table_p[ ($i+1) % 8 ][ $n[$i] ] ];
		}
	
		return $this->table_inv[$c];
	}
	private function verhoeff_add_recursive($number, $digits) {
		$temp = $number;
		while ($digits > 0) {
			$temp .= $this->calcsum($temp);
			$digits--;
		}
		return $temp;
	}

	// funcion de numero a palabras
	function subfijo($xx)
	{ // esta función regresa un subfijo para la cifra
	    $xx = trim($xx);
	    $xstrlen = strlen($xx);
	    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
	        $xsub = "";
	    //
	    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
	        $xsub = "MIL";
	    //
	    return $xsub;
	}

	public function numaletras($xcifra)
	{
	    $xarray = array(0 => "Cero",
	        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
	        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
	        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
	        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
	    );
	//
	    $xcifra = trim($xcifra);
	    $xlength = strlen($xcifra);
	    $xpos_punto = strpos($xcifra, ".");
	    $xaux_int = $xcifra;
	    $xdecimales = "00";
	    if (!($xpos_punto === false)) {
	        if ($xpos_punto == 0) {
	            $xcifra = "0" . $xcifra;
	            $xpos_punto = strpos($xcifra, ".");
	        }
	        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
	        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
	    }

	    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
	    $xcadena = "";
	    for ($xz = 0; $xz < 3; $xz++) {
	        $xaux = substr($XAUX, $xz * 6, 6);
	        $xi = 0;
	        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
	        $xexit = true; // bandera para controlar el ciclo del While
	        while ($xexit) {
	            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
	                break; // termina el ciclo
	            }

	            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
	            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
	            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
	                switch ($xy) {
	                    case 1: // checa las centenas
	                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
	                            
	                        } else {
	                            $key = (int) substr($xaux, 0, 3);
	                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
	                                $xseek = $xarray[$key];
	                                $xsub = $this->subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
	                                if (substr($xaux, 0, 3) == 100)
	                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
	                                else
	                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
	                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
	                            }
	                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
	                                $key = (int) substr($xaux, 0, 1) * 100;
	                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
	                                $xcadena = " " . $xcadena . " " . $xseek;
	                            } // ENDIF ($xseek)
	                        } // ENDIF (substr($xaux, 0, 3) < 100)
	                        break;
	                    case 2: // checa las decenas (con la misma lógica que las centenas)
	                        if (substr($xaux, 1, 2) < 10) {
	                            
	                        } else {
	                            $key = (int) substr($xaux, 1, 2);
	                            if (TRUE === array_key_exists($key, $xarray)) {
	                                $xseek = $xarray[$key];
	                                $xsub = $this->subfijo($xaux);
	                                if (substr($xaux, 1, 2) == 20)
	                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
	                                else
	                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
	                                $xy = 3;
	                            }
	                            else {
	                                $key = (int) substr($xaux, 1, 1) * 10;
	                                $xseek = $xarray[$key];
	                                if (20 == substr($xaux, 1, 1) * 10)
	                                    $xcadena = " " . $xcadena . " " . $xseek;
	                                else
	                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
	                            } // ENDIF ($xseek)
	                        } // ENDIF (substr($xaux, 1, 2) < 10)
	                        break;
	                    case 3: // checa las unidades
	                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
	                        } else {
	                            $key = (int) substr($xaux, 2, 1);
	                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
	                            $xsub = $this->subfijo($xaux);
	                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
	                        } // ENDIF (substr($xaux, 2, 1) < 1)
	                        break;
	                } // END SWITCH
	            } // END FOR
	            $xi = $xi + 3;
	        } // ENDDO

	        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
	            $xcadena.= " DE";

	        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
	            $xcadena.= " DE";

	        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
	        if (trim($xaux) != "") {
	            switch ($xz) {
	                case 0:
	                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
	                        $xcadena.= "UN BILLON ";
	                    else
	                        $xcadena.= " BILLONES ";
	                    break;
	                case 1:
	                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
	                        $xcadena.= "UN MILLON ";
	                    else
	                        $xcadena.= " MILLONES ";
	                    break;
	                case 2:
	                    if ($xcifra < 1) {
	                        $xcadena = "CERO $xdecimales/100";
	                    }
	                    if ($xcifra >= 1 && $xcifra < 2) {
	                        $xcadena = "UN $xdecimales/100";
	                    }
	                    if ($xcifra >= 2) {
	                        $xcadena.= "$xdecimales/100";
	                    }
	                    break;
	            } // endswitch ($xz)
	        } // ENDIF (trim($xaux) != "")
	        // ------------------      en este caso, para México se usa esta leyenda     ----------------
	        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
	        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
	        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
	        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
	        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
	        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
	        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
	    } // ENDFOR ($xz)
	    return trim($xcadena);
	}
	// END FUNCTION
}
?>
