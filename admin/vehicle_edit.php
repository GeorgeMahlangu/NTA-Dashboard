<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){

       
		$vehicleReg = $_POST['vehicleReg'];
		$licenceDisk = $_POST['licenceDisk'];
		$model = $_POST['model'];
		$vehicleType = $_POST['vehicleType'];
        $vehicleColour = $_POST['vehicleColour'];
        $vehicleOwner = $_POST['vehicleOwner'];
        $vehicleRegisteredAddress = $_POST['vehicleRegisteredAddress'];
		
		
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
			$stmt = $conn->prepare("UPDATE vehicle SET model=:model, vehicleType=:vehicleType, vehicleColour=:vehicleColour, vehicleOwner=:vehicleOwner, vehicleRegisteredAddress=:vehicleRegisteredAddress, licenceDisk=:licenceDisk WHERE vehicleRegistration=:vehicleRegistration");
			$stmt->execute(['model'=>$model, 'vehicleType'=>$vehicleType, 'vehicleColour'=>$vehicleColour, 'vehicleOwner'=>$vehicleOwner, 'vehicleRegisteredAddress'=>$vehicleRegisteredAddress, 'licenceDisk'=>$licenceDisk,  'vehicleRegistration'=>$vehicleReg]);
			$_SESSION['success'] = 'Vehicle updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit Vehicle form first';
	}

	header('location: vehicle.php');

?>