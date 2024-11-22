<?php
require('fpdf.php');


$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$producto = $_POST['producto'];
$precio_unitario = $_POST['precio_unitario'];
$cantidad = $_POST['cantidad'];
$precio_total = $precio_unitario * $cantidad;

class PDF extends FPDF {
   
    function Header() {
        
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, 'Factura de Compra', 0, 1, 'C');
        $this->Ln(10);
        
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 10, 'BODEGUITA DE CONFIANZA', 0, 1, 'C');
        $this->Cell(0, 10, 'Direccion: Av. UCV, LIMA', 0, 1, 'C');
        $this->Cell(0, 10, 'Telefono: 910109477', 0, 1, 'C');
        $this->Ln(10);
        
        
        $this->SetDrawColor(0, 0, 0); 
        $this->Line(10, $this->GetY(), 200, $this->GetY()); 
    }

   
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Estilo de tabla
    function SetTableStyle() {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(240, 240, 240); // Color de fondo para las celdas
        $this->SetTextColor(0, 0, 0); // Color del texto
        $this->SetDrawColor(200, 200, 200); // Color de los bordes
        $this->SetLineWidth(0.3);
    }

    function Row($data, $border = 1) {
        foreach ($data as $col) {
            $this->Cell(40, 10, $col, $border, 0, 'L', true);
        }
        $this->Ln();
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Establecer el estilo de la tabla
$pdf->SetTableStyle();

// Título de la sección de datos de la compra
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Datos de la Compra', 0, 1, 'L');
$pdf->Ln(5);

// Encabezado de la tabla de datos
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Campo', 1, 0, 'C', true);
$pdf->Cell(0, 10, 'Valor', 1, 1, 'C', true);

// Datos de la compra
$pdf->SetFont('Arial', '', 12);
$pdf->Row(array('Nombre:', $nombre));
$pdf->Row(array('DNI:', $dni));
$pdf->Row(array('Producto:', $producto));
$pdf->Row(array('Precio Unitario:', 'S/ ' . number_format($precio_unitario, 2)));
$pdf->Row(array('Cantidad:', $cantidad));
$pdf->Row(array('Precio Total:', 'S/ ' . number_format($precio_total, 2)));

// Añadir impuestos (por ejemplo, IVA 18%)
$iva = $precio_total * 0.18;
$pdf->Row(array('IGV (18%):', 'S/ ' . number_format($iva, 2)));

// Total con impuestos
$total_con_iva = $precio_total + $iva;
$pdf->Row(array('Total a Pagar:', 'S/ ' . number_format($total_con_iva, 2)));

// Salto de línea adicional
$pdf->Ln(10);

// Línea de separación
$pdf->SetDrawColor(0, 0, 0); // Color de la línea
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal
$pdf->Ln(5);

// Información adicional
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Gracias por su compra. VUELVA PRONTO!.', 0, 1, 'C');

// Salir y mostrar el PDF
$pdf->Output();
?>
