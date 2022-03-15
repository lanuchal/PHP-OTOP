<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{

			$stmt = $conn->prepare("DELETE FROM details WHERE id=:id");
			$stmt->execute(['id'=>$id]);


	

			
			$_SESSION['success'] = 'ลบการจองห้องสำเร็จ';

			// $stmt = $conn->prepare("DELETE FROM sales WHERE id=:id");
			// $stmt->execute(['id'=>$id]);

			// $_SESSION['success'] = 'ลบรายการสำเร็จ';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'ลบการจองห้องไม่สำเร็จ';
	}
	
	header('location: sales_active.php');
	
?>