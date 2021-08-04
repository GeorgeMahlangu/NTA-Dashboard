<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){

       
		$id = $_POST['id'];
		$licence = $_POST['licence_number'];
		$licenceCode = $_POST['licence-code'];
		$prdp = $_POST['prdp'];
		$issueDate = date('Y-m-d', strtotime($_POST['dateIssued']));
		$expiryDate = date('Y-m-d', strtotime($_POST['expiryDate']));
		
		$conn = $pdo->open();

		
		// if(!preg_match($emailValidation,$email)){
		// 	$_SESSION['error'] = 'Invalid Email address';
		// 	header('location: officers.php');
		// 	exit();	
		// }



		// if(!preg_match($name,$firstname)){
		// 	$_SESSION['error'] = 'Invalid First Name Format';
		// 	header('location: officers.php');
		// 	exit();	
		// }

		// if(!preg_match($name,$lastname)){
		// 	$_SESSION['error'] = 'Invalid Last Name Format';
		// 	header('location: officers.php');
		// 	exit();	
		// }
		// if(!empty($password))
		// {
		// 	if(strlen($password) < 8){
		// 		$_SESSION['error'] = 'Password is too Short';
		// 		header('location: officers.php');
		// 		exit();	
		// 	}
		// 	else
		// 	{
		// 		$password = $password;
		// 	}
		// }
		// else
		// {
		// 	$password = $user['password'];
		// }


		try{
			$stmt = $conn->prepare("UPDATE licence SET licenceNumber=:licenceNumber, licenceCode=:licenceCode, PrDP=:PrDP, dateIssued=:issueDate, expiryDate=:expiryDate WHERE id=:id");
			$stmt->execute(['licenceNumber'=>$licence, 'id'=>$id, 'licenceCode'=>$licenceCode, 'PrDP'=>$prdp, 'issueDate'=>$issueDate, 'expiryDate'=>$expiryDate]);
			$_SESSION['success'] = 'Licence updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit officer form first';
	}

	header('location: licence.php');

?>