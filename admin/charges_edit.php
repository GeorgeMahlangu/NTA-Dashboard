<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){

		$numberValidation = "/^[0-9]+$/";

        $oldChargeCode = $_POST['id'];	
       	$newChargeCode = $_POST['newChargeCode'];
		$chargeType = $_POST['chargeType'];
		$penalty = $_POST['penalty'];

		
		if(!preg_match($numberValidation,$penalty)){
			$_SESSION['error'] = 'Invalid Penalty';
			header('location: charges.php');
			exit();	
		}

		
			
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM charge WHERE chargeCode=:chargeCode");
		$stmt->execute(['chargeCode'=>$newChargeCode]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Charge Code already Exist';
			header('location: charges.php');
			exit();
		}

		
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
			$stmt = $conn->prepare("UPDATE charge SET chargeCode=:chargeCode, chargeType=:chargeType, penalty=:penalty Where chargeCode=:oldChargeCode");
			$stmt->execute(['chargeCode'=>$newChargeCode, 'chargeType'=>$chargeType, 'penalty'=>$penalty, 'oldChargeCode'=>$oldChargeCode]);
			$_SESSION['success'] = 'Charge updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit charge form first';
	}

	header('location: charges.php');

?>