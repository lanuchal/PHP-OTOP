
<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>ลบข้อมูล</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="sales_delete.php">
                <input type="hidden" class="salesid" name="id">
                <div class="text-center">
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Deleted -->
<div class="modal fade" id="deleted">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>ลบข้อมูล</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="sales_deleted.php">
                <input type="hidden" class="salesid" name="id">
                <div class="text-center">
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- checkedd -->
<div class="modal fade" id="checkedd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>ยืนยันจองห้องพัก</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="sales_update.php">
              <input type="hidden" class="salesid" name="id">
              <div class="text-center">
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
              <button type="submit" class="btn btn-success btn-flat" name="delete"><i class="fa fa-check"></i> ยืนยัน</button>
              </form>
            </div>
        </div>
    </div>
</div>