<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("Select T.*,C.chargeType, C.penalty,V.*,D.firstname, D.lastname, D.address, D.email, D.cellnumber, L.dateIssued, L.expiryDate, L.licenceCode, L.PrDP 
		from ticket as T
		LEFT JOIN charge as C ON C.chargeCode = T.chargeCode
		LEFT JOIN vehicle as V ON V.vehicleRegistration = T.vehicleRegistration
		LEFT JOIN driver as D ON D.Id = T.Id
		LEFT JOIN licence as L on L.Id = D.Id where reference=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>