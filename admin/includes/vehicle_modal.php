<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Vehicle</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="vehicle_add.php" enctype="multipart/form-data">
               
                <div class="form-group">
                    <label for="vehicleReg" class="col-sm-3 control-label">Vehicle Registration</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="vehicleReg" name="vehicleReg" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="licenceDisk" class="col-sm-3 control-label">Licence Disk</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="licenceDisk" name="licenceDisk" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="model" class="col-sm-3 control-label">Model</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicleType" class="col-sm-3 control-label">Vehicle Type</label>

                    <div class="col-sm-9">
                    <select name="vehicleType" class="form-control input-sm" id="vehicleType">
                    <option value="0">Select One</option>
                    <?php    
                        $conn = $pdo->open();

                            try{
                            $stmt = $conn->prepare("SELECT * FROM vehicletype");
                            $stmt->execute();
                            foreach($stmt as $row){

                                echo "
                                <option value=".$row['vehicleType'].">".$row['vehicleType']."</option>
                                ";
                            }
                            }
                            catch(PDOException $e){
                            echo $e->getMessage();
                            }

                            $pdo->close();

                        ?>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicleColour" class="col-sm-3 control-label">Vehicle Colour</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="vehicleColour" name="vehicleColour" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicleOwner" class="col-sm-3 control-label">Vehicle Owner</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="vehicleOwner" name="vehicleOwner" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicleRegisteredAddress" class="col-sm-3 control-label">Vehicle Registered Address</label>

                    <div class="col-sm-9">
                      <textarea name="vehicleRegisteredAddress" id="vehicleRegisteredAddress" cols="50" rows="5"></textarea>
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


<!-- Add Vehicle Type -->
<div class="modal fade" id="addnewType">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Vehicle Type</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="vehicle_type_add.php" enctype="multipart/form-data">
               
                <div class="form-group">
                    <label for="vehicleType" class="col-sm-3 control-label">Vehicle Type</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="vehicleType" name="vehicleType" required>
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
              <h4 class="modal-title"><b>Edit Licence</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="licence_edit.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">ID</label>

                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="edit_id" name="new_id" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Licence Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_licence_number" name="licence_number" required>
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="licence-code" class="col-sm-3 control-label">Licence Code</label>

                    <div class="col-sm-9">
                    <select name="licence-code" class="form-control input-sm" id="edit_licence-code">
                        <option value="0">Select One</option>
                        <option value="A">A</option>
                        <option value="A1">A1</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="C1">C1</option>
                        <option value="EB">EB</option>
                        <option value="EC">EC</option>
                        <option value="EC">EC1</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">PrDP</label>

                    <div class="col-sm-9">
                      <select name="prdp" id="edit_prdp">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateIssued" class="col-sm-3 control-label">Date Issued</label>
                    <div class="col-sm-9">
                    <input type="date" id="edit_dateIssued" name="dateIssued">
                    </div>
                </div>
                <div class="form-group">
                    <label for="expiryDate" class="col-sm-3 control-label">Expiry Date</label>
                    <div class="col-sm-9">
                    <input type="date" id="edit_expiryDate" name="expiryDate">
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
              <form class="form-horizontal" method="POST" action="licence_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE LICENCE</p>
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

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit User</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_edit.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="edit_email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="edit_email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="edit_password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname">
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
              <form class="form-horizontal" method="POST" action="users_delete.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE LICENCE</p>
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


     