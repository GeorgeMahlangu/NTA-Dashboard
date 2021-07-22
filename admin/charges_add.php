<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		$numberValidation = "/^[0-9]+$/";
		
		$chargeCode = $_POST['chargeCode'];
		$chargeType = $_POST['chargeType'];
		$penalty = $_POST['penalty'];

		if(!preg_match($numberValidation,$penalty)){
			$_SESSION['error'] = 'Invalid Penalty';
			header('location: charges.php');
			exit();	
		}
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM charge WHERE chargeCode=:chargeCode");
		$stmt->execute(['chargeCode'=>$chargeCode]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Charge Code already Exist';
			header('location: charges.php');
			exit();
		}

	
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO `charge` (`chargeCode`, `chargeType`, `penalty`) VALUES (:chargeCode, :chargeType, :penalty)");
				$stmt->execute(['chargeCode'=>$chargeCode, 'chargeType'=>$chargeType, 'penalty'=>$penalty]);
				$_SESSION['success'] = 'Charge added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up charge form first';
	}

	header('location: charges.php');

?>