 <?php   
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial','B',8);

        $fpdf->SetXY(10, 10);
        $fpdf->Cell(60,10,'POTOSI: ',0,2,'L');
        $fpdf->Cell(60,10,'FACTURA: ',1,2,'L');
        $fpdf->Cell(60,10,'NIT: ',1,2,'L');
        $fpdf->Cell(60,10,'COMPRADOR: ',1,2,'L');
        $fpdf->Cell(60,10,'DIRECCION: ',1,2,'L');
        $fpdf->Cell(60,10,'PUERTO EN TRANSITO: ',1,2,'L');
        $fpdf->Cell(60,10,'PUERTO DESTINO: ',1,2,'L');
        $fpdf->Cell(60,10,'PAIS DESTINO: ',1,2,'L');
        $fpdf->Cell(60,10,'CONCENTRADO A GRANEL DE: ',1,2,'L');
        $fpdf->Cell(60,10,'PARTIDA ARANCELARIA: ',1,2,'L');
        $fpdf->Cell(60,10,'ORIGEN: ',1,2,'L');
        $fpdf->Cell(60,10,'No LOTE: ',1,2,'L');
        $fpdf->Cell(60,10,'CODIGO DE CONTROL ',1,2,'L');

        $fpdf->SetXY(70, 10);
        $fpdf->Cell(125,10,$factura->fecha,1,2,'L');
        $fpdf->Cell(125,10,$factura->factura,1,2,'L');
        $fpdf->Cell(125,10,$factura->nit,1,2,'L');
        $fpdf->Cell(125,10,$factura->comprador,1,2,'L');
        $fpdf->Cell(125,10,$factura->direccion,1,2,'L');
        $fpdf->Cell(125,10,$factura->puertoTransito,1,2,'L');
        $fpdf->Cell(125,10,$factura->puertoDestino,1,2,'L');
        $fpdf->Cell(125,10,$factura->paisDestino,1,2,'L');
        $fpdf->Cell(125,10,'ZINC-PLATA',1,2,'L');
        $fpdf->Cell(125,10,'2608.00.00.00          2616.10.00.00',1,2,'L');
        $fpdf->Cell(125,10,$factura->origen,1,2,'L');
        $fpdf->Cell(125,10,$factura->numeroLote,1,2,'L');
        $fpdf->Cell(125,10,$factura->codigo,1,2,'L');
        $fpdf->Image($_SERVER['DOCUMENT_ROOT'].'/face_laravel/public/qrcode.png',150,8,50,'PNG');
        $fpdf->Output();
        exit;
 ?>