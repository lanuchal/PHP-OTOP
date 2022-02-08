<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
	$slug = 'tablets';

	$month = date('m');
	$conn = $pdo->open();

	$count2 = 0 ;
	$count22 = 0 ;

	try{
	$stmt2 = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
	$stmt2->execute();
	foreach ($stmt2 as $row2) {
		$count22 =$count22 + 1 ;
		}
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	try{
        $stmt = $conn->prepare("SELECT * FROM products ");
        $stmt->execute();
        $count = 0 ;
        foreach ($stmt as $row) {
            $count = $count + 1;
        }
      
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();

?>

<body class="hold-transition skin-black layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper" >
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <!-- <div class="row">
	        	<div class="col-sm-12">
		            <h3>สินค้าขายดี </h3>
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		
		           
					<?php
					if ($count22 == 0) {
						?>
						 <div class="callout callout-warning text-start">
						<p>ไม่พบรายการสินค้า</p>
					</div>
						<?php
					}else{

						$month = date('m');
		       			$conn = $pdo->open();
						   

		       			try{
		       			 	$inc = 4;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
								$count2 = $count2 + 1;
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 4) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								   <div class='col-sm-3'>
								   <div class='box box-solid' style=' border-radius: 5px; '>
										  <div class='box-body prod-body' style='position: relative; padding-bottom: 20px;'>
											  <img src='".$image."' width='100%' height='230px' class='thumbnail'>
											  <p style='position: absolute; right: 10px; bottom:-20px  '> ราคา ".number_format($row['price'], 2)." บาท</p>
											  <h4><a href='product.php?product=".$row['slug']."'>".$row['name']." </a></h4>
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


					}
					
					?>
	        	</div>
	        </div> -->
			 <div class="row">
                        <div class="col-sm-12">
						<!-- C:\xampp\htdocs\testttt\mn0516.me\images\bg.jpg -->
						<img src='images\bg.jpg' width='100%' height='180%' class='thumbnail'/>

                          <h3>รายการสินค้าใหม่  4 รายการ</h3>
                           
                            <?php
		       			
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 4;	
						    $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 4");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 4) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-3' >
										<div class='box box-solid' style=' border-radius: 5px;  padding-bottom: 20px;'>
		       								<div class='box-body prod-body' style='position: relative;'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<p style='position: absolute; right: 10px; bottom:-20px '> ราคา ".number_format($row['price'], 2)." บาท</p>
		       									<h4><a href='product.php?product=".$row['slug']."'>".$row['name']." </a></h4>
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