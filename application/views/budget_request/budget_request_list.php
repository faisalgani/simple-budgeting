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
        <?php echo $page_title.' - '.$this->session->userdata('full_name'); ?>
    </h4>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">  <?php echo $page_title.' - '.$this->session->userdata('full_name'); ?></li>
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
                       <button class="btn btn-success" onclick="add_item()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
                    </div>
                </div><!-- /.box-body -->
                
                
                <div class="box-body table-responsive no-padding">
                     <table id="dataTableRequest" class="table table-striped table-bordered" cellspacing="0" width="100%">
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


<div class="modal fade" id="modal_form_addRequestBudget" role="dialog">
    <?php //var_dump($aktifitas); die();
   ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="formRequest" class="form-horizontal">
                    <div class="form-body">
                         <div class="form-group">
                                <label class="control-label col-md-3">Tanggal Pengajuan</label>
                                  <div class="col-md-9">
                                   <input class="form-control" type="date" id="tgl_request" name="tgl_request" style="width:100%;" value="<?php echo date('Y-m-d'); ?>">
                                   <input class="form-control" type="hidden" name="id" id="id" style="width:100%;" required>
                                </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Nominal</label>
                           <div class="col-md-9">
                            <input type="text" name="nominal" class="form-control" id="nominal" placeholder="Nominal" style="width:420px;">                       
                           </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3">Deskripsi</label>
                           <div class="col-md-9">
                            <textarea class="form-control ckeditor" id="deskripsi" name="deskripsi"></textarea>
                           </div>
                      </div>
                    </div>
                </form>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" id="btn-cancel" data-dismiss="modal">Batal</button>
                      <button type="button" id="btnSaveRequest" onclick="save()" class="btn btn-primary">Simpan</button>
                  </div>
            </div>
          
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
var save_method; 
var table;
var base_url = '<?php echo base_url();?>';

var ckeditor = CKEDITOR.replace('deskripsi',{
      height:'250px'
});
CKEDITOR.disableAutoInline = true;
// CKEDITOR.inline('editable');

 var dengan_rupiah = document.getElementById('nominal');
    dengan_rupiah.addEventListener('keyup', function(e){
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
 });

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

 function detailRequestUser(id){
    save_method = 'edit';
    $('#formRequest')[0].reset();
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $('#modal_form_addRequestBudget').modal('show');
    $('.modal-title').text('Detail Request Budget');
    $.ajax({
        url : "<?php echo site_url('budgetrequest/getRequestById')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
          if(data[0].status == "Saved" ){
             $('#id').val(data[0].id);
             $('#tgl_request').val(data[0].tgl_request);
             $('#nominal').val(formatRupiah(data[0].nominal,'Rp. '));
             CKEDITOR.instances.deskripsi.setData( '<p>'+data[0].deskripsi+'</p>' );
          }else{
             $('#id').val(data[0].id);
             $('#tgl_request').val(data[0].tgl_request);
             $('#nominal').val(formatRupiah(data[0].nominal,'Rp. '));
             CKEDITOR.instances.deskripsi.setData( '<p>'+data[0].deskripsi+'</p>' );
             CKEDITOR.instances.deskripsi.setReadOnly();
             $("#btnSaveRequest" ).prop( "disabled", true );
             $("#tgl_request" ).prop( "disabled", true );
             $("#nominal" ).prop( "disabled", true );
             $("#deskripsi" ).prop( "disabled", true );
          }
             
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
 }


$(document).ready(function() {
    table = $('#dataTableRequest').DataTable({ 
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
        "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]

    });    
});

 function add_item(){
    save_method = 'add';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $('#modal_form_addRequestBudget').modal('show'); 
    $('.modal-title').text('Tambah Request Budget'); 
 }
 function reload_table(){
    table.ajax.reload(null,false); 
 }

 function save(){

    var text = $('#nominal').val();
    var result = text.replace("Rp. ", "");
    var nominal_clean = result.replace(".", "");
    var id = $('#id').val();
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
    if(save_method == 'add') {
        url = "<?php echo site_url('Budgetrequest/add')?>";
    } else {
        url = "<?php echo site_url('Budgetrequest/edit')?>/" + id ;
    }

    $.ajax({
      url : url,
      type: "POST",
      data: {
        'tgl_request' : $('#tgl_request').val(),
        'nominal'     : nominal_clean,
        'deskripsi'   : CKEDITOR.instances.deskripsi.getData(),
      },
      dataType: "JSON",
      success: function(data){
          if(data.status === true) {
              $('#modal_form_addRequestBudget').modal('hide');
              reload_table();
               $('#div-cek-error').show();
               $('#div-cek-error .message').html('Data Berhasil Disimpan');
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

  function edit_laporan(id){
    save_method = 'update';
    $('#form')[0].reset(); 
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty(); 
    $.ajax({
        url : "<?php echo site_url('laporan_faskes/getById')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            console.log(data[0]);
             $('#id_laporan').val(data[0].id_laporan);
             $('#tgl_laporan').val(data[0].tgl_laporan);
             $('#kd_aktfitas').val(data[0].nama_aktifitas);
             $('#kd_aktfitas_detail').val(data[0].nama_aktifitas_detail);
             $('#jumlah').val(data[0].jumlah);
             $('#tgl_laporan').prop('disabled', true);
             $('#kd_aktfitas').prop('disabled', true);
             $('#kd_aktfitas_detail').prop('disabled', true);
             $('#modal_form_addRequestBudget').modal('show'); // show bootstrap modal when complete loaded
             $('.modal-title').text('Edit'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


</script>