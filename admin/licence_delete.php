<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM licence WHERE Id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'licence deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select licence to delete first';
	}

	header('location: licence.php');
	
?>