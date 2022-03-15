<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];
	$quantity = $_POST['quantity'];

	if(isset($_SESSION['user'])){
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE user_id=:user_id AND product_id=:product_id");
		$stmt->execute(['user_id'=>$user['id'], 'product_id'=>$id]);
		$row = $stmt->fetch();
		if($row['numrows'] < 1){
			try{
				$stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
				$stmt->execute(['user_id'=>$user['id'], 'product_id'=>$id, 'quantity'=>$quantity]);


				

				$stmt2 = $conn->prepare("INSERT INTO details (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
				$stmt2->execute(['user_id'=>$user['id'], 'product_id'=>$id, 'quantity'=>0]);

				

				$output['message'] = 'จองห้องพักนี้แล้ว';

				
			}
			catch(PDOException $e){
				$output['error'] = true;
				$output['message'] = $e->getMessage();
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'คุณจองห้องพักนี้ไปแล้วกรุณาเลือกห้องอื่น';
		}
	}
	else{
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}

		$exist = array();

		foreach($_SESSION['cart'] as $row){
			array_push($exist, $row['productid']);
		}

		if(in_array($id, $exist)){
			$output['error'] = true;
			$output['message'] = 'คุณจองห้องพักนี้ไปแล้วกรุณาเลือกห้องอื่น';
		}
		else{
			$data['productid'] = $id;
			$data['quantity'] = $quantity;

			if(array_push($_SESSION['cart'], $data)){
				$output['message'] = 'เพิ่มในตะกร้าแล้ว';
			}
			else{
				$output['error'] = true;
				$output['message'] = 'ไม่สามารถเพิ่มสิรค้าในตะกร้าได้';
			}
		}

	}

	$pdo->close();
	// echo ($quantity);
	echo json_encode($output);

?>