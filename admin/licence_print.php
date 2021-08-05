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
				<td>'.$row['licenceNumber'].'</td>
				<td>'.$row['id'].'</td>
				<td>'.$row['licenceCode'].'</td>
				<td>'.$row['PrDP'].'</td>
				<td>'.date('M d, Y', strtotime($row['dateIssued'])).'</td>
				<td>'.date('M d, Y', strtotime($row['expiryDate'])).'</td>
			</tr>
			';
		}

		$contents .= '
			<tr>
				<td colspan="3" align="left"><b>Total Number of licences :</b></td>
                <td colspan="3" align="left"><b>'.$total.'</b></td>
			</tr>
		';
		return $contents;
	}

	if(isset($_POST['print'])){
		// $ex = explode(' - ', $_POST['date_range']);
		// $from = date('Y-m-d', strtotime($ex[0]));
		// $to = date('Y-m-d', strtotime($ex[1]));
		// $from_title = date('M d, Y', strtotime($ex[0]));
		// $to_title = date('M d, Y', strtotime($ex[1]));

		$conn = $pdo->open();

		require_once('../tcpdf/tcpdf.php');  
	    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
	    $pdf->SetCreator(PDF_CREATOR);  
	    $pdf->SetTitle('Total Licences');  
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
	      	<h2 align="center">NTA</h2>
	      	<h4 align="center">LICENCE REPORT</h4>
	      	<h4 align="center"><br></h4>
	      	<table border="1" cellspacing="0" cellpadding="3">  
	           <tr>  
	           		<th width="25%" align="center"><b>Licence Number</b></th>
	                <th width="25%" align="center"><b>ID</b></th>
					<th width="10%" align="center"><b>Licence Code</b></th> 
					<th width="10%" align="center"><b>PrDP</b></th> 
					<th width="15%" align="center"><b>Date Issued</b></th>
                    <th width="15%" align="center"><b>Expiry Date</b></th> 
	           </tr>  
	      ';  
	    $content .= generateRow($conn);  
	    $content .= '</table>';  
		$pdf->writeHTML($content);  
		ob_end_clean();
	    $pdf->Output('licence.pdf', 'I');

	    $pdo->close();

	}
	else{
		$_SESSION['error'] = 'There was an error printing licence report';
		header('location: licence.php');
	}
?>