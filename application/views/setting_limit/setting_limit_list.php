<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
   Setting Limit
    <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Setting Limit</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <?php
        $message = $this->session->flashdata('message');
        $type_message = $this->session->flashdata('type_message');
        echo (!empty($message) && $type_message=="success") ? ' <div class="col-md-12" id="data-alert-box"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button><strong>Berhasil! </strong>'.$message.'</div></div>': '';
        echo (!empty($message) && $type_message=="error") ? '   <div class="col-md-12" id="data-alert-box"><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button><strong>Error! </strong>'.$message.'</div></div>': '';
    ?>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
         
        </div><!-- /.box-header -->
        
        <hr>
        <div class="box-header">
          <h3 class="box-title">Data Tabel (<?php echo $total_rows; ?> Data)</h3>
          <div class="box-tools pull-right">
          <?php if($total_rows == 0){ ?>
             <a href="<?php echo $current_context . 'add/'; ?>" class="btn btn-sm bg-light-blue">
                  <i class="fa fa-plus"></i>&nbsp; Tambah
              </a>
          <?php } ?>
           
          </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover" id="table_data">
            <tr>
        
              <th>No</th>
  						<th>Jumlah Limit</th>
              <th>Aksi</th>
            </tr>
            <?php
            $i =1;
            foreach ($setting_limit as $row) {
                ?>
                <tr>
                    
                    <td><?php echo $i + $offset; ?></td>
							      <td><?php echo number_format($row->jml_limit); ?></td>
      							<td class="td-btn">
      								<a href="<?php echo $current_context . 'detail'  .'/'. $row->id ?>" class="badge bg-yellow"><i class="fa fa-eye fa-fw"></i>lihat</a>
      								<a href="<?php echo $current_context . 'edit'  .'/'. $row->id ?>" class="badge bg-green"><i class="fa fa-edit fa-fw"></i>ubah</a>
      							</td>
                </tr>
            <?php $i++;
            } ?>
          </table>
        <div class="box-footer clearfix">
          <?php echo $pagination; ?>
        </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
</section><!-- /.content -->