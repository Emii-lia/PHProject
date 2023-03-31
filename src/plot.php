<?php
require('./backend/dbcon.php');

require_once ('../src/jpgraph/src/jpgraph.php');
require_once ('../src/jpgraph/src/jpgraph_bar.php');

$id_eglise = $_GET['id'];
// Récupération des données depuis la base de données
$sql = "SELECT DATE_FORMAT(date, '%b') AS mois, SUM(entrees) AS entrees, SUM(sorties) AS sorties
FROM (
    SELECT DATE_FORMAT(dateEntre, '%Y-%m-01') AS date, SUM(montantEntre) AS entrees, 0 AS sorties
    FROM ENTREE
    WHERE ideglise = :id_eglise
    GROUP BY DATE_FORMAT(dateEntre, '%Y-%m-01')
    UNION ALL
    SELECT DATE_FORMAT(dateSortie, '%Y-%m-01') AS date, 0 AS entrees, SUM(montantSortie) AS sorties
    FROM SORTIE
    WHERE ideglise = :id_eglise
    GROUP BY DATE_FORMAT(dateSortie, '%Y-%m-01')
) AS subquery
GROUP BY DATE_FORMAT(date, '%b')";

$sql_run = $conn->prepare($sql);
$data = [":id_eglise" => $id_eglise];
$sql_run->execute($data);

$result = $sql_run->fetchAll(PDO::FETCH_ASSOC);

// Initialisation des tableaux de données
$mois = array();
$entrees = array();
$sorties = array();
$solde = array();

// Récupération des données dans les tableaux
foreach ($result as $row) {
  $mois[] = $row['mois'];
  $entrees[] = $row['entrees'];
  $sorties[] = $row['sorties'];
}
for($i=1;$i<count($entrees);$i++) {
    $lastSolde = $entrees[$i-1]-$sorties[$i-1];
    $entrees[$i] += $lastSolde;
}

for($i=0;$i<count($entrees);$i++){
    $actualSolde = $entrees[$i]-$sorties[$i];
    array_push($solde,$actualSolde);
}

// Création du graphique en barres
// require_once ('jpgraph/src/jpgraph.php');
// require_once ('jpgraph/src/jpgraph_bar.php');

// Taille du graphique
$largeur = 1080;
$hauteur = 640;

// Création du graphique
$graph = new Graph($largeur, $hauteur, 'auto');
$graph->SetScale("textlin");
$graph->SetShadow();

// Titres
$graph->title->Set("Mouvement de caisse par mois");
$graph->xaxis->title->Set("Mois");
$graph->xaxis->SetTickLabels($mois);
$graph->yaxis->title->Set("Montant (Ar)");
$graph->yaxis->title->SetMargin(50);
$graph->SetMargin(100,100,100,100);

// Barres d'entrées
$entrees_bar = new BarPlot($entrees);
$sorties_bar = new BarPlot($sorties);
$solde_bar = new BarPlot($solde);


// Ajout des barres au graphique
$group = new GroupBarPlot(array($entrees_bar, $sorties_bar, $solde_bar));
$graph->Add($group);
$entrees_bar->SetFillColor("#024059");
$entrees_bar->value->Show();
$sorties_bar->SetFillColor("#A66D58");
$sorties_bar->value->Show();
$solde_bar->SetFillColor("#4F758C");
$solde_bar->value->Show();

// Légende
$graph->legend->SetPos(0.5, 0.98, "center", "bottom");
$graph->legend->SetColumns(3);
$entrees_bar->SetLegend("Entrées");
$sorties_bar->SetLegend("Sorties");
$solde_bar->SetLegend("Solde restante");

// Affichage du graphique
$graph->Stroke();



