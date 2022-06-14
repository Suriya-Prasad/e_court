<?php
    session_start();
    require('fpdf184/fpdf.php');
    if(strcmp($_SESSION['employee_role'],"super admin")!=0){
        header("Location:home_attendance.php");
    }

    $employeeName = $_SESSION['post_transfer_employeeName'];
    $from_court = $_SESSION['from_court'];
    $from_post = $_SESSION['from_post'];
    $to_court = $_SESSION['court_to'];
    $to_post = $_SESSION['post_to'];
    $relive_date = $_SESSION['relive_date'];
    $join_date = $_SESSION['join_date'];
    $pdj_name = $_SESSION['pdj_name'];

    $join_date = strtotime($join_date);
    $join_date = date('d.m.Y',$join_date);
    
    $relive_date = strtotime($relive_date);
    $relive_date = date('d.m.Y',$relive_date);


    unset($_SESSION['post_transfer_employeeName']);
    unset($_SESSION['from_court']);
    unset($_SESSION['from_post']);
    unset($_SESSION['court_to']);
    unset($_SESSION['post_to']);
    unset($_SESSION['relive_date']);
    unset($_SESSION['join_date']);


    $pdf = new FPDF('P','mm','A4'); 
    $pdf->AddPage();

    $pdf->Cell(0,5,'',0,1);

    $pdf->SetFont('Arial','BU',12);
    $pdf->Cell(0,5,'PROCEEDINGS OF THE PRINCIPLE DISTRICT JUDGE, TIRUPPUR',0,1,'C');

    $pdf->Cell(0,5,'',0,1);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(80,5,'Present:',0,0,'R');
    $pdf->Cell(0,5,$pdj_name.',',0,1,'L');
    $pdf->Cell(80,5,'',0,0,'R');
    $pdf->Cell(0,5,'Principle District Judge,',0,1,'L');
    $pdf->Cell(80,5,'',0,0,'R');
    $pdf->Cell(0,5,'Tiruppur.',0,1,'L');

    $pdf->Cell(0,5,'',0,1);

    $pdf->Cell(52,5,'A.No.',0,0,'R');
    $pdf->Cell(3,5,'',0,0);
    $pdf->Cell(20,5,'/'.date("Y"),0,0,'L');
    $pdf->Cell(70,5,'Dated: '.date("d.m.Y"),0,1,'R');

    $pdf->Cell(0,5,'',0,1);

    $pdf->Cell(50,5,'Sub:',0,0,'R');
    $pdf->Cell(5,5,'',0,0);
    $pdf->Cell(0,5,'Public Services - TNJMS/TNGSS/TNBS - On',0,1,'L');
    $pdf->Cell(55,5,'',0,0);
    $pdf->Cell(0,5,'administrative grounds - Transfer and Posting orders -',0,1,'L');
    $pdf->Cell(55,5,'',0,0);
    $pdf->Cell(0,5,'Issued - Regarding.',0,1,'L');

    $pdf->Cell(0,5,'',0,1);

    $pdf->Cell(50,5,'Ref:',0,0,'R');
    $pdf->Cell(5,5,'',0,0);
    $pdf->Cell(58,5,"This Court's Office Order, Dated ".date("d.m.Y"),0,1,'L');

    $pdf->Cell(0,7,'',0,1);
    $pdf->Cell(0,5,'--:0:--',0,1,'C');
    $pdf->Cell(0,7,'',0,1);

    $pdf->Cell(0,5,'On administrative grounds, the following transfer and posting orders are issued.',0,1,'C');

    $pdf->Cell(0,7,'',0,1);

    $pdf->Cell(34,5,'1. ',0,0,'R');
    $pdf->Cell(0,5,$employeeName.', ' .$from_post.', '. $from_court.', (Place) is transferred and posted as '.$to_post.', ',0,1,'L');
    $pdf->Cell(34,5,'',0,0,'R');
    $pdf->Cell(0,5,$to_court.', (Place) vice '. $employeeName.' transferred.',0,1,'L');

    $pdf->Cell(0,7,'',0,1);

    $pdf->Cell(34,5,'2. ',0,0,'R');
    $pdf->Cell(0,5,$employeeName.', ' .$from_post.', '. $from_court.', (Place) is transferred and posted as '.$to_post.', ',0,1,'L');
    $pdf->Cell(34,5,'',0,0,'R');
    $pdf->Cell(0,5,$to_court.', (Place) in the existing vacancy.',0,1,'L');

    $pdf->Cell(0,7,'',0,1);
    $pdf->Cell(39,5,'Note:',0,1,'R');
    $pdf->Cell(0,7,'',0,1);

    $pdf->Cell(34,5,'1. ',0,0,'R');
    $pdf->Cell(72,5,'The above individuals in Sl.No.',0,0,'L');
    $pdf->Cell(0,5,'shall be relived on the afternoon of ',0,1,'L');
    $pdf->Cell(34,5,'',0,0,'R');
    $pdf->Cell(0,5,$relive_date.' and to join duty in new station on the forenoon of '.$join_date.'.',0,1,'L');

    $pdf->Cell(0,7,'',0,1);

    $pdf->Cell(34,5,'2. ',0,0,'R');
    $pdf->Cell(72,5,'The above individuals in Sl.No.',0,0,'L');
    $pdf->Cell(0,5,'shall be relived on the afternoon of ',0,1,'L');
    $pdf->Cell(34,5,'',0,0,'R');
    $pdf->Cell(0,5,$relive_date.' and to join duty immediately in the new station.',0,1,'L');

    $pdf->Cell(0,30,'',0,1);

    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(165,5,'PRINCIPAL DISTRICT JUDGE,',0,1,'R');
    $pdf->Cell(147,5,'TIRUPPUR',0,1,'R');

    $pdf->Cell(0,7,'',0,1);

    $pdf->SetFont('Arial','',11);
    $pdf->Cell(23,5,'',0,0);
    $pdf->Cell(0,5,'To',0,1,'L');
    $pdf->Cell(23,5,'',0,0);
    $pdf->Cell(0,5,'The individuals through proper channel.',0,1,'L');
    $pdf->Cell(23,5,'',0,0);
    $pdf->Cell(0,5,'The (Name of Officer Designation)',0,1,'L');

    $pdf->Cell(0,10,'',0,1);

    $pdf->Cell(23,5,'',0,0);
    $pdf->Cell(0,5,'Copy to',0,1,'L');

    $pdf->Cell(0,5,'',0,1);

    $pdf->Cell(23,5,'',0,0);
    $pdf->Cell(0,5,'The Court Manager, System Analyst, Sherishtadar, Head Clerk, Superintendent in',0,1,'L');
    $pdf->Cell(23,5,'',0,0);
    $pdf->Cell(0,5,'Copying Section, Principal District Court, Tiruppur.',0,1,'L');


    $pdf->Output();
?>