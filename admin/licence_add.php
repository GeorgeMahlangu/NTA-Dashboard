<?php
	include 'includes/session.php';

	//Function to validate the SA ID number 
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
			header('location: licence.php');
			exit();	
		}
	}

	

	if(isset($_POST['add'])){


		
		$id = $_POST['id'];
		$licenceNumber = $_POST['licenceNumber'];

		Validate($id);

		$licenceCode = $_POST['licence-code'];
		$prdp = $_POST['prdp'];
		$issueDate = date('Y-m-d', strtotime($_POST['dateIssued']));
		$expiryDate = date('Y-m-d', strtotime($_POST['expiryDate']));
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM licence WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Licence for this driver already Exist';
			exit();
		}

	
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO `licence` (`licenceNumber`, `id`, `licenceCode`, `PrDP`, `dateIssued`, `expiryDate`) VALUES (:licenceNumber, :id, :licenceCode, :PrDP, :dateIssued, :expiryDate)");
				$stmt->execute(['licenceNumber'=>$licenceNumber, 'id'=>$id, 'licenceCode'=>$licenceCode, 'PrDP'=>$prdp,'dateIssued'=>$issueDate, 'expiryDate'=>$expiryDate]);
				$_SESSION['success'] = 'Licence added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up Licence form first';
	}

	header('location: licence.php');

?>