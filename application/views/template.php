<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Market POS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Icon -->
  <link rel="shortcut icon" href="<?= base_url('assets'); ?>/dist/img/icon/favicon.ico" />
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">


<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="<?= site_url('dashboard'); ?>" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown user user-menu">
				<a href="<?= site_url('dashboard'); ?>" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<img src="<?= base_url('assets'); ?>/dist/img/profile/<?= $this->fungsi->user_login()->image; ?>" class="user-image img-circle elevation-2 alt="User Image">
					<span class="hidden-xs"><?= $this->fungsi->user_login()->username; ?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<!-- User image -->
					<li class="user-header bg-default">
						<img src="<?= base_url('assets'); ?>/dist/img/profile/<?= $this->fungsi->user_login()->image; ?>" class="img-circle elevation-2" alt="User Image">

						<p>
              <?= $this->fungsi->user_login()->name; ?>
							<small><?= $this->fungsi->user_login()->address; ?></small>
						</p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
						<div class="float-left">
							<a href="<?= site_url('dashboard'); ?>" class="btn btn-primary ">Profile</a>
						</div>
						<div class="float-right">
							<a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Sign out</a>
						</div>
					</li>
				</ul>
			</li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>dashboard" class="brand-link">
      <img src="<?= base_url('assets'); ?>/dist/img/market.png"
           alt="Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Market <strong class="text-bold">POS</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets'); ?>/dist/img/profile/<?= $this->fungsi->user_login()->image; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= site_url('dashboard'); ?>" class="d-block"><?= $this->fungsi->user_login()->username; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					
					<li class="nav-item">
            <a href="<?= site_url('dashboard'); ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
					<li class="nav-header">MAIN NAVIGATION</li>
					
          <li class="nav-item">
            <a href="<?= site_url('supplier'); ?>" class="nav-link <?= $this->uri->segment(1) == 'supplier' ? 'active' : ''; ?>">
              <i class="nav-icon fa fa-truck"></i>
              <p>
								Suppliers
              </p>
            </a>
					</li>

					<li class="nav-item">
            <a href="<?= site_url('customer'); ?>" class="nav-link <?= $this->uri->segment(1) == 'customer' ? 'active' : ''; ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
								Customers
              </p>
            </a>
					</li>
					
          <li class="nav-item has-treeview <?= $this->uri->segment(1) == 'category' || $this->uri->segment(1) == 'unit' || $this->uri->segment(1) == 'item' ? 'menu-open' : ''; ?>">
            <a href="" class="nav-link <?= $this->uri->segment(1) == 'category' || $this->uri->segment(1) == 'unit' || $this->uri->segment(1) == 'item' ? 'active' : ''; ?>">
              <i class="nav-icon fa fa-archive"></i>
              <p>
								Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('category'); ?>" class="nav-link <?= $this->uri->segment(1) == 'category' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('unit'); ?>" class="nav-link <?= $this->uri->segment(1) == 'unit' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('item'); ?>" class="nav-link <?= $this->uri->segment(1) == 'item' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item</p>
                </a>
              </li>
            </ul>
					</li>
					
          <li class="nav-item has-treeview <?= $this->uri->segment(1) == 'stock' ||  $this->uri->segment(1) == 'sale' ? 'menu-open' : ''; ?>">
            <a href="" class="nav-link <?= $this->uri->segment(1) == 'stock' ||  $this->uri->segment(1) == 'sale' ? 'active' : ''; ?>">
              <i class="nav-icon fa fa-shopping-cart"></i>
              <p>
								Transaction
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('sale'); ?>" class="nav-link <?= $this->uri->segment(1) == 'sale' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('stock/in'); ?>" class="nav-link <?= $this->uri->segment(1) == 'stock' && $this->uri->segment(2) == 'in' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock In</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('stock/out'); ?>" class="nav-link <?= $this->uri->segment(1) == 'stock' && $this->uri->segment(2) == 'out' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Out</p>
                </a>
              </li>
            </ul>
					</li>
					
					<li class="nav-item has-treeview <?= $this->uri->segment(1) == 'reports' ? 'menu-open' : ''; ?>">
            <a href="" class="nav-link <?= $this->uri->segment(1) == 'reports' ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
								Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('reports/sales'); ?>" class="nav-link <?= $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'sales' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('reports/stocks'); ?>" class="nav-link <?= $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'stocks' ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stocks</p>
                </a>
              </li>
            </ul>
					</li>
					
          <?php if( $this->fungsi->user_login()->level == 1)  { ?>
          <li class="nav-header">SETTINGS</li>
          <li class="nav-item">
            <a href="<?= site_url('user'); ?>" class="nav-link <?= $this->uri->segment(1) == 'user' ? 'active' : ''; ?>">
              <i class="nav-icon fa fa-user"></i>
              <p>
								Users
              </p>
            </a>
					</li>
          <?php } ?>
        
          <li class="nav-header">SIGN OUT</li>
					<li class="nav-item">
            <a href="<?= site_url('auth/logout'); ?>" class="nav-link" data-toggle="modal" data-target="#logoutModal">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
								Sing Out
              </p>
            </a>
					</li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <!-- jQuery -->
  <script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>

    <?= $contents; ?>

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="<?= site_url('dashboard'); ?>">Market POS</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ingin Logout?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Pilih "Logout" jika anda ingin keluar dari akun ini.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-danger" href="<?= site_url('auth/logout') ?>">Logout</a>
			</div>
		</div>
	</div>
</div>



<!-- Bootstrap 4 -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets'); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets'); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets'); ?>/dist/js/demo.js"></script>
<script>
  // Script Datatables
  $(function () {
    $("#table1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#table2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  // Script Upload File
  $('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});
</script>
</body>
</html>
