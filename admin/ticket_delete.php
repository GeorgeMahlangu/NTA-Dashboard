<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM ticket WHERE refference=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Ticket deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select ticket to delete first';
	}

	header('location: tickets.php');
	
?>