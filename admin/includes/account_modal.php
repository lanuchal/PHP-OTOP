
<!-- Edit -->

<?php 


    $id = 1;
    $account_bankname;
    $account_bankid ;
    $account_name;
    $conn = $pdo->open();
      $stmt = $conn->prepare("SELECT * FROM `account` WHERE account_id =$id");
      $stmt->execute(['account_id '=>$id]);
      foreach($stmt as $row){
        $account_bankname = $row['account_bankname'] ;
        $account_bankid = $row['account_bankid'] ;
        $account_name =strval($row['account_name']) ;
    }
  
?>

<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>แก้ไขข้อมูล</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="account_edit.php">
              <div class="form-group">
                    <label for="account_bankname" class="col-sm-3 control-label">ธนาคาร</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="account_bankname" name="account_bankname" value=<?php echo $account_bankname; ?>>
                    </div>
                </div><div class="form-group">
                    <label for="account_bankid" class="col-sm-3 control-label">เลขบัญชี</label>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" id="account_bankid" name="account_bankid" value=<?php echo $account_bankid ;?>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="account_bankid" class="col-sm-3 control-label">ชื่อ</label>

                    <div class="col-sm-9">
                      <input  class="form-control" id="account_name" name="account_name" value=<?php echo $account_name ;?>>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>