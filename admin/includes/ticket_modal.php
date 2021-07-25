<?php

 $catid = "";
  $where = '';
  if(isset($_GET['chargeCode'])){
    $catid = $_GET['chargeCode'];
    $where = 'WHERE chargeCode ='.$catid;
  }

?>
<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Ticket</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="ticket_add.php" enctype="multipart/form-data">
                <h5 class="modal-title"><b>Driver Particulars</b></h5>
                <br>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstnane" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cellnumber" class="col-sm-3 control-label">Cell Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="cellnumber" name="cellnumber" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                    <textarea id="address" name="address" rows="4" cols="50">

                    </textarea>
                    </div>
                </div>
                <h5 class="modal-title"><b>Licence Particulars</b></h5>
                <br>
                <div class="form-group">
                    <label for="cellnumber" class="col-sm-3 control-label">Licence Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="licence-code" name="licence-code" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">PrDP</label>

                    <div class="col-sm-9">
                      <input type="radio" id="prdp" name="prdp" value="Yes">
                      <label for="prdp">Yes</label>
                      <input type="radio" id="prdp1" name="prdp" value="No">
                      <label for="prdp1">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateIssued" class="col-sm-3 control-label">Date Issued</label>
                    <div class="col-sm-9">
                    <input type="date" id="dateIssued" name="dateIssued">
                    </div>
                </div>
                <div class="form-group">
                    <label for="expiryDate" class="col-sm-3 control-label">Expiry Date</label>
                    <div class="col-sm-9">
                    <input type="date" id="expiryDate" name="expiryDate">
                    </div>
                </div>
                <h5 class="modal-title"><b>Motor Vehicle Particulars</b></h5>
                <br>
                <div class="form-group">
                    <label for="owner" class="col-sm-3 control-label">Vehicle Owner</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="owner" name="owner" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicle-address" class="col-sm-3 control-label">Vehicle Registered Address</label>
                    <div class="col-sm-9">
                    <textarea id="vehicle-address" name="vehicle-address" rows="4" cols="50">

                    </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-sm-3 control-label">Vehicle Type</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="model" class="col-sm-3 control-label">Vehicle Model</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="licence-number" class="col-sm-3 control-label">Licence Disk Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="licence-number" name="licence-number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicle-color" class="col-sm-3 control-label">Vehicle Colour</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="vehicle-color" name="vehicle-color" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="charge-code" class="col-sm-3 control-label">Charge Code</label>

                    <div class="col-sm-9">
                    <select name="charge-code" class="form-control input-sm" id="charge-code">
                    <option value="0">ALL</option>
                    <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM charge");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['chargeCode'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['chargeCode']."' ".$selected.">".$crow['chargeType']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                      
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
              <h4 class="modal-title"><b>View Ticket</b></h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" method="POST" action="ticket_add.php" enctype="multipart/form-data">
                <h5 class="modal-title"><b>Driver Particulars</b></h5>
                <br>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">ID</label>

                    <div class="col-sm-9">
                      <input readonly id="edit_id" type="text" class="form-control" name="id" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstnane" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input readonly id="edit_firstname" type="text" class="form-control" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input readonly id="edit_lastname" type="text" class="form-control" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cellnumber" class="col-sm-3 control-label">Cell Number</label>

                    <div class="col-sm-9">
                      <input readonly id="edit_cellnumber" type="text" class="form-control" name="cellnumber" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input readonly id="edit_email" type="email" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                    <textarea readonly id="edit_address" name="address" rows="4" cols="50">

                    </textarea>
                    </div>
                </div>
                <h5 class="modal-title"><b>Licence Particulars</b></h5>
                <br>
                <div class="form-group">
                    <label for="cellnumber" class="col-sm-3 control-label">Licence Code</label>

                    <div class="col-sm-9">
                      <input readonly id="edit_licenceCode" type="text" class="form-control" name="licence-code" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">PrDP</label>

                    <div class="col-sm-9">
                      <input readonly id="edit_PrDP" type="text" class="form-control" name="licence-code" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateIssued" class="col-sm-3 control-label">Date Issued</label>
                    <div class="col-sm-9">
                    <input readonly id="edit_issueDate" type="text" class="form-control" name="licence-code" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="expiryDate" class="col-sm-3 control-label">Expiry Date</label>
                    <div class="col-sm-9">
                    <input readonly id="edit_expiryDate" type="text" class="form-control" name="licence-code" required>
                    </div>
                </div>
                <h5 class="modal-title"><b>Motor Vehicle Particulars</b></h5>
                <br>
                <div class="form-group">
                    <label for="owner" class="col-sm-3 control-label">Vehicle Owner</label>

                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="edit_owner" name="owner" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicle-address" class="col-sm-3 control-label">Vehicle Registered Address</label>
                    <div class="col-sm-9">
                    <textarea readonly id="edit_vehicleRegisteredAddress" name="vehicle-address" rows="4" cols="50">

                    </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-sm-3 control-label">Vehicle Type</label>

                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="edit_type" name="type" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="model" class="col-sm-3 control-label">Vehicle Model</label>

                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="edit_model" name="model" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="licence-number" class="col-sm-3 control-label">Licence Disk Number</label>

                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="edit_licence-number" name="licence-number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="licence-number" class="col-sm-3 control-label">Vehicle Registration</label>

                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="edit_vehicle-registration" name="registration-number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicle-color" class="col-sm-3 control-label">Vehicle Colour</label>

                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="edit_vehicle-color" name="vehicle-color" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="charge-code" class="col-sm-3 control-label">Charge Code</label>

                    <div class="col-sm-9">
                    <input readonly type="text" class="form-control" id="edit_chargeCode" name="vehicle-color" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="charge-code" class="col-sm-3 control-label">Charge Type</label>

                    <div class="col-sm-9">
                    <input readonly type="text" class="form-control" id="edit_chargeType" name="vehicle-color" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="charge-code" class="col-sm-3 control-label">Penalty</label>

                    <div class="col-sm-9">
                    <input readonly type="text" class="form-control" id="edit_penalty" name="vehicle-color" required>
                    </div>
                </div>
               
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <!-- <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button> -->
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
              <form class="form-horizontal" method="POST" action="ticket_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE TICKET</p>
                    <h2 class="bold refference"></h2>
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

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div> 


<!-- Activate -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activating...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE USER</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Activate</button>
              </form>
            </div>
        </div>
    </div>
</div> 


     