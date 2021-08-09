<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($admin['photo'])) ? '../images/'.$admin['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $admin['firstname'].' '.$admin['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">WELCOME</li>
      <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>
      <li><a href="officers.php"><i class="fa fa-users"></i> <span>Officers</span></a></li>
      <li><a href="drivers.php"><i class="fa fa-user"></i> <span>Drivers</span></a></li>
      <li><a href="tickets.php"><i class="fa fa-money"></i> <span>Tickets</span></a></li>
      <li><a href="licence.php"><i class="fa fa-barcode"></i> <span>Licences</span></a></li>
      <li><a href="charges.php"><i class="fa fa-line-chart"></i> <span>Charges</span></a></li>
      <li><a href="vehicle.php"><i class="fa fa-car"></i> <span>Vehicle</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>