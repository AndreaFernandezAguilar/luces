<?php
require('../fpdf/fpdf.php');
require("../modules/class/history.class.php");

require_once ('../modules/class/connection.class.php');
        $conect = new Connection();
            
        if (!isset($_SESSION['id_role']) || !isset($_SESSION['id_user']))
        {    
               header('Location: ../../index.php?error=true');
        }


        elseif ($_SESSION['id_role']!=2)  
        {        
           header('Location: ../../index.php?error=true');
        }

        


 class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../img/logo luces reducido.png', 60, $this->GetY(), 90);
        $this->SetFont('Arial','B',12);
        $this->SetY($this->GetY() + 48);
        $this->SetFont('Times','',18);
        $this->SetTextColor(111); //purple color
        $this->Cell(190,10,'DATOS PERSONALES DE PACIENTES',0,1,'C');
        $this->SetY($this->GetY() + 15);
        
    }

    function footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(95,10,'Generado el ' . date('d/m/Y') . ' a las ' . date('h:i:s') ,0,0,'L');
        $this->Cell(95,10,'Page '.$this->PageNo().'/{nb}',0,1,'R');   

    }

    function body()
    {
        $history = new History();
        $patients = $history->getPatients_PersonalInformation();
        $this->SetFont('Times','',12);

        if ($patients)
         {
            
            foreach ($patients as $patient) 
            {
                $maritalStatus= $history->getMaritalStatusName($patient['idMaritalStatus']);
                $state=$history->getStateName($patient['idState']);
                $city=$history->getCityName($patient['idCity']);
                $this->SetFont('Times','',16);
                $this->SetTextColor(111); //gray color
                $this->Cell(40,10,'ID del Paciente: '.$patient['id'],0,1,'C');

                $this->SetY($this->GetY() + 5);
                $this->SetFont('Arial','',12);
                $this->SetFillColor(126, 63, 150); //purple color
                $this->SetTextColor(255); //white color
                $this->SetX(5);
                $this->Cell(30, 10, utf8_decode('Cédula'), 1, 0, 'C',1);
                $this->Cell(35, 10, utf8_decode('Nombre'), 1, 0, 'C',1);
                $this->Cell(50, 10, 'Apellido', 1, 0, 'C',1);
                $this->cell(45, 10, 'Fecha de Nacimiento', 1, 0, 'C',1);
                $this->cell(40, 10, 'Estado Civil', 1, 1, 'C',1);
             
                
                
                $this->SetX(5);
                $this->SetFillColor(252, 245, 251); // pink color
                $this->SetTextColor(000); //black color
                $this->Cell(30, 20,$patient['identityCard'], 1, 0, 'C', 1);
                $this->Cell(35, 20, utf8_decode($patient['name']), 1, 0, 'C', 1);
                $this->Cell(50, 20, utf8_decode($patient['lastName']), 1, 0, 'C', 1);
                $this->Cell(45, 20, $patient['birthday'], 1, 0, 'C', 1);
                $this->Cell(40, 20, $maritalStatus, 1, 1, 'C', 1);

               
                $this->SetFillColor(126, 63, 150); // purple
                $this->SetTextColor(255); //white color
                $this->SetY($this->GetY() + 10);
                $this->SetX(5); 
                $this->Cell(66, 10, utf8_decode('Ocupación'), 1, 0, 'C',1);
                $this->Cell(134, 10, utf8_decode('Dirección de Habitación'), 1, 1, 'C',1);
    
                
                $this->SetX(5);
                $this->SetFillColor(252, 245, 251); // pink
                $this->SetTextColor(000); //black color
                $this->Cell(66, 20, utf8_decode($patient['ocupation']), 1, 0, 'C', 1);
                $this->Cell(134, 20, utf8_decode($patient['address']), 1, 1, 'C', 1);
         

                $this->SetFillColor(126, 63, 150); // purple
                $this->SetTextColor(255); //white color
                $this->SetY($this->GetY() + 10);
                $this->SetX(5);
                $this->Cell(33, 10, utf8_decode('Telf. Móvil'), 1, 0, 'C',1);
                $this->Cell(33, 10, utf8_decode('Telf. Local'), 1, 0, 'C',1);
                $this->Cell(67, 10, utf8_decode('Estado'), 1, 0, 'C',1);
                $this->Cell(67, 10, utf8_decode('Ciudad'), 1, 1, 'C',1);

                $this->SetX(5);
                $this->SetFillColor(252, 245, 251); // pink
                $this->SetTextColor(000); //white color
                $this->Cell(33, 20, $patient['mobile'], 1, 0, 'C', 1);
                $this->Cell(33, 20, $patient['phone'], 1, 0, 'C', 1);
                $this->Cell(67, 20, utf8_decode($state), 1, 0, 'C', 1);
                $this->Cell(67, 20,utf8_decode($city), 1, 1, 'C', 1);


                $this->SetFillColor(126, 63, 150); // purple
                $this->SetTextColor(255); //white color
                $this->SetY($this->GetY() + 10);
                $this->SetX(5);
                $this->Cell(66, 10, utf8_decode('Correo Electrónico'), 1, 0, 'C',1);
                $this->Cell(134, 10, utf8_decode('Referido por'), 1, 1, 'C',1);

                $this->SetX(5);
                $this->SetFillColor(252, 245, 251); // pink
                $this->SetTextColor(000); //white color
                $this->Cell(66, 20, utf8_decode($patient['email']), 1, 0, 'C', 1);
                $this->Cell(134, 20,utf8_decode($patient['referedBy']), 1, 0, 'C', 1);
                
                $this->SetY(-5);

          }
        } 

        else 
        {
            $this->Cell(0, 30, 'NO SE ENCONTRARON RESULTADOS', 1, 1, 'C');
        }
    }
}

ini_set("session.auto_start", 0);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetFont('Times','',12);
$pdf->body();
$pdf->footer();
ob_end_clean();
$pdf->Output();

?>