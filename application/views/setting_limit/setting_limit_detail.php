<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Setting Limit
    <small>Detail</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo $current_context; ?>">Setting Limit</a></li>
    <li class="active">Detail</li>
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
          <h3 class="box-title">Setting Limit</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            
			<div class="form-group">
					<label>Limit:</label>
					<p>Rp. <?php echo number_format($setting_limit->jml_limit); ?></p>
			</div>
		
            <div class="box-footer">
               <a href="<?php echo $current_context; ?>" class="btn btn-default">Kembali</a>
               <a href="<?php echo $current_context .'edit/'.$setting_limit->id ; ?>" class="btn btn-primary pull-right">Ubah</a>
            </div><!-- /.box-footer -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col (right) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->