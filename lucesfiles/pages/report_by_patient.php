<?php
require('../fpdf/fpdf.php');
require("../modules/class/history.class.php");

    require_once ('../modules/class/connection.class.php');
        $conect = new Connection();
            
        if (!isset($_SESSION['id_role']) || !isset($_SESSION['id_user']))
        {    
               header('Location: ../../index.php?error=true');
        }


        elseif ($_SESSION['id_role']!=1 && $_SESSION['id_role']!=2)  
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
        $this->Cell(190,10,'DATOS DEL PACIENTE',0,1,'C');
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

    function body($identityCard)
    {
       
        $history = new History();
        $patients = $history->getMedicalHistory_PersonalInformation($identityCard);
        $idPatient=$history-> getIdPatient($identityCard);
        $medical_record=$history->getMedicalRecord($idPatient);
       // $this->SetX(10);
        $this->SetTextColor(111); //gray color
        $this->Cell(50,10,utf8_decode('Información Personal'),0,1,'C');
        $this->SetFont('Times','',12);
        $this->SetFillColor(126, 63, 150); //purple color
       

        if ($patients)
         {
            
            foreach ($patients as $patient) 
            {
                $maritalStatus= $history->getMaritalStatusName($patient['5']);
                $state=$history->getStateName($patient['8']);
                $city=$history->getCityName($patient['9']);
                $this->SetFont('Times','',16);
               

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
                $this->Cell(30, 20,$patient['0'], 1, 0, 'C', 1);
                $this->Cell(35, 20, utf8_decode($patient['1']), 1, 0, 'C', 1);
                $this->Cell(50, 20, utf8_decode($patient['2']), 1, 0, 'C', 1);
                $this->Cell(45, 20, $patient['4'], 1, 0, 'C', 1);
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
                $this->Cell(66, 20, utf8_decode($patient['6']), 1, 0, 'C', 1);
                $this->Cell(134, 20, utf8_decode($patient['7']), 1, 1, 'C', 1);
         

                $this->SetFillColor(126, 63, 150); // purple
                $this->SetTextColor(255); //white color
                $this->SetY($this->GetY() + 10);
                $this->SetX(5);
                $this->Cell(33, 10, utf8_decode('Telf. Local'), 1, 0, 'C',1);
                $this->Cell(33, 10, utf8_decode('Telf. Móvil'), 1, 0, 'C',1);
                $this->Cell(67, 10, utf8_decode('Estado'), 1, 0, 'C',1);
                $this->Cell(67, 10, utf8_decode('Ciudad'), 1, 1, 'C',1);

                $this->SetX(5);
                $this->SetFillColor(252, 245, 251); // pink
                $this->SetTextColor(000); //black color
                $this->Cell(33, 20, $patient['10'], 1, 0, 'C', 1);
                $this->Cell(33, 20, $patient['11'], 1, 0, 'C', 1);
                $this->Cell(67, 20, utf8_decode($state), 1, 0, 'C', 1);
                $this->Cell(67, 20, utf8_decode($city), 1, 1, 'C', 1);


                $this->SetFillColor(126, 63, 150); // purple
                $this->SetTextColor(255); //white color
                $this->SetY($this->GetY() + 10);
                $this->SetX(5);
                $this->Cell(66, 10, utf8_decode('Correo Electrónico'), 1, 0, 'C',1);
                $this->Cell(134, 10, utf8_decode('Referido por'), 1, 1, 'C',1);

                $this->SetX(5);
                $this->SetFillColor(252, 245, 251); // pink
                $this->SetTextColor(000); //black color
                $this->Cell(66, 20, utf8_decode($patient['12']), 1, 0, 'C', 1);
                $this->Cell(134, 20, utf8_decode($patient['13']), 1, 0, 'C', 1);
                
                $this->SetY(-5);

          }
        } 

        else 
        {
            $this->Cell(0, 30, 'NO SE ENCONTRARON RESULTADOS', 1, 1, 'C');
        }



        if ($medical_record) 
        {
            $this->SetFont('Times','',16);
            $this->SetTextColor(111); //gray color
            $this->Cell(50,10,utf8_decode('Antedecentes Médicos'),0,1,'C');

          foreach ($medical_record as  $m_record) 
          {
              $this->SetY($this->GetY() + 5);
              $this->SetFont('Arial','',12);
                

                $this->SetFillColor(126, 63, 150); //purple color
                $this->SetTextColor(255); //white color
                
                $this->Cell(40, 10, utf8_decode('Último Período'), 1, 0, 'C',1);
                $this->Cell(40, 10, utf8_decode('No. de Embarazos'), 1, 0, 'C',1);
                $this->Cell(110, 10, 'Alergias', 1, 1, 'C',1);
               
                //$this->SetY($this->GetY() + 10);
                $this->SetFillColor(252, 245, 251); // pink
                $this->SetTextColor(000); //black color
                $this->Cell(40, 10, utf8_decode($m_record['12']), 1,0,'C' ,1);
                $this->Cell(40, 10, utf8_decode($m_record['11']), 1, 0,'C', 1);
                $this->Cell(110, 10, utf8_decode($m_record['14']),1,1,C, 1);
                $this->Ln(10);    
                
                $this->SetFillColor(252, 245, 251); // pink
                $this->SetTextColor(000); //black color
                
                if ($m_record[0]==1) 
                {
                    //$this->SetX(10);
                     $this->MultiCell(190, 10, utf8_decode('Diabetes'), 'LTRB','C', 1);
                }

                  if ($m_record[1]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Hipertensión'), 'LTRB','C', 1);
                }


                 if ($m_record[2]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Queloides'), 'LTRB','C', 1);
                }


                 if ($m_record[3]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Cáncer'), 'LTRB','C', 1);
                }

                 if ($m_record[4]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Artritis'), 'LTRB','C', 1);
                }

                 if ($m_record[5]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Lupus'), 'LTRB','C', 1);
                }


                 if ($m_record[6]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Insuficiencia Renal'), 'LTRB','C', 1);
                }


                 if ($m_record[7]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Marcapasos'), 'LTRB','C', 1);
                }


                 if ($m_record[8]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Prótesis dental o metálicas'), 'LTRB','C', 1);
                }

                 if ($m_record[9]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Bronceado'), 'LTRB','C', 1);
                }

                 if ($m_record[10]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Reacciones al Sol'), 'LTRB','C', 1);
                }

                   if ($m_record[13]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Actualmente embarazada'), 'LTRB','C', 1);
                }

                   if ($m_record[15]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Manchas en la piel'), 'LTRB','C', 1);
                }

                   if ($m_record[16]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Fumador (a)'), 'LTRB','C', 1);
                }

                  if ($m_record[17]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Ejercicios'), 'LTRB','C', 1);
                }

                  if ($m_record[18]==1) 
                {
                     $this->MultiCell(190, 10, utf8_decode('Hormonas y/o Anticonceptivos'), 'LTRB','C', 1);
                }


               
               
          }
        }

         else 
        {
            $this->Cell(0, 30, 'NO SE ENCONTRARON RESULTADOS DE ANTECEDENTES MÉDICOS', 1, 1, 'C');
        }

    }



}

ini_set("session.auto_start", 0);
$identityCard=$_POST['idcard'];
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetFont('Times','',12);
$pdf->body($identityCard);
$pdf->footer();
ob_end_clean();
$pdf->Output();

?>