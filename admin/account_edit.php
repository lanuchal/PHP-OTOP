<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){

		$account_id = 1;
		$account_bankname = $_POST['account_bankname'];
		$account_bankid = $_POST['account_bankid'];
		$account_name = $_POST['account_name'];

		try{
			$stmt = $conn->prepare("UPDATE account SET account_bankname=:account_bankname, account_bankid=:account_bankid, account_name=:account_name WHERE account_id=:account_id");
			$stmt->execute(['account_bankname'=>$account_bankname, 'account_bankid'=>$account_bankid, 'account_name'=>$account_name, 'account_id'=>$account_id]);
			$_SESSION['success'] = 'แก้ไขข้อมูลสำเร็จ';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'แก้ไขข้อมูลไม่สำเร็จ';
	}

	header('location: account.php');

?>