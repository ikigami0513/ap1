<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../class/Pdf.php");
    require("../settings.php");
    require("../request/connexionBdd.php");
    require("../request/request.php");

    $pdo = connexionBdd();
    $data = getAllDemandeEnCours($pdo);

    $pdf = new Pdf('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Helvetica', '', 9);
    $pdf->SetTextColor(0);
    $pdf->AliasNbPages();
    $pdf->enteteTable(70, $data[0]);
    $pdf->fillTable($data);

    $pdf->Output('tache.pdf', 'I');
?>