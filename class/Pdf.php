<?php 

    require("../fpdf/fpdf.php");

    class Pdf extends FPDF{

        function Header(){
            $this->SetFont('Helvetica', '', 9);
            $this->SetTextColor(0);
            $this->Text(8, 2, "Maison des Ligues");
            $this->Ln(20);

            $this->SetFont('Helvetica', 'B', 11);
            $this->SetX(70);
            $this->Cell(60, 8, 'Taches en cours', 0, 1, 'C', 0);
            $this->Ln(10);
        }

        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Helvetica', 'I', 9);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'c');
        }

        function enteteTable($positionEntete, $nomColonne){
            $this->SetFont('Helvetica', '', 9);
            $this->SetTextColor(0);

            $this->SetDrawColor(183);
            $this->SetFillColor(221);
            $this->SetTextColor(0);
            $this->SetY($positionEntete);
            
            $position = 10;
            foreach($nomColonne as $cle=>$value){
                $this->SetX($position);
                $this->Cell(35, 8, $cle, 1, 0, 'C', 1);
                $position += 35;
            }

            $this->Ln();
        }

        function fillTable($data){
            $positionY = 78; 
            foreach($data as $cle=>$value){
                $positionX = 10;
                foreach($value as $cle2=>$value2){
                    $this->SetY($positionY);
                    $this->SetX($positionX);
                    $this->MultiCell(35, 8, $value2, 1, 'C');
                    $positionX += 35;
                }
                $positionY += 8;
            }
        }

    }

?>