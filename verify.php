<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	if(isset($_POST['login'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];

		try{

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM user WHERE account_deactivated='Yes' AND username=:username");
			$stmt->execute(['username'=>$username]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'This Account has been deactivated';
			}
			else
			{
				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM user WHERE username = :username");
			$stmt->execute(['username'=>$username]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
					if($password == $row['password'])
					{
							$_SESSION['user'] = $row['id'];
					}
					else{
						$_SESSION['error'] = 'Incorrect Password';
					}
			}
			else
			{

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows1 FROM administrator WHERE adminEmail = :email");
				$stmt->execute(['email'=>$username]);
				$row = $stmt->fetch();

				if($row['numrows1'] > 0){
					if($password == $row['password']){
							$_SESSION['admin'] = $row['adminEmail'];
					}
					else{
						$_SESSION['error'] = 'Incorrect Password';
					}
				}
				else
				{
					$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows2 FROM employer WHERE email = :email");
					$stmt->execute(['email'=>$username]);
					$row = $stmt->fetch();

					if($row['numrows2'] > 0){
						if($password == $row['password']){
								$_SESSION['employer'] = $row['id'];
						}
						else{
							$_SESSION['error'] = 'Incorrect Password';
						}
					}
					else
					{
						$_SESSION['error'] = 'Email not found';
					}

				}

			}
			}

			
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Input login credentails first';
	}

	$pdo->close();

	header('location: login.php');

?>