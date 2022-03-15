<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['user'])){
		header('location: index.php');
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-black layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
				<?php
      
					if(isset($_SESSION['error'])){
						echo "
						<div class='alert alert-danger alert-dismissible'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> ผิดพลาด!</h4>
							".$_SESSION['error']."
						</div>
						";
						unset($_SESSION['error']);
					}
					if(isset($_SESSION['success'])){
						echo "
						<div class='alert alert-info alert-dismissible'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> สำเร็จ!</h4>
							".$_SESSION['success']."
						</div>
						";
						unset($_SESSION['success']);
					}
					?>
	        		<div class="box box-solid">
	        			<div class="box-body" style="padding:30px;">
	        				<div class="col-sm-3">
	        					<img src="<?php echo (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.png'; ?>" width="100%">
	        				</div>
	        				<div class="col-sm-9">
	        					<div class="row">
	        						<div class="col-sm-4">
	        							<h4>ชื่อ - นามสกุล:</h4>
	        							<h4>อีเมล:</h4>
	        							<h4>ช่องทางติดต่อ:</h4>
	        							<h4>ที่อยู่:</h4>
	        							<h4>สมัครสมาชิกวันที่ :</h4>
	        						</div>
	        						<div class="col-sm-8">
	        							<h4><?php echo $user['firstname'].' '.$user['lastname']; ?>
	        								<span class="pull-right">
	        									<a href="#edit" class="btn btn-warning btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
	        								</span>
	        							</h4>
	        							<h4><?php echo $user['email']; ?></h4>
	        							<h4><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
	        							<h4><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4>
	        							<h4><?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="box box-solid" style="padding:30px;">
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>รายการจองห้องพัก</b></h4>
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered" id="example1">
	        					<thead>
	        						<th class="hidden"></th>
	        						<th>ลำดับ</th>
	        						<th>ห้องพัก</th>
	        						<th>สถานะ</th>
	        					</thead>
	        					<tbody>
	        					<?php
	        						$conn = $pdo->open();

	        						try{
	        							$stmt = $conn->prepare("SELECT details.* ,products.name FROM `details` INNER JOIN products ON details.product_id = products.id  WHERE details.user_id=:user_id");
	        							$stmt->execute(['user_id'=>$user['id']]);
										$c = 0;
	        							foreach($stmt as $row){
	        								$c+=1 ;
											$pay_id = $row['room_state'];
											($pay_id=='0')?$pay_id="รอดำเนินการ":$pay_id = $row['room_state'];

	        								echo "
	        									<tr>
	        										<td class='hidden'></td>
	        										<td>".$c."</td>
	        										<td>".$row['name']."</td>
	        										<td>".$pay_id."</td>
	        										
	        									</tr>
	        								";
	        							}

	        						}
        							catch(PDOException $e){
										echo "There is some problem in connection: " . $e->getMessage();
									}

	        						$pdo->close();
	        					?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/profile_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$(document).on('click', '.transact', function(e){
		e.preventDefault();
		$('#transaction').modal('show');
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'transaction.php',
			data: {id:id},
			dataType: 'json',
			success:function(response){
				$('#date').html(response.date);
				$('#transid').html(response.transaction);
				$('#detail').prepend(response.list);
				$('#total').html(response.total);
			}
		});
	});

	$("#transaction").on("hidden.bs.modal", function () {
	    $('.prepend_items').remove();
	});
});
</script>
</body>
</html>