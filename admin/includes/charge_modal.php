<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Charge</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="charges_add.php" enctype="multipart/form-data">
               
                <div class="form-group">
                    <label for="chargeCode" class="col-sm-3 control-label">Charge Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="chargeCode" name="chargeCode" required>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="licence-code" class="col-sm-3 control-label">Charge Type (Descriptoin)</label>

                    <div class="col-sm-9">
                       <input type="text" class="form-control" id="chargeType" name="chargeType" required> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Penalty</label>

                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="penalty" name="penalty" required> 
                    </div>
                </div>
                
               
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Charge</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="charges_edit.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="chargeCode" class="col-sm-3 control-label">Charge Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_chargeCode" name="newChargeCode" required>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="licence-code" class="col-sm-3 control-label">Charge Type (Description)</label>

                    <div class="col-sm-9">
                       <input type="text" class="form-control" id="edit_chargeType" name="chargeType" required> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Penalty</label>

                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="edit_penalty" name="penalty" required> 
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

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="charges_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE CHARGE</p>
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



     