<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Budgeting</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.css">
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/build/toastr.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jquery_ui/css/jquery-ui.css'?>">

        <link rel="icon" href="<?php echo base_url(); ?>assets/images/login.png">
        <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/select2/dist/js/select2.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- Datepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <!-- Timepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets/plugins/highcharts/highcharts.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/highcharts/modules/highcharts.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/highcharts/themes/dark-green.js" type="text/javascript"></script> -->
    
<script src="<?php echo base_url() ?>assets/chart/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/chart/js/exporting.js" type="text/javascript"></script>


        <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/uniform/css/uniform.default.min.css"> -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">
            <img src="<?php echo base_url() ?>assets/images/login.png" class="img-responsive">
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
            <img src="<?php echo base_url() ?>assets/images/login.png" class="img-responsive">
          </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

          
              <!-- Notifications: style can be found in dropdown.less -->
             
              <!-- User Account: style can be found in dropdown.less -->
             
               <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url() ?>assets/dist/img/logo.png ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $login_user->full_name ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                    <span class="logo-lg">
                       <!-- <img src="<?php echo base_url() ?>assets/dist/img/logo.png" class="img-responsive"> -->
                    </span>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo  base_url() . "auth/logout" ?>" class="btn btn-default btn-flat">Sign out</a>
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
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <?php $date_now = date("Y-m-d");
            if (!empty($menu_trans)): ?>
              <li class="header">MAIN NAVIGATION</li>
            <?php endif ?>
            <?php
                foreach ($menu_trans as $menu) {
                  $fa = '';
                        switch ($menu->menu_name) {
                            case 'Staff':
                                $fa = 'fa fa-users';
                                break;
                            case 'Setting':
                                $fa = 'fa-check';
                                break;
                            case 'Lapor':
                                $fa = 'fa-cog';
                                break;
                            
                            case 'Dashboard':
                                $fa = 'fa-dashboard';
                                break;    
                            case 'Notification':
                                $fa = 'fa-bell';
                                break;    
                            case 'Budget Request':
                                $fa = 'fa-envelope-open';
                                break;  
                            case 'Budget Approval':
                                $fa = 'fa-bookmark-o';
                                break; 
                            case 'My Profile':
                                $fa = 'fa-id-card';
                                break;                        
                            default:
                                $fa = 'fa-th';
                                break;
                        }
                    ?>
                    <li class="treeview <?php echo ($current_menu == $menu->menu_link)?"active":""; ?>">
                      <a href="<?php echo base_url() . $menu->menu_link ?>">
                        <i class="fa <?php echo $fa; ?>"></i> <span><?php echo $menu->menu_name ?></span> <?php echo (!empty($menu->submenu))?'<i class="fa fa-angle-left pull-right"></i>':''; ?>
                      </a>
                    <?php
                    if(!empty($menu->submenu)){
                      ?>
                      <ul class="treeview-menu">
                        <?php
                        foreach ($menu->submenu as $submenu) {
                            if($submenu->menu_name == 'Laporan Bulanan' || $submenu->menu_name == 'Laporan Tahunan' ){ ?>

                            <li class="<?php echo ($submenu->menu_link == $current_menu)?"active":"";?>">
                                <a href="javascript:void(0)" onclick="<?php echo $submenu->menu_link.'()' ?> "  > <i class="fa fa-circle-o"></i><?php echo $submenu->menu_name ?></a>
                            </li>

                           <?php 
                              }else{ ?>

                              <li class="<?php echo ($submenu->menu_link == $current_menu)?"active":"";?>">
                                <a href="<?php echo base_url() . $submenu->menu_link ?>"><i class="fa fa-circle-o"></i><?php echo $submenu->menu_name ?></a>
                            </li>

                           <?php 
                            }
                            ?>
                            
                            <?php
                        }
                        ?>
                      </ul>
                      <?php
                    }
                    ?>
                    </li>
                    <?php
                }
            ?>
            <?php if (!empty($menu_master)): ?>
              <li class="header">SETTINGS</li>  
            <?php endif ?>
            
            <?php
                foreach ($menu_master as $menu) {
                  $fa = '';
                        switch ($menu->menu_name) {
                            case 'Clinic':
                                $fa = 'fa-hospital-o';
                                break;
                            case 'Bank':
                                $fa = 'fa-university';
                                break;
                            case 'Product':
                                $fa = 'fa-shopping-bag';
                                break;
                            case 'Finance':
                                $fa = 'fa-usd';
                                break;
                            case 'Member':
                                $fa = 'fa-user';
                                break;
                            case 'Distributor':
                                $fa = 'fa-users';
                                break;
                            case 'Employee':
                                $fa = 'fa-male';
                                break;
                            case 'Position':
                                $fa = 'fa-suitcase';
                                break;
                            case 'Doctor':
                                $fa = 'fa-user-md';
                                break;
                            case 'Setting':
                                $fa = 'fa-gear';
                                break;
                            default:
                                $fa = 'fa-th';
                                break;
                        }
                    ?>
                    <li class="treeview <?php echo ($current_menu == $menu->menu_link)?"active":""; ?>">
                      <a href="<?php echo base_url() . $menu->menu_link ?>">
                        <i class="fa <?php echo $fa; ?>"></i> <span><?php echo $menu->menu_name ?></span> <?php echo (!empty($menu->submenu))?'<i class="fa fa-angle-left pull-right"></i>':''; ?>
                      </a>
                    <?php
                    if(!empty($menu->submenu)){
                      ?>
                      <ul class="treeview-menu">
                        <?php
                        foreach ($menu->submenu as $submenu) {
                            ?>
                            <li class="<?php echo ($submenu->menu_link == $current_menu)?"active":"";?>">
                                <a href="<?php echo base_url() . $submenu->menu_link ?>"><i class="fa fa-circle-o"></i><?php echo $submenu->menu_name ?></a>
                            </li>
                            <?php
                        }
                        ?>
                      </ul>
                      <?php
                    }
                    ?>
                    </li>
                    <?php
                }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <?php echo $_content; ?>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          All rights reserved
        </div>
        &copy; Budgeting.
      </footer>
    </div><!-- ./wrapper -->

    
        


    
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/dist/js/template.js"></script> -->
    <?php
    if($page_title == "Dashboard"){
        ?>
        <!-- Sparkline -->
        <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard2.js"></script>
        <?php
    }
    ?>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Data?</h4>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger danger">Iya</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Data?</h4>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger danger2">Iya</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalLapBulanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Laporan Bulanan</h4>
                </div>
                <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                         <div class="form-group">
                          <label class="control-label col-md-3">Nama Faskes</label>
                           <div class="col-md-9">
                            <select class="form-control" name="id_faskes_lap" id="id_faskes_lap" data-placeholder="Pilih..."
                            style="width:420px ; " >
                                  <?php foreach ($data_faskes as $row) {
                                        echo "<option value='$row->id_faskes' selected>$row->nama_faskes</option>";?>
                                  <?php }
                                        ?>
                              </select>
                           </div>
                                
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Aktifitas</label>
                           <div class="col-md-9">
                             <select class="form-control " name="kd_aktifitas_lap" id="kd_aktifitas_lap" data-placeholder="Pilih..." style="width:420px ; " >
                                  <?php foreach ($data_aktifitas as $rows) {
                                        echo "<option value='$rows->kd_aktifitas' selected>$rows->nama_aktifitas</option>";?>
                                  <?php }
                                        ?>
                              </select>
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3">Periode Awal</label>
                           <div class="col-md-9">
                            <input class="form-control" type="date" name="periode_awal_lap" id="periode_awal_lap" style="width:100%;" value="<?php echo date('Y-m-d'); ?>">
                           </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3">Periode Akhir</label>
                           <div class="col-md-9">
                              <input class="form-control" type="date" name="periode_akhir_lap" id="periode_akhir_lap" style="width:100%;" value="<?php echo date('Y-m-d'); ?>">
                           </div>
                      </div>
              
                    </div>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                  <button type="button" id="btnSave" onclick="getReportBulanan()" class="btn btn-primary">Cetak</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_distributor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <form role="form" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>distributor/add_ajax" id="add_distributor_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Add Distributor</h4>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                      <label class="control-label">Nama</label><div class=""><input class="form-control " name="distributor_name" placeholder="Nama Distributor"  maxlength=50></div>
                  </div>
                  <div class="form-group">
                      <label class="control-label">Alamat</label><div class=""><textarea class="form-control" name="distributor_address" ></textarea></div>
                  </div>
                  <div class="form-group">
                      <label class="control-label">Kontak</label><div class=""><input class="form-control " name="distributor_contact" placeholder="Kontak Distributor"  maxlength=12></div>
                  </div>
                  <div class="form-group">
                      <label class="control-label">Perusahaan</label><div class=""><input class="form-control " name="distributor_company" placeholder="Perusahaan Distributor"  maxlength=255></div>
                  </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    <script>

    


      jQuery(document).ready(function() {    
         // initiate layout and plugins
        $("#years_input").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change")

         $("#month_input").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "MM")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change")

         
        $('#deleteModal').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('onclick', 'location.href=\"' + $(e.relatedTarget).data('href') + '\"');
        });
        $('#deleteAll').on('show.bs.modal', function (e) {
            $(this).find('.danger2').attr('onclick', 'go_delete(\"' + $(e.relatedTarget).data('href') + '\")');
        });
         $(".timepicker").timepicker({
          showInputs: false
        });
         $(".datepicker").datepicker({
            format: "mm",
            viewMode: "months", 
            minViewMode: "months"
        });
          $(".datepicker_year").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });
         $(".datetimepicker").datetimepicker({
          format:'YYYY-MM-DD LT',
        });
        $(".select2me").select2({
        });
        $(".select-nosearch").select2({
            minimumResultsForSearch: -1
        });
        $('select:not(.select2me)').select2({
          minimumResultsForSearch: -1
        });

        $('#add_member_form').validate({
            rules: {
                "member_name": {
                    required: true
                },
                "member_gender": {
                    required: true
                },
                "member_address": {
                    required: true
                },
                "member_contact": {
                    required: true,
                    digits: true
                }
            },
            highlight: function (e) {
                $(e).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (e) {
                $(e).closest('.form-group').removeClass('has-error');
            },
            errorClass: "help-block",
            errorElement: "p",
            submitHandler: function (form) {
                var formd = form;
                $('.overlay').show();
                $.ajax({
                    url: $(form).attr('action'),
                    type: $(form).attr('method'),
                    data: $(form).serialize(),
                    dataType: 'json'
                }).done(function (result) {
                    if (result) {
                        $('#add_member').modal('hide');
                        toastr.options = {
                            "preventDuplicates": true,
                            "positionClass": "toast-bottom-right"
                        }
                        $('.overlay').hide();
                        toastr["success"]("Data has been inserted");
                    } else {
                        toastr.options = {
                            "preventDuplicates": true,
                            "positionClass": "toast-bottom-right"
                        }
                        toastr["error"]("Something wrong with the server. Please Try Again Later.");
                    }
                });
                formd.reset();
                return false;
            }
        });

        $('#add_distributor_form').validate({
            rules: {
                "distributor_name": {
                    required: true
                },
                "distributor_address": {
                    required: true
                },
                "distributor_contact": {
                    required: true,
                    digits: true
                },
                "distributor_company": {
                    required: true
                }
            },
            highlight: function (e) {
                $(e).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (e) {
                $(e).closest('.form-group').removeClass('has-error');
            },
            errorClass: "help-block",
            errorElement: "p",
            submitHandler: function (form) {
                var formd = form;
                $('.overlay').show();
                $.ajax({
                    url: $(form).attr('action'),
                    type: $(form).attr('method'),
                    data: $(form).serialize(),
                    dataType: 'json'
                }).done(function (result) {
                    if (result) {
                        $('#add_distributor').modal('hide');
                        toastr.options = {
                            "preventDuplicates": true,
                            "positionClass": "toast-bottom-right"
                        }
                        $('.overlay').hide();
                        toastr["success"]("Data has been inserted");
                    } else {
                        toastr.options = {
                            "preventDuplicates": true,
                            "positionClass": "toast-bottom-right"
                        }
                        toastr["error"]("Something wrong with the server. Please Try Again Later.");
                    }
                });
                formd.reset();
                return false;
            }
        });

      });

   $(document).ready(function(){
    // updating the view with notifications using ajax
//     function load_notification(view = ''){
//       $('.count').html('');
//      $.ajax({
//       url:"<?php echo site_url('Budgetrequest/get_notif')?>",
//       method:"POST",
//       data:{view:view},
//       dataType:"json",
//       success:function(data)
//       {
//        $('.dropdown-menu').html(data.notification);
//        $('.count').html(data.count);
//       }
//      });
//     }

//     load_notification();
    
//     // load new notifications
//     $(document).on('click', '.dropdown-toggle-notif', function(){
//      $('.count').html('');
//      load_notification('yes');
//     });
//     setInterval(function(){
//      load_notification();
//       $('.count').html('');
//     }, 5000);
// });
      function go_delete(p_url) {
            id_obj = [];
            $('.checkboxes:checked').each(function ()
            {
                ids = $(this).data();
                var id_array = {};
                $.each(ids,function(index, value){
                    if(index !== 'uniformed'){
                        id_array[index] = value;
                    }
                });
                id_obj.push(id_array);
            }).get();
            var post = {ids: id_obj, updated_by: '<?php echo $login_user->username ?>', updated_on:'<?php echo  date("Y-m-d H:i:s") ?> "'};
            $.ajax({
                url: p_url,
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(post),
                success: function (data) {
                    // console.log(data);
                    location.reload();
                }
            });
            $('#del_All').modal('hide');
        }
    function modalLapBulanan(){
       $('#modalLapBulanan').modal('show');
    }   

    function getReportBulanan(){
      var id_faskes = $('#id_faskes_lap').val();
      var kd_aktifitas = $('#kd_aktifitas_lap').val();
      var periode_awal =  $('#periode_awal_lap').val();
      var periode_akhir =  $('#periode_akhir_lap').val();
      var excel =  $('#excel').val();
      var url = "<?php echo site_url('lap_dinkes/lap_bulanan')?>/"+id_faskes+'/'+kd_aktifitas+'/'+periode_awal+'/'+periode_akhir;
      window.open(url);

    } 

   </script>

   
  </body>
</html>

