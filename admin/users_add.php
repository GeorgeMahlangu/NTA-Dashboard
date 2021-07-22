<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		function generateRandomString($length = 6) {
			$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}

		$rand = generateRandomString();

		$nameValidation = "/^[a-zA-Z ]+$/";
		$emailValidation = "/^[_a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$numberValidation = "/^[0-9]+$/";
		$addressValidation = "/^[A-Za-z0-9'\.\-\s\,]+$/";

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cellnumber = $_POST['cellnumber'];

		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email address';
			header('location: officers.php');
			exit();	
		}



		if(!preg_match($nameValidation,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: officers.php');
			exit();	
		}

		if(!preg_match($nameValidation,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: officers.php');
			exit();	
		}

		if(!preg_match($numberValidation,$cellnumber)){
			$_SESSION['error'] = 'Invalid Cell Number Format';
			header('location: officers.php');
			exit();	
		}
		else
		{
			if(strlen($cellnumber) > 10 || strlen($cellnumber) < 10)
			{
				$_SESSION['error'] = 'Invalid cell number cell number must be 10 digits';
				header('location: officers.php');
				exit();	
			} 
		}
		if(!empty($password))
		{
			if(strlen($password) < 8){
				$_SESSION['error'] = 'Password is too Short';
				header('location: officers.php');
				exit();	
			}
		}


		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM Officer WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Email already taken';
			exit();
		}

	
		else{
			$password = $password;
			$filename = $_FILES['photo']['name'];
			$now = date('Y-m-d');
			try{
				$stmt = $conn->prepare("INSERT INTO `officer` (`staffNumber`, `created_at`, `updated_at`, `firstname`, `lastname`, `email`,`cellnumber`,`password`, `one_time_pin`) VALUES (NULL, NOW(), NOW(), :firstname, :lastname, :email, :cellnumber, :password, :one_time_pin)");
				$stmt->execute(['firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email,'cellnumber'=>$cellnumber, 'password'=>$password, 'one_time_pin'=>$rand]);
				$_SESSION['success'] = 'Officer added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up officer form first';
	}

	header('location: officers.php');

?>