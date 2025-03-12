<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/ht/core/core.php';
  // if(!is_logged_in()){
  //     login_error_check();
  // }
  // if(!permission()){
  //   permission_error();
  // }

    if(isset($_GET['tour'])){
        $tourID = $_GET['tour'];
        $get = $db->query("SELECT * FROM tourism WHERE id = '$tourID' ");
        $data = mysqli_fetch_assoc($get);
    } else {
        header("Location: tour_reserves.php");
    }

	$i = 1;
	$total = 0;
	$sub_total = 0;
	$grand_total = 0;
	$itemQuantity = 0;
	$x = 1;

	$date = date("d-m-Y");
	$pdf = new FPDF('p','mm','A4');

	$pdf->AddPage();
	$pdf->SetFont("Arial","B","14");
  $pdf->Cell(189,5,'',0,1);

  $pdf->Cell(189,5,"Hotel & Tourism System",0,1,'C');
  $pdf->Cell(189,5,"",0,1,'C');
  $pdf->Cell(189,5,''.$data['title'].'',0,1,'C');
  $pdf->Cell(189,5,"",0,1,'C');
  $pdf->Cell(189,5,"Attendance Register",0,1,'C');//End of line

  $pdf->Cell(189,5,'',0,1);
  $pdf->SetFont("Arial","B","8");
  $pdf->Cell(7, 5, '#',1,0);
  $pdf->Cell(35, 5, 'Customer Name',1,0,'C');
  $pdf->Cell(35, 5, 'Contact Number',1,0,'C');
  $pdf->Cell(35, 5, 'Email',1,0,'C');

  $pdf->Cell(15, 5, 'Reserved',1,0,'C');
  $pdf->Cell(30, 5, 'Tour Event',1,0,'C');
  $pdf->Cell(31, 5, 'signature',1,1,'C');

//   $pdf->Cell(34, 5, 'Amount(k)',1,1,'C');

	$t = $db->query("SELECT * FROM tour_reserves WHERE tour_id = '$tourID' ");
	while($tour = mysqli_fetch_assoc($t)) {
      		$pdf->SetFont("Arial","","8");
            $pdf->Cell(7,6,$x,1,0);
            $pdf->Cell(35,6,$tour['cus_name'],1,0,'L');
            $pdf->Cell(35,6,$tour['phone'],1,0,'C');

            $pdf->Cell(35,6,$tour['email'],1,0,'C');

            $pdf->Cell(15,6,$tour['reservations'],1,0,'C');

            $pdf->Cell(30,6,$data['title'],1,0,'C');
            $pdf->Cell(31, 6, '',1,1,'C');
            // $pdf->Cell(34,6,$transaction['total'],1,1,'C');
            $x++;

            // $grand_total += $transaction['total'];
            $grand_total = (float) $grand_total;
  }
  
  $pdf->Cell(189,5,'',0,1);
  $pdf->Output();
