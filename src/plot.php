<?php
require('./backend/dbcon.php');

require_once ('../src/jpgraph/src/jpgraph.php');
require_once ('../src/jpgraph/src/jpgraph_pie.php');

$sql = "SELECT motif, SUM(montantEntre) as montantEntre FROM ENTREE WHERE ideglise=:id_eglise GROUP BY motif";
$id_eglise = $_GET['id'];
$sql_run = $conn->prepare($sql);
$sql_run->bindParam(':id_eglise', $id_eglise);
$sql_run->execute();
$data = $sql_run->fetchAll(PDO::FETCH_ASSOC);

$montants = array();
$motifs = array();
$colors = array('#1C39BB','#00A693','#F77FBE','#683332','#EC5800','#CD853F' ,'#DA9790','#826663','#F8EA97','#5BA0D0','#FDD7E4','#FDD7E4','#00FF7F');


foreach ($data as $row) {
    $montants[] = $row['montantEntre'];
    $motifs[] = $row['motif'];
}


$graph = new PieGraph(1200, 580);

$graph->title->Set('Incomes pie chart of the church group by motif');
$graph->title->SetFont(FF_FONT1, FS_BOLD);

$p1 = new PiePlot($montants);
$graph->Add($p1);
$p1->SetStartAngle(90);
$p1->SetSize(150);
$p1->SetShadow('lightgray', 2);
$p1->SetSliceColors($colors);
$p1->ShowBorder();
$p1->SetLegends($motifs);

$graph->Stroke();
