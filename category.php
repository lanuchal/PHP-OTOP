<?php include 'includes/session.php'; ?>
<?php
	$slug = $_GET['category'];

	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = :slug");
		$stmt->execute(['slug' => $slug]);
		$cat = $stmt->fetch();
		$catid = $cat['id'];
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();

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
		            <h3 > <?php echo $cat['name']; ?></h3>
		       		<?php
		       			
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 4;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $catid]);
							$state_room = "";
							$color_r = "";

						    foreach ($stmt as $row) {
								if($row['state_room']==0){
									$state_room = "ไม่ว่าง";
									$color_r = "#f53434";
								}else{
									$state_room = "ว่าง";
									$color_r = "#0efc5d";
								}

						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 4) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								   <div class='col-sm-3' '>
								   <div class='box box-solid' style=' border-radius: 5px; '>
										  <div class='box-body prod-body' style='position: relative; padding-bottom: 20px;'>
											  <img src='".$image."' width='100%' height='230px' class='thumbnail'>
											  <p style='position: absolute; right: 10px; bottom:-20px '> ราคา ".number_format($row['price'], 2)." บาท</p>
											  <h4> <a href='product.php?product=".$row['slug']."'>".$row['name']." </a></h4>
											  <p style='position: absolute; right: 10px; bottom: 10px ;color:$color_r'>".$state_room."</p>
										  
											  </div>
											  
										  <div class='box-footer'>
										  </div>
									  </div>
								  </div>

	       						";
	       						if($inc == 4) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>