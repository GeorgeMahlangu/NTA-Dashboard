<?php
	include 'includes/session.php';

	function generateRow($conn){
		$contents = '';
	 	
		$stmt = $conn->prepare("SELECT * FROM licence");
		$stmt->execute();
		$total = 0;
		foreach($stmt as $row){
			$total ++;
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
				<td colspan="3" align="left"><b>Total Amount for Selected Date:</b></td>
                <td colspan="3" align="left"><b>R '.$total.'</b></td>
			</tr>
		';
		return $contents;
	}

	if(isset($_POST['print'])){
		$ex = explode(' - ', $_POST['date_range']);
		$from = date('Y-m-d', strtotime($ex[0]));
		$to = date('Y-m-d', strtotime($ex[1]));
		$from_title = date('M d, Y', strtotime($ex[0]));
		$to_title = date('M d, Y', strtotime($ex[1]));

		$conn = $pdo->open();

		require_once('../tcpdf/tcpdf.php');  
	    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
	    $pdf->SetCreator(PDF_CREATOR);  
	    $pdf->SetTitle('Ticket Issued: '.$from_title.' - '.$to_title);  
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
	      	<h2 align="center">Group J</h2>
	      	<h4 align="center">TICKET REPORT</h4>
	      	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
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
	    $content .= generateRow($from, $to, $conn);  
	    $content .= '</table>';  
		$pdf->writeHTML($content);  
		ob_end_clean();
	    $pdf->Output('tickets.pdf', 'I');

	    $pdo->close();

	}
	else{
		$_SESSION['error'] = 'Need date range to provide sales print';
		header('location: tickets.php');
	}
?>