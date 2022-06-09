<!-- Content Header (Page header) -->
<style>
#chartLine {
  width: 500px;
  height: 300px;
}
#chartLimit {
  width: 100%;
  height: 300px;
  margin-left: 140px;
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
          <h3 class="box-title">Grafik Request Staff</h3>
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
               <div id="chartLine"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Realisasi Budget <small>Jumlah Limit Rp. <?php echo number_format($limit_budget); ?></small> </h3>

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
                <div id="chartLimit"></div>
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
                      <th>Nomor Request</th>
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
                              <td><?php echo $value->no_request; ?></td>
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
    if ($('#chartLine').length) {
      $.ajax({
        type:"POST",
        url : "<?php echo site_url('dashboard/get_chart_line')?>",
        data: "",
        success:function(data){
          var data_line =JSON.parse(data);
          am4core.ready(function() {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartLine", am4charts.XYChart);
            chart.scrollbarX = new am4core.Scrollbar();
            chart.data = data_line;
            prepareParetoData();

            function prepareParetoData(){
                var total = 0;

                for(var i = 0; i < chart.data.length; i++){
                    var value = chart.data[i].nominal;
                    total += value;
                }

                var sum = 0;
                for(var i = 0; i < chart.data.length; i++){
                    var value = chart.data[i].nominal;
                    sum += value;   
                    chart.data[i].pareto = sum / total * 100;
                }    
            }

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "tgl_request";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 60;
            categoryAxis.tooltip.disabled = true;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minWidth = 50;
            valueAxis.min = 0;
            valueAxis.cursorTooltipEnabled = false;

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.sequencedInterpolation = true;
            series.dataFields.valueY = "nominal";
            series.dataFields.categoryX = "tgl_request";
            series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
            series.columns.template.strokeWidth = 0;

            series.tooltip.pointerOrientation = "vertical";

            series.columns.template.column.cornerRadiusTopLeft = 10;
            series.columns.template.column.cornerRadiusTopRight = 10;
            series.columns.template.column.fillOpacity = 0.8;

            var paretoValueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            paretoValueAxis.renderer.opposite = true;
            paretoValueAxis.min = 0;
            paretoValueAxis.max = 100;
            paretoValueAxis.strictMinMax = true;
            paretoValueAxis.renderer.grid.template.disabled = true;
            paretoValueAxis.numberFormatter = new am4core.NumberFormatter();
            paretoValueAxis.numberFormatter.numberFormat = "#'%'"
            paretoValueAxis.cursorTooltipEnabled = false;

            var paretoSeries = chart.series.push(new am4charts.LineSeries())
            paretoSeries.dataFields.valueY = "pareto";
            paretoSeries.dataFields.categoryX = "country";
            paretoSeries.yAxis = paretoValueAxis;
            paretoSeries.tooltipText = "pareto: {valueY.formatNumber('#.0')}%[/]";
            paretoSeries.bullets.push(new am4charts.CircleBullet());
            paretoSeries.strokeWidth = 2;
            paretoSeries.stroke = new am4core.InterfaceColorSet().getFor("alternativeBackground");
            paretoSeries.strokeOpacity = 0.5;

            // on hover, make corner radiuses bigger
            var hoverState = series.columns.template.column.states.create("hover");
            hoverState.properties.cornerRadiusTopLeft = 0;
            hoverState.properties.cornerRadiusTopRight = 0;
            hoverState.properties.fillOpacity = 1;

            series.columns.template.adapter.add("fill", function(fill, target) {
              return chart.colors.getIndex(target.dataItem.index);
            })

            // Cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panX";

          }); // end am4core.ready()
        },
        error: function(errorThrown){
                
        }               
      }); 
  }


  if ($('#chartLine').length) {
      var limit_budget  = "<?php echo $limit_budget; ?>";
      var jumlah_budget = "<?php echo $jumlah_budget; ?>";
      var digits = jumlah_budget.length;
      if(digits > 7 ){
        var pembagi = limit_budget;
        var hasil1 = limit_budget - jumlah_budget;
        console.log(hasil1);
        var hasil2 =  hasil1 / pembagi;
      }else{
        var pembagi = limit_budget+00;
        var hasil1 = limit_budget - jumlah_budget;
        console.log(hasil1);
        var hasil2 =  hasil1 / pembagi;
      }
     
     am4core.ready(function() {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartLimit", am4charts.GaugeChart);
        chart.innerRadius = -15;

        var axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.min = 0;
        axis.max = 100;
        axis.strictMinMax = true;

        var colorSet = new am4core.ColorSet();

        var gradient = new am4core.LinearGradient();
        gradient.stops.push({color:am4core.color("green")})
        gradient.stops.push({color:am4core.color("yellow")})
        gradient.stops.push({color:am4core.color("red")})

        axis.renderer.line.stroke = gradient;
        axis.renderer.line.strokeWidth = 15;
        axis.renderer.line.strokeOpacity = 1;

        axis.renderer.grid.template.disabled = true;

        var hand = chart.hands.push(new am4charts.ClockHand());
        hand.radius = am4core.percent(100);

        setInterval(function() {
          console.log(hasil2);
            hand.showValue(hasil2 * 100, 1000, am4core.ease.cubicOut);
        }, 2000);


      }); // end am4core.ready()
  }
}, 10000);  
</script>
