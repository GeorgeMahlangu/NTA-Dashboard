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
        Tickets
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tickets</li>
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
              <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a> -->
              <div class="pull-right">
                <form method="POST" class="form-inline" action="ticket_print.php">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range">
                  </div>
                  <button type="submit" class="btn btn-success btn-sm btn-flat" name="print"><span class="glyphicon glyphicon-print"></span> Print</button>
                </form>
              </div>
              <div class="pull-right">
                <form method="POST" class="form-inline" action="ticket_user_print.php" style="padding-right: 10px;">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input type="number" placeholder="Enter ID Number" class="form-control pull-right col-sm-8" id="report" name="report">
                  </div>
                  <button type="submit" class="btn btn-success btn-sm btn-flat" name="print"><span class="glyphicon glyphicon-print"></span> Print User Report</button>
                </form>
              </div>
              
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Reference.</th>
                  <th>Full Name</th>
                  <th>ID No</th>
                  <th>Email</th>
                  <th>Date Issued</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT T.*,C.chargeType, C.Penalty,V.*,D.firstname, D.lastname, D.address, D.email, D.cellnumber, L.dateIssued, L.expiryDate, L.licenceCode, L.PrDP 
                      from ticket as T
                      LEFT JOIN charge as C ON C.chargeCode = T.chargeCode
                      LEFT JOIN vehicle as V ON V.vehicleRegistration = T.vehicleRegistration
                      LEFT JOIN driver as D ON D.Id = T.Id
                      LEFT JOIN licence as L on L.Id = D.Id");
                      $stmt->execute();
                      foreach($stmt as $row){

                        echo "
                          <tr>
                            <td>".$row['reference']."</td> 
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                            <td>".$row['Id']."</td>
                            <td>".$row['email']."</td>
                            <td>".date('M d, Y', strtotime($row['created_at']))."</td>
                            <td>
                            <button class='btn btn-info btn-sm info edit btn-flat' data-id='".$row['reference']."'><i class='fa fa-search'></i> View</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['reference']."'><i class='fa fa-trash'></i> Delete</button>
                             
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
    <?php include 'includes/ticket_modal.php'; ?>

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
    url: 'tickets_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.reference);
      $('#edit_id').val(response.Id);
      $('#edit_email').val(response.email);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_cellnumber').val(response.cellnumber);
      $('#edit_licenceCode').val(response.licenceCode);
      $('#edit_PrDP').val(response.PrDP);
      $('#edit_PrDP').val(response.PrDP);
      $('#edit_issueDate').val(response.dateIssued);
      $('#edit_expiryDate').val(response.expiryDate);
      $('#edit_owner').val(response.vehicleOwner);
      $('#edit_vehicleRegisteredAddress').val(response.vehicleRegisteredAddress);
      $('#edit_type').val(response.vehicleType);
      $('#edit_model').val(response.model);
      $('#edit_licence-number').val(response.licenceDisk);
      $('#edit_vehicle-color').val(response.vehicleColour);      
      $('#edit_chargeCode').val(response.chargeCode);   
      $('#edit_chargeType').val(response.chargeType); 
      $('#edit_penalty').val(response.penalty); 
      $('#edit_vehicle-registration').val(response.vehicleRegistration);       
      $('.refference').html('Reference :'+response.reference);
      $('.fullname').html('Issued to :'+response.firstname+' '+response.lastname);
    }
  });
}

/** 
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
    }
  });
}
*/
 
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
