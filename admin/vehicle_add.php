<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		// function generateRandomString($length = 6) {
		// 	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// 	$charactersLength = strlen($characters);
		// 	$randomString = '';
		// 	for ($i = 0; $i < $length; $i++) {
		// 		$randomString .= $characters[rand(0, $charactersLength - 1)];
		// 	}
		// 	return $randomString;
		// }

		// $rand = generateRandomString();

		$nameValidation = "/^[a-zA-Z ]+$/";
		$emailValidation = "/^[_a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$numberValidation = "/^[0-9]+$/";
		$addressValidation = "/^[A-Za-z0-9'\.\-\s\,]+$/";

		$vehicleReg = $_POST['vehicleReg'];
		$licenceDisk = $_POST['licenceDisk'];
		$model = $_POST['model'];
		$vehicleType = $_POST['vehicleType'];
		$vehicleColour = $_POST['vehicleColour'];
		$vehicleOwner = $_POST['vehicleOwner'];
        $vehicleRegisteredAddress = $_POST['vehicleRegisteredAddress'];
        

		/***
             / // if(!preg_match($emailValidation,$email)){
            // 	$_SESSION['error'] = 'Invalid Email address';
            // 	header('location: officers.php');
            // 	exit();	
            // }

            // if(!preg_match($nameValidation,$firstname)){
            // 	$_SESSION['error'] = 'Invalid First Name Format';
            // 	header('location: officers.php');
            // 	exit();	
            // }

            // if(!preg_match($nameValidation,$lastname)){
            // 	$_SESSION['error'] = 'Invalid Last Name Format';
            // 	header('location: officers.php');
            // 	exit();	
            // }

            // if(!preg_match($numberValidation,$cellnumber)){
            // 	$_SESSION['error'] = 'Invalid Cell Number Format';
            // 	header('location: officers.php');
            // 	exit();	
            // }
            // else
            // {
            // 	if(strlen($cellnumber) > 10 || strlen($cellnumber) < 10)
            // 	{
            // 		$_SESSION['error'] = 'Invalid cell number cell number must be 10 digits';
            // 		header('location: officers.php');
            // 		exit();	
            // 	} 
            // }
            // if(!empty($password))
            // {
            // 	if(strlen($password) < 8){
            // 		$_SESSION['error'] = 'Password is too Short';
            // 		header('location: officers.php');
            // 		exit();	
            // 	}
            // }
        
        */


		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("INSERT INTO `vehicle` (`vehicleRegistration`,`model`, `vehicleType`, `vehicleColour`, `vehicleOwner`, `vehicleRegisteredAddress`, `licenceDisk`) VALUES (:vehicleRegistration, :model, :vehicleType, :vehicleColour, :vehicleOwner, :vehicleRegisteredAddress, :licenceDisk)");
			$stmt->execute(['vehicleRegistration'=>$vehicleReg, 'model'=>$model, 'vehicleType'=>$vehicleType, 'vehicleColour'=>$vehicleColour,'vehicleOwner'=>$vehicleOwner, 'vehicleRegisteredAddress'=>$vehicleRegisteredAddress, 'licenceDisk'=>$licenceDisk]);
			$_SESSION['success'] = 'Vehicle added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up Vehicle form first';
	}

	header('location: vehicle.php');

?>