<!-- Content Header (Page header) -->
<style>
#chartsummary {
  width: 500px;
  height: 300px;
  margin-left: 20px;
}

#chartsummary_approve {
  width: 500px;
  height: 300px;
  margin-left: 20px;
}

</style>
<script src="<?php echo base_url(); ?>assets/dashboard/plugin/amchart/core.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugin/amchart/charts.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugin/amchart/animated.js"></script>
<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Jumlah Request Budget</span>
          <span class="info-box-text"><?php echo $jml_req; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-check-square-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Jumlah Budget Approve</span>
          <span class="info-box-text"><?php  echo $req_acc; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-pause-circle-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Jumlah Budget Pending</span>
          <span class="info-box-text"><?php echo $req_pend; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-times-circle-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Jumlah Budget Reject</span>
          <span class="info-box-text"><?php  echo $req_reject; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->

  </div><!-- /.row -->
   
<div class="row">
  <div class="col-md-6">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Persentase Request Staff</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove">
            <i class="fa fa-times"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="chart-responsive">
              <div id="chartsummary"></div>
            </div>
          </div>
          
        </div>
      </div>
  
    </div>
  </div>
    <div class="col-md-6">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Persentase Approve Budget</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="chart-responsive">
                <div id="chartsummary_approve"></div>
              </div>
            </div>
            
          </div>
        </div>
    
      </div>
  </div>

   <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">List Request Budget</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive p-0" style="height: 220px;">
                <table class="table table-head-fixed text-nowrap" id="table-list-request">
                  <thead>
                    <tr>
                      <th>Staff</th>
                      <th>Tanggal Request</th>
                      <th>Nominal</th>
                      <th>Status</th>

                    </tr>
                  </thead>
                  <tbody>
                  
                    <?php foreach ($request_all as $value) { 
                            if($value->status == "Pending"){
                                $status ='<span class="label label-warning">Pending</span>';
                            }elseif ($value->status == "Approved") {
                                $status ='<span class="label label-success">Approved</span>';
                            }else{
                                $status ='<span class="label label-danger">Rejected</span>';
                            }
                      ?>  
                            <tr> 
                              <td><?php echo $value->full_name; ?></td>
                              <td><?php echo date("d-M-Y", strtotime($value->tgl_request)); ?></td>
                              <td><?php echo 'Rp. '.number_format($value->nominal); ?></td>
                              <td><?php echo $status; ?></td>
                            </tr>  
                  <?php   }

                    ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>
        </div>
    
      </div>
  </div>

</div>

       
</section><!-- /.content -->

<script type="text/javascript">

setInterval(function () {
  if ($('#chartsummary').length) {
      $.ajax({
        type:"POST",
        url : "<?php echo site_url('dashboard/get_chart_summary')?>",
        data: "",
        success:function(data){
          var data_summary =JSON.parse(data);
          am4core.ready(function() {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartsummary", am4charts.PieChart);
            chart.data =data_summary;
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "nominal";
            pieSeries.dataFields.category = "full_name";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeOpacity = 1;


            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;

            chart.hiddenState.properties.radius = am4core.percent(0);
          }); // end am4core.ready()
        },
        error: function(errorThrown){
                
        }               
      }); 
  }

  if ($('#chartsummary_approve').length) {
      $.ajax({
        type:"POST",
        url : "<?php echo site_url('dashboard/get_chart_summary_approve')?>",
        data: "",
        success:function(data){
          var data_summary_approve =JSON.parse(data);
          am4core.ready(function() {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartsummary_approve", am4charts.PieChart);
            chart.data = data_summary_approve;
            chart.innerRadius = am4core.percent(50);

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "nominal";
            pieSeries.dataFields.category = "full_name";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;

            // This creates initial animation
            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;

          }); // end am4core.ready()

        },
        error: function(errorThrown){
                
        }               
      }); 
  }
}, 10000);


</script>

