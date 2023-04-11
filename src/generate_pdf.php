<?php
require('tcpdf/tcpdf.php');

if (isset($_POST['generatePDF'])) {
    // Décodage
    $data = json_decode($_POST['dataPDF'], true);
    
    $debut = $data['debut'];
    $fin = $data['fin'];
    $data_inc = $data['data_inc'];
    $total_inc = $data['total_inc'];
    $data_cst = $data['data_cst'];
    $total_cst = $data['total_cst'];
    
    
    // Création de la classe PDF
    class PDF extends TCPDF
    {
        // En-tête
        public function Header()
        {
            global $debut, $fin;
            
            // Police Arial gras 15
            $this->SetFont('helvetica', 'B', 15);
            
            // Titre
            $this->Cell(0, 10, 'Mouvement de caisse', 0, 1, 'C');
    
            $this->SetFont('helvetica', '', 12);
            $this->Cell(0, 10, 'Entre '.$debut.' et '.$fin, 0, 1, 'C');
    
            // Saut de ligne
            $this->Ln(20);
        }
    
        // Pied de page
        public function Footer()
        {
            // Positionnement à 1,5 cm du bas
            $this->SetY(-15);
            
            // Police Arial italique 8
            $this->SetFont('helvetica', 'I', 8);
            
            // Numéro de page
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
        }
    
        // Tableau de mouvement de caisse
        public function MouvementCaisse($header, $data, $total, $type)
        {    
            $this->SetFont('helvetica', 'B', 12);
            if ($type == 'Entree') {
                $this->Cell(0, 10, 'Mouvement d\'entrée en caisse', 0, 1);
            } else {
                $this->Cell(0, 10, 'Mouvement de sortie de caisse', 0, 1);  
            }

            // En-tête
            $this->SetFont('helvetica', 'B', 10);
            foreach($header as $col) {
                $this->Cell(55, 7, $col, 1, 0, 'C');
            }
            $this->Ln();
            
            // Données
            $this->SetFont('helvetica', '', 10);
            $count=1;
            foreach($data as $row)
            {
                foreach($row as $col) {
                    $this->MultiCell(55, 20, $col, 1, 'L', 1, 0, '', '', true);
                }
                if ($count%11 == 0) {
                    $this->AddPage();
                } else {
                    $this->Ln();
                }
                $count = $count + 1;
            }

            $this->SetFont('helvetica', '', 12);
            if ($type == 'Entree') {
                $this->Cell(0, 10, 'Total montant entrant: '.$total.' Ar', 0, 1);
            } else {
                $this->Cell(0, 10, 'Total montant sortant: '.$total.' Ar', 0, 1);            
            }
        }
    }
    
    // Création du PDF
    $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // Configurations
    $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->setCellPaddings(1, 1, 1, 1);
    $pdf->setFillColor(255, 255, 255);
    
    // Création de la page
    $pdf->AddPage();
    $pdf->MouvementCaisse(array('Date', 'Motif', 'Montant (Ar)'), $data_inc, $total_inc, 'Entree');
    $pdf->MouvementCaisse(array('Date', 'Motif', 'Montant (Ar)'), $data_cst, $total_cst, 'Sortie');
    $pdf->Output('church.pdf','I');
}
?>