<?php include 'includes/session.php'; ?>
<?php
	$slug = 'tablets';

	$conn = $pdo->open();
	$pagin = 0 ;
	try{
        $inc = 3;	
        $stmt = $conn->prepare("SELECT * FROM products ");
        $stmt->execute();
        $count = 0 ;
        foreach ($stmt as $row) {
            $count = $count + 1;
        }
		$pagin = ceil($count/12) ;
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();
	$fech = 0 ;
?>

<script>
function Show(hello)
	{
		$fech = hello;
	var hai=hello
	alert($fech);
	}
</script>

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
                            <h3>รายการสินค้าทั้งหมด  <?php echo $count ; ?> รายการ</h3>
		
                            <?php
		       			
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 4;	
						    $stmt = $conn->prepare("SELECT * FROM products ");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 4) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								   <div class='col-sm-3' '>
								   <div class='box box-solid' style=' border-radius: 5px; padding-bottom: 20px;'>
										  <div class='box-body prod-body' style='position: relative;'>
											  <img src='".$image."' width='100%' height='230px' class='thumbnail'>
											  <p style='position: absolute; right: 10px; bottom:-20px '> ราคา ".number_format($row['price'], 2)." บาท</p>
											  <h4> <a href='product.php?product=".$row['slug']."'>".$row['name']." </a></h4>
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
                        <div class="col-sm-3">
                            <?php include 'includes/sidebar.php'; ?>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <?php include 'includes/scripts.php'; ?>
    
<script>
$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});

});
</script>
</body>

</html>