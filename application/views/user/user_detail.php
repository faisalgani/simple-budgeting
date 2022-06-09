<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Staff
        <small>Profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo $current_context; ?>">Staff</a></li>
        <li class="active">Profile</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Pengguna</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <div class="form-group">
                        <label>Hak Akses:</label>
                        <p><?php echo $user->role_name . (!empty($user->clinic_name)?" - " . $user->clinic_name:""); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <p><?php echo $user->username; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap:</label>
                        <p><?php echo $user->full_name; ?></p>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo $current_context; ?>" class="btn btn-default">Kembali</a>
                        <a href="<?php echo $current_context . 'edit/' . $user->id_user; ?>" class="btn btn-primary pull-right">Ubah</a>
                    </div><!-- /.box-footer -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->