<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      รอดำเนินการ
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">รอดำเนินการ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
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
          <div class='alert alert-success alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-check'></i> สำเร็จ!</h4>
            ".$_SESSION['success']."
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
	        						<th>ลำดับ</th>
	        						<th>ชื่อสมาชิก</th>
	        						<th>ห้องพัก</th>
	        						<th>สถานะ</th>
	        						<th>จัดการ</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT details.* ,products.name ,users.firstname, users.lastname FROM `details` 
                      INNER JOIN products ON details.product_id = products.id 
                      INNER JOIN users ON details.user_id = users.id
                      WHERE details.room_state = 0");
                      $stmt->execute();
                      $c =0 ;
                      foreach($stmt as $row){
                        $c+=1;
                        $pay_post;
                        ($row['room_state']=='0')?$pay_post="รอดำเนินการ":$pay_post="ดำเนินการสำเร็จ";
                        echo "
                          <tr>
                            <td class='hidden'></td>
                            <td>".$c."</td>
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                            <td>".$row['name']."</td>
                            <td>".$pay_post."</td>
                            <td>
                            <button class='btn btn-success btn-sm checkedd btn-flat' data-id='".$row['id']."'><i class='fa fa-check'></i> ยืนยัน</button>
                            <button class='btn btn-danger btn-sm deleted btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> ลบ</button>
                            </td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
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
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/salse_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<!-- Date Picker -->
<script>
$(function(){

  $(document).on('click', '.checkedd', function(e){
    e.preventDefault();
    $('#checkedd').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.deleted', function(e){
    e.preventDefault();
    $('#deleted').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.status', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'sales_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.salesid').val(response.id);
      $('#edit_user_id').val(response.user_id);
      $('#edit_pay_id').val(response.pay_id);
      $('#edit_sales_date').val(response.sales_date);
      $('#edit_sales_state').val(response.sales_state);
      $('.fullname').html('ID : '+response.id);
    }
  });
}
</script>
</body>
</html>
