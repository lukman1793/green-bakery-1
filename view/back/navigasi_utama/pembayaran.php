<?php
$conf = new config();
$host = 'http://'.$conf->curExpPageURL()[2].'/'.$conf->curExpPageURL()[3];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Green Bakery</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/dist/css/skins/_all-skins.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=$host;?>/assets/back/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=$host.'/panel'?> class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>G</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Green</b>Bakery</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=$host;?>/assets/back/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Administrator</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=$host;?>/assets/back/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Administrator
                  <small>-</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=$host;?>/panel/do_logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=$host;?>/assets/back/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?=$host;?>/panel">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?=$host;?>/panel/barang">
            <i class="fa fa-folder-open"></i> <span>Barang</span>
          </a>
        </li>
        <li>
          <a href="<?=$host;?>/panel/transaksi">
            <i class="fa fa-folder-open"></i>
            <span>Transaksi</span>
          </a>
        </li>
        <li>
          <a href="<?=$host;?>/panel/pembayaran">
            <i class="fa fa-folder-open"></i>
            <span>Pembayaran</span>
          </a>
        </li>
        <li>
          <a href="<?=$host;?>/panel/pengiriman">
            <i class="fa fa-folder-open"></i>
            <span>Pengiriman</span>
          </a>
        </li>
        <li class="header">SETTINGS</li>
        <li><a href="<?=$host;?>/panel/pengguna"><i class="fa fa-folder-open"></i> <span>Pengguna</span></a></li>
		    <li><a href="<?=$host;?>/panel/pelanggan"><i class="fa fa-folder-open"></i> <span>Pelanggan</span></a></li>
        <li><a href="<?=$host;?>/panel/kategori"><i class="fa fa-folder-open"></i> <span>Kategori</span></a></li>
        <li><a href="<?=$host;?>/panel/laporan"><i class="fa fa-folder-open"></i> <span>Laporan</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Master Transaksi</h3>
              <!--
                <button class="btn btn-primary btn-sm pull-right tambah" data-toggle="modal" data-target="#modal-default">Tambah</button>
              -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="transaksi" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID Transaksi</th>
                  <th>Bukti Pembayaran</th>
                  <th>Tanggal Di Kirim</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = $data_pembayaran->fetch_assoc()) : ?>
                  <tr>
                    <td><a href="<?=$host.'/panel/detail_transaksi/?id_transaksi='.$row['id_transaksi'];?>"><?=$row['id_transaksi'];?></a></td>
                    <td><button type="button" id="<?=$row['id_transaksi'];?>" class="btn btn-xs btn-flat btn-success lihat-bukti">Lihat Bukti Transfer</button></td>
                    <td><?=$row['tgl_dikirim'];?></td>
                    <td>
                      <?php if ($row['disetujui'] == 0) : ?>
                        <button id="<?=$row['id_transaksi'];?>" type="button" class="btn btn-xs btn-success setujui">Setujui</button>
                      <?php else : ?>
                        <button id="<?=$row['id_transaksi'];?>" type="button" class="btn btn-xs btn-danger batalkan">Batalkan</button>
                      <?php endif ?>
                    </td>
                  </tr>
                  <?php endwhile ?>

                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->

        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

        </section>
        <!-- /.Left col -->

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Bukti Transfer</h4>
        </div>
        <div class="modal-body">
            <img class="img-responsive" id="bukti" src="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="#">Green Bakery</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=$host;?>/assets/back/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=$host;?>/assets/back/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=$host;?>/assets/back/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?=$host;?>/assets/back/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$host;?>/assets/back/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="<?=$host;?>/assets/back/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=$host;?>/assets/back/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=$host;?>/assets/back/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?=$host;?>/assets/back/dist/js/demo.js"></script>

<script>
  $(function () {
    $('#transaksi').DataTable()
  })

  $('.lihat-bukti').click(function(){
    var id = this.id;
    $('#modal-default').modal();
    $.post("<?=$host;?>/panel/ambil_foto_bukti",{id_transaksi: id}).done(function(data){
      var data = jQuery.parseJSON(data);
      console.log(id);
      console.log("<?=$host;?>/uploads/bukti_pembayaran/"+data[0]);
      $("#bukti").attr('src', "<?=$host;?>/uploads/bukti_pembayaran/"+data[0]);
    })
  })

  $(".setujui").click(function(){
    var id = this.id;
    var status = 1;
    var x = confirm("Apakah anda yakin?");
    if(x){
      $.post('<?=$host;?>/panel/rubah_status_pembayaran',{id_transaksi:id, status_pembayaran: status}).done(function(){
        alert('Pembayaran telah di setujui');
        location.reload();
      })
    }
  })

  $(".batalkan").click(function(){
    var id = this.id;
    var status = 0;
    var x = confirm("Apakah anda yakin?");
    if(x){
      $.post('<?=$host;?>/panel/rubah_status_pembayaran',{id_transaksi:id, status_pembayaran: status}).done(function(){
        alert('Pembayaran di batalkan');
        location.reload();
      })
    }
  })
</script>

</body>
</html>
