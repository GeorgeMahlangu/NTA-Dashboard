<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	if(isset($_POST['register'])){


		$nameValidation = "/^[a-zA-Z ]+$/";
		$emailValidation = "/^[_a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$numberValidation = "/^[0-9]+$/";
		$addressValidation = "/^[A-Za-z0-9'\.\-\s\,]+$/";
		
		$firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $verifyPassword = $_POST['verify_password'];
		$password = $_POST['password'];
        
        
		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email address';
			header('location: signup.php');
			exit();	
		}

		if(!preg_match($nameValidation,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: signup.php');
			exit();	
		}

		if(!preg_match($nameValidation,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: signup.php');
			exit();	
		}

	
		if(!empty($password))
		{
            if($verifyPassword != $password)
            {
                $_SESSION['error'] = 'Password do not match';
				header('location: signup.php');
				exit();	

            }
			if(strlen($password) < 8){
				$_SESSION['error'] = 'Password is too Short';
				header('location: signup.php');
				exit();	
			}
		}
		try{

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM administrator WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Email Already Exist Please register another email';
			}
			else
			{
				$stmt = $conn->prepare("INSERT INTO `administrator` (`firstname`,`lastname`, `email`, `password`) VALUES (:firstname, :lastname, :email, :password)");
				$stmt->execute(['firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email, 'password'=>$password]);
				$_SESSION['success'] = 'Administrator added successfully proceed to login';

			}
			
		

			
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Fill registration form first';
	}

	$pdo->close();

	header('location: signup.php');

?>