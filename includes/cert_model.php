


<?php 


    $id = 1;
    $nameAc;
    $nameAcid ;
    $conn = $pdo->open();
      $stmt = $conn->prepare("SELECT * FROM `account` WHERE account_id =$id");
      $stmt->execute(['account_id '=>$id]);
      foreach($stmt as $row){
        $nameAc = $row['account_bankname'] ;
        $nameAcid = $row['account_bankid'] ;
    }
  
?>
<div class="modal fade" id="insert_cert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center"><b>ยืนยันการชำระเงิน</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="sales.php?pay=0" enctype="multipart/form-data">

              <div class="form-group">
                    <label for="contact" class="col-sm-5 control-label">เลขบัญชีร้าน</label>

                    <div class="col-sm-7">
                      <input class="form-control"  type="text" value=<?php echo $nameAc."-".$nameAcid ; ?>  readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-5 control-label">จำนวนเงินที่ชำระ</label>

                    <div class="col-sm-7">
                      <input class="form-control"  type="number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-5 control-label">หลักฐานการชำระเงิน</label>

                    <div class="col-sm-7">
                      <input class="form-control"  type="file" id="photo" name="photo" required>
                    </div>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" ><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>