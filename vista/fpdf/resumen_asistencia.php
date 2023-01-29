<?php

if (!empty($_GET["txtfechainicio"]) and !empty($_GET["txtfechafinal"]) and !empty($_GET["txtpersona"])) {
   require('./fpdf.php');

   $fechainicio=$_GET["txtfechainicio"];
   $fechafinal=$_GET["txtfechafinal"];
   $persona=$_GET["txtpersona"];

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../modelo/conexion.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('headerH.png', 47, 0, 211); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode(''), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 0, 0);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("RESUMEN DE ASISTENCIAS"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(163, 163, 163); //colorFondo
      $this->SetTextColor(0, 0, 0); //colorTexto
      $this->SetDrawColor(0, 0, 0); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(10, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(62, 10, utf8_decode('NOMBRE Y APELLIDO'), 1, 0, 'C', 1);
      $this->Cell(24, 10, utf8_decode('CI'), 1, 0, 'C', 1);
      $this->Cell(34, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('SALIDA'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('HORAS'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../../modelo/conexion.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

if ($persona == "todos") {
   $sql=$conexion->query (" SELECT
      asistencia.id_asistencia,
      asistencia.id_persona,
      date_format(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as 'entrada',
      date_format(asistencia.salida, '%m-%d-%Y %H:%i:%s') as 'salida',
       TIMEDIFF(asistencia.salida,asistencia.entrada) as 'totalHR',
       persona.nombre,
       persona.apellido,
       persona.ci,
       des.nombre as 'des'
       FROM
       asistencia
       INNER JOIN persona ON asistencia.id_persona = persona.id_persona
       INNER JOIN des ON persona.des = des.id_des
       where entrada BETWEEN '$fechainicio' and '$fechafinal' order by id_persona asc ");
} else {
   $sql=$conexion->query("SELECT
      asistencia.id_asistencia,
      asistencia.id_persona,
      date_format(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as 'entrada',
       date_format(asistencia.salida, '%m-%d-%Y %H:%i:%s') as 'salida',
       date_format(asistencia.salida, '%m-%d-%Y %H:%i:%s') as 'salida',
       TIMEDIFF(asistencia.salida,asistencia.entrada) as 'totalHR',
       persona.nombre,
       persona.apellido,
       persona.ci,
       des.nombre as 'des'
       FROM
       asistencia
       INNER JOIN persona ON asistencia.id_persona = persona.id_persona
       INNER JOIN des ON persona.des = des.id_des
       where asistencia.id_persona=$persona and entrada BETWEEN '$fechainicio' and '$fechafinal' order by id_asistencia asc");
}

$consulta_reporte_asistencia = $conexion->query(" select asistencia.entrada,asistencia.salida,persona.nombre,persona.apellido,persona.ci,des.nombre as'nomDes' from asistencia
inner join persona ON asistencia.id_persona=persona.id_persona 
inner join des ON persona.des=des.id_des");

while ($datos_reporte = $sql->fetch_object()) {    
   $i = $i + 1;
   /* TABLA */
   $pdf->Cell(10, 10, utf8_decode("$i"), 1, 0, 'C', 0);
   $pdf->Cell(62, 10, utf8_decode($datos_reporte->nombre ." ".$datos_reporte->apellido), 1, 0, 'C', 0);
   $pdf->Cell(24, 10, utf8_decode($datos_reporte->ci), 1, 0, 'C', 0);
   $pdf->Cell(34, 10, utf8_decode($datos_reporte->des), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->entrada), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->salida), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->totalHR), 1, 1, 'C', 0);

   }


$pdf->Output('ReporteDeAsistencia.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)

}

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../modelo/conexion.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('headerH.png', 47, 0, 211); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode(''), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode(""), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 0, 0);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIA"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(163, 163, 163); //colorFondo
      $this->SetTextColor(0, 0, 0); //colorTexto
      $this->SetDrawColor(0, 0, 0); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(80, 10, utf8_decode('NOMBRE Y APELLIDO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('CI'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('SALIDA'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../../modelo/conexion.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_asistencia = $conexion->query(" select asistencia.entrada,asistencia.salida,persona.nombre,persona.apellido,persona.ci,des.nombre as'nomDes' from asistencia
inner join persona ON asistencia.id_persona=persona.id_persona 
inner join des ON persona.des=des.id_des");

while ($datos_reporte = $consulta_reporte_asistencia->fetch_object()) {    
   $i = $i + 1;
   /* TABLA */
   $pdf->Cell(15, 10, utf8_decode("$i"), 1, 0, 'C', 0);
   $pdf->Cell(80, 10, utf8_decode($datos_reporte->nombre ." ".$datos_reporte->apellido), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->ci), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->nomDes), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->entrada), 1, 0, 'C', 0);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->salida), 1, 1, 'C', 0);

   }


$pdf->Output('ResumenDeAsistencia.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
