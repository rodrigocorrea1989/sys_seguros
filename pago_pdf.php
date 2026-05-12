<?php

require('fpdf/fpdf.php');

include('conn.php');

// VALIDAR DATOS

$id_cliente = intval($_GET['id'] ?? 0);
$id_pago = intval($_GET['id_pago'] ?? 0);

if (!$id_cliente || !$id_pago) {
    die("Datos inválidos");
}

// CONSULTA

$sql = "
SELECT 
    clientes.NOMBRE,
    clientes.APELLIDO,
    clientes.DNI,
    clientes.DIRECCION,
    clientes.WHATSAPP,
    pagos.monto,
    pagos.fecha_creacion,
    pagos.fecha_vencimiento,
    seguros.nombre AS seguro,
    seguros.descripcion AS des,
    polizas.numero AS npoliza,
    pagos.fecha_pago AS fecha_pago
FROM pagos

INNER JOIN polizas 
    ON pagos.id_poliza = polizas.id

INNER JOIN clientes 
    ON polizas.id_cliente = clientes.ID

INNER JOIN seguros 
    ON polizas.id_seguro = seguros.id

WHERE pagos.id = ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id_pago);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No existe el pago");
}

$row = $result->fetch_assoc();

// DATOS

$nombre = $row['NOMBRE'];
$apellido = $row['APELLIDO'];
$dni = $row['DNI'];
$direccion = $row['DIRECCION'];
$telefono = $row['WHATSAPP'];
$des = $row['des'];
$npoliza = $row['npoliza'];

$seguro = $row['seguro'];

$monto = number_format((float)$row['monto'], 2, ',', '.');

$fecha_pago = date(
    'd/m/Y H:i',
    strtotime($row['fecha_pago'])
);

$fecha_vencimiento = date(
    'd/m/Y',
    strtotime($row['fecha_vencimiento'])
);

// PDF

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 18);

$pdf->Cell(190, 10, utf8_decode('Comprobante de Pago'), 0, 1, 'C');

$pdf->Ln(10);

// CLIENTE

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, 'Cliente:');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 10, utf8_decode($nombre . ' ' . $apellido), 0, 1);

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, 'DNI/CUIT:');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 10, $dni, 0, 1);

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, utf8_decode('Dirección:'));

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 10, utf8_decode($direccion), 0, 1);

$pdf->SetFont('Arial', 'B', 12);


// PAGO

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, 'Seguro:');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 10, utf8_decode($seguro), 0, 1);

$pdf->SetFont('Arial', 'B', 12);

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, 'Num. de Poliza:');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 10,  $npoliza, 0, 1);

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, 'Monto Pagado:');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 10, '$ ' . $monto, 0, 1);

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, 'Fecha Pago:');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 10, $fecha_pago, 0, 1);

$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, 'Vencimiento:');

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 10, $fecha_vencimiento, 0, 1);

$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(50, 10, utf8_decode('Descripción:'));

$pdf->SetFont('Arial', '', 12);

$pdf->MultiCell(140, 10, utf8_decode($des));

$pdf->SetFont('Arial', 'B', 12);

$pdf->Ln(20);

$pdf->Cell(
    190,
    10,
    utf8_decode('Comprobante generado automáticamente'),
    0,
    1,
    'C'
);

// MOSTRAR PDF

$pdf->Output();
