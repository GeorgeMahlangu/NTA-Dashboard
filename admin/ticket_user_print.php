<?php
	include 'includes/session.php';

	function generateRow($id, $conn){
		$contents = '';
	 	
		$stmt = $conn->prepare("SELECT * FROM ticket WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$total = 0;
        $count = 0;
		foreach($stmt as $row){
			$total += (int)($row['penalty']);
            $count++;
			$contents .= '
			<tr>
				<td>'.date('M d, Y', strtotime($row['created_at'])).'</td>
				<td>'.$row['refference'].'</td>
                <td>'.$row['id'].'</td>
				<td>'.$row['firstname'].' '.$row['lastname'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['cellnumber'].'</td>
                <td>R '.$row['penalty'].'</td>
			</tr>
			';
		}

		$contents .= '
            <tr>
                <td colspan="3" align="left"><b>Total Tickets Issued :</b></td>
                <td colspan="4" align="left"><b>'.$count.'</b></td>
            </tr>
            <tr>
				<td colspan="3" align="left"><b>Total Amount for Selected Date:</b></td>
                <td colspan="4" align="left"><b>R '.$total.'</b></td>
			</tr>
		';
		return $contents;
	}

    function Validate($idNumber) {
		$correct = true;
		if (strlen($idNumber) !== 13 || !is_numeric($idNumber) ) {
			//echo "ID number does not appear to be authentic - input not a valid number";
			$correct = false;
		}

		$year = substr($idNumber, 0,2);
		$currentYear = date("Y") % 100;
		$prefix = "19";
		if ($year < $currentYear)
			$prefix = "20";
		$id_year = $prefix.$year;

		$id_month = substr($idNumber, 2,2);
		$id_date = substr($idNumber, 4,2);

		$fullDate = $id_date. "-" . $id_month. "-" . $id_year;
		
		if (!$id_year == substr($idNumber, 0,2) && $id_month == substr($idNumber, 2,2) && $id_date == substr($idNumber, 4,2)) {
			//echo 'ID number does not appear to be authentic - date part not valid'; 
			$correct = false;
		}
		$genderCode = substr($idNumber, 6,4);
		$gender = (int)$genderCode < 5000 ? "Female" : "Male";

		$citzenship = (int)substr($idNumber, 10,1)  === 0 ? "citizen" : "resident";//0 for South African citizen, 1 for a permanent resident

		$total = 0;
		$count = 0;
		for ($i = 0;$i < strlen($idNumber);++$i)
		{
			$multiplier = $count % 2 + 1;
			$count ++;
			$temp = $multiplier * (int)$idNumber{$i};
			$temp = floor($temp / 10) + ($temp % 10);
			$total += $temp;
		}
		$total = ($total * 9) % 10;

		if ($total % 10 != 0) {
			//echo 'ID number does not appear to be authentic - check digit is not valid';
			$correct = false;
		}

		if (!$correct){
			$_SESSION['error'] = 'Invalid ID Number';
			header('location: Tickets.php');
			exit();	
		}
	}


	if(isset($_POST['print'])){

        $id = $_POST['report'];
        Validate($id);

        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM ticket WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($row['numrows'] <= 0){
			$_SESSION['error'] = 'There are no tickets issued for this driver.';
            header('location: tickets.php');
			exit();
           
		}




        $stmt = $conn->prepare("SELECT * FROM ticket WHERE id=:id");
		$stmt->execute(['id'=>$id]);
        $row = $stmt->fetch();
        $fullname = $row['firstname'].' '.$row['lastname'];



		$ex = explode(' - ', $_POST['date_range']);
		$from = date('Y-m-d', strtotime($ex[0]));
		$to = date('Y-m-d', strtotime($ex[1]));
		$from_title = date('M d, Y', strtotime($ex[0]));
		$to_title = date('M d, Y', strtotime($ex[1]));

		$conn = $pdo->open();

		require_once('../tcpdf/tcpdf.php');  
	    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
	    $pdf->SetCreator(PDF_CREATOR);  
	    $pdf->SetTitle('All Ticket Issued  to '.$fullname);  
	    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	    $pdf->SetDefaultMonospacedFont('helvetica');  
	    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
	    $pdf->setPrintHeader(false);  
	    $pdf->setPrintFooter(false);  
	    $pdf->SetAutoPageBreak(TRUE, 10);  
	    $pdf->SetFont('helvetica', '', 11);  
	    $pdf->AddPage();  
	    $content = '';  
	    $content .= '
	      	<h2 align="center">All Tickets for '.$fullname.'</h2>
	      	<h4 align="center">TICKET REPORT</h4>
	      	<h4 align="center">ID Number: '.$id.'</h4>
	      	<table border="1" cellspacing="0" cellpadding="3">  
	           <tr>  
	           		<th width="10%" align="center"><b>Date Issued</b></th>
                    <th width="5%" align="center"><b>Ref</b></th>
	                <th width="20%" align="center"><b>ID</b></th>
					<th width="15%" align="center"><b>Full Name</b></th> 
					<th width="25%" align="center"><b>Email</b></th> 
					<th width="15%" align="center"><b>Contact No</b></th>
                    <th width="10%" align="center"><b>Penalty</b></th> 
	           </tr>  
	      ';  
	    $content .= generateRow($id, $conn);  
	    $content .= '</table>';  
		$pdf->writeHTML($content);  
		ob_end_clean();
	    $pdf->Output('User_tickets.pdf', 'I');

	    $pdo->close();

	}
	else{
		$_SESSION['error'] = 'Need Full ID Number to provide user report print';
		header('location: tickets.php');
	}
?>