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
        Vehicle
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vehicle</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              <a style="margin-left: 5px;" href="#addnewType" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> New Vehicle Type</a>
              <div class="pull-right">
                <form method="POST" class="form-inline" action="vehicle_print.php">
                  
                  <button type="submit" class="btn btn-success btn-sm btn-flat" name="print"><span class="glyphicon glyphicon-print"></span> Print</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Vehicle Registration.</th>
                  <th>Licence Disk</th>
                  <th>Model.</th>
                  <th>Vehicle Type</th>
                  <th>Vehicle Colour</th>
                  <th>Vehicle Owner</th>
                  <th>Vehicle Registered Address</th>              
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM vehicle");
                      $stmt->execute();
                      foreach($stmt as $row){

                        echo "
                          <tr>
                            <td>".$row['vehicleRegistration']."</td> 
                            <td>".$row['licenceDisk']."</td>
                            <td>".$row['model']."</td> 
                            <td>".$row['vehicleType']."</td>
                            <td>".$row['vehicleColour']."</td>
                            <td>".$row['vehicleOwner']."</td>
                            <td>".$row['vehicleRegisteredAddress']."</td>     
                            <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['vehicleRegistration']."'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['vehicleRegistration']."'><i class='fa fa-trash'></i> Delete</button>
                             
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
    <?php include 'includes/vehicle_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
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
    url: 'vehicle_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.vehicleRegistration);
      $('#edit_vehicleReg').val(response.vehicleRegistration);
      $('#edit_model').val(response.model);
      $('#edit_vehicleType').val(response.vehicleType);
      $('#edit_vehicleColour').val(response.vehicleColour);
      $('#edit_vehicleOwner').val(response.vehicleOwner);
      $('#edit_vehicleRegisteredAddress').val(response.vehicleRegisteredAddress);
      $('#edit_licenceDisk').val(response.licenceDisk);
      $('.fullname').html('Vehicle Registration: ' + response.vehicleRegistration + '<br>Owned By :'+response.vehicleOwner);
    }
  });
}

// function getCategory(){
//   $.ajax({
//     type: 'POST',
//     url: 'category_fetch.php',
//     dataType: 'json',
//     success:function(response){
//       $('#category').append(response);
//       $('#edit_category').append(response);
//     }
//   });
// }
</script>
<script>
    $(function(){
  //Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  
});
</script>
</body>
</html>
