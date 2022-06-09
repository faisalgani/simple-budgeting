<script src="<?php echo base_url().'assets/plugins/jquery_ui/js/jquery-ui.js'?>" type="text/javascript"></script>
<!-- CKEDITOR -->
<script type='text/javascript' src='<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js'></script>  
<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jquery_ui/css/jquery-ui.css'?>">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<style type="text/css">
  .ui-autocomplete{
    z-index: 100000;
    position:absolute;
    top:0;
    left:0;
    cursor:default
  }
</style>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h4>
        <?php echo $page_title; ?>
    </h4>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">  <?php echo $page_title; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <?php  
        $date_now = date("d/m/Y"); 
        ?>
         <div class="form-group row" id="div-cek-error" style="display: none;">
            <div class="col-md-12">
                <div class="alert alert-success">
                  <span class="message"></span>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
                </div>
            </div>
          </div>
           <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="box-tools pull-right">
                       
                    </div>
                </div><!-- /.box-body -->
                
                
                <div class="box-body table-responsive no-padding">
                     <table id="dataTableBudgetApprove" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <!--   <th><input type="checkbox" id="check-all"> Pilih Semua</th> -->
                                <th>No</th>
                                <th>Nomor Request</th>
                                <th>User</th>
                                <th>Nominal</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th style="width:125px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>   
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->


<div class="modal fade" id="modal_form_detailRequestApprove" role="dialog">
    <?php //var_dump($aktifitas); die();
   ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="formApprove" class="form-horizontal">
                    <div class="form-body">
                         <div class="form-group">
                                <label class="control-label col-md-3">Nomor Request</label>
                                  <div class="col-md-9">
                                    <input type="text" name="no_reqiest" class="form-control" id="no_reqiest" placeholder="Nomor Request" style="width:420px;" disabled="true"> 
                                    <input class="form-control" type="hidden" name="id" id="id" style="width:100%;" required>
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3">Nama Staff</label>
                                  <div class="col-md-9">
                                    <input type="text" name="nama_staff" class="form-control" id="nama_staff" placeholder="Nama Staff" style="width:420px;"
                                    disabled="true"> 
                                </div>
                        </div>
                         <div class="form-group">
                                <label class="control-label col-md-3">Tanggal Pengajuan</label>
                                  <div class="col-md-9">
                                   <input class="form-control" type="date" id="tgl_request" name="tgl_request" style="width:100%;" value=""
                                   disabled="true">
                                   <input class="form-control" type="hidden" name="id" id="id" style="width:100%;" required>
                                </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Nominal</label>
                           <div class="col-md-9">
                            <input type="text" name="nominal" class="form-control" id="nominal" placeholder="Nominal" style="width:420px;"
                            disabled="true">                       
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3">Deskripsi</label>
                           <div class="col-md-9">
                            <textarea class="form-control ckeditor" id="deskripsi" name="deskripsi"
                            disabled="true"></textarea>
                           </div>
                      </div>
                    </div>
                    <div class="form-group">
                                <label class="control-label col-md-3">Tanggal Approve/Reject</label>
                                  <div class="col-md-9">
                                   <input class="form-control" type="date" id="tgl_action" name="tgl_action" style="width:100%;" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                        </div>
                </form>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger"  id="btnReject" onclick="do_reject()">Reject</button>
                      <button type="button" id="btnApprove" onclick="do_approve()" class="btn btn-success">Approve</button>
                  </div>
            </div>
          
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
setInterval(function () {
  reload_table()
}, 5000);
var save_method; 
var table;
var base_url = '<?php echo base_url();?>';


 function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split    = number_string.split(','),
    sisa     = split[0].length % 3,
    rupiah     = split[0].substr(0, sisa),
    ribuan     = split[0].substr(sisa).match(/\d{3}/gi);        
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
 }


var ckeditor = CKEDITOR.replace('deskripsi',{
      height:'250px'
});
CKEDITOR.disableAutoInline = true;
// CKEDITOR.inline('editable');


$(document).ready(function() {
    table = $('#dataTableBudgetApprove').DataTable({ 
      rowCallback: function(row, data, index){
          if(data[6] == "Approved"){
              $(row).find('td:eq(6)').css('color', 'green');
          }
          if(data[6] == "Rejected"){
              $(row).find('td:eq(6)').css('color', 'red');
          }
        },
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo $current_context . 'get_list' ?>",
            "type": "POST",
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },

        ],
        "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
        

    });    
});

 function detailRequest(id){
    save_method = 'add';
    $('#formApprove')[0].reset();
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $('#modal_form_detailRequestApprove').modal('show');
    $('.modal-title').text('Detail Request Budget');
    $.ajax({
        url : "<?php echo site_url('Budgetapprove/getRequestById')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
             if(data[0].status == "Approved" || data[0].status == "Rejected"){
                $("#btnApprove" ).prop( "disabled", true );
                $("#btnReject" ).prop( "disabled", true );
                $("#tgl_action" ).prop( "disabled", true );
             }else{
                $("#btnApprove" ).prop( "disabled", false );
                $("#btnReject" ).prop( "disabled", false );
                $("#tgl_action" ).prop( "disabled", false );
             }
             $('#id').val(data[0].id);
             $('#tgl_request').val(data[0].tgl_request);
             $('#nominal').val(formatRupiah(data[0].nominal,'Rp. '));
             //$('#deskripsi').val(data[0].deskripsi);
             $('#nama_staff').val(data[0].full_name);
             $('#no_reqiest').val(data[0].no_request);
             CKEDITOR.instances.deskripsi.setData( '<p>'+data[0].deskripsi+'</p>' );
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
 }
 function reload_table(){
    table.ajax.reload(null,false); //reload dataTable ajax 
 }

 function do_approve(){

    $.ajax({
      url : "<?php echo site_url('Budgetapprove/do_approve')?>",
      type: "POST",
      data: {
        'id' : $('#id').val(),
        'tgl_action'     : $('#tgl_action').val()
      },
      dataType: "JSON",
      success: function(data){
          if(data.status === true) {
              $('#modal_form_detailRequestApprove').modal('hide');
              reload_table();
               $('#div-cek-error').show();
               $('#div-cek-error .message').html('Request Budget Berhasil Di Approve');
          }               
          $('#btnSave').text('Simpan'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
      },
      error: function (jqXHR, textStatus, errorThrown){
          alert('Error adding / update data');
          $('#btnSave').text('Simpan'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
      }
    });  
                
  }

   function do_reject(){

    $.ajax({
      url : "<?php echo site_url('Budgetapprove/do_reject')?>",
      type: "POST",
      data: {
        'id' : $('#id').val(),
        'tgl_action'     : $('#tgl_action').val()
      },
      dataType: "JSON",
      success: function(data){
          if(data.status === true) {
              $('#modal_form_detailRequestApprove').modal('hide');
              reload_table();
               $('#div-cek-error').show();
               $('#div-cek-error .message').html('Request Budget Berhasil Di Reject');
          }               
          $('#btnSave').text('Simpan'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
      },
      error: function (jqXHR, textStatus, errorThrown){
          alert('Error adding / update data');
          $('#btnSave').text('Simpan'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
      }
    });  
                
  }


</script>