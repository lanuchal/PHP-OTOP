<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{

			$stmt = $conn->prepare("UPDATE details SET room_state=:room_state  WHERE id=:id");
			$stmt->execute(['room_state'=>1, 'id'=>$id]);

			$stmt2 = $conn->prepare("SELECT * FROM details WHERE id=:id");
			$stmt2->execute(['id'=>$id]);
			$row = $stmt2->fetch();

			$stmt3 = $conn->prepare("UPDATE products SET state_room=:state_room  WHERE id=:id");
			$stmt3->execute(['state_room'=>0, 'id'=>$row['product_id']]);

			
			$_SESSION['success'] = 'ยืนยันจองห้องสำเร็จ';

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
		$_SESSION['error'] = 'ยืนยันจองห้องไม่สำเร็จ';
	}
	
	header('location: sales.php');
	
?>