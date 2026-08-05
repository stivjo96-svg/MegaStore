<?php

require_once 'pdf/FacturaPDF.php';

$pdf = new FacturaPDF();

$pdf->generarPrueba();