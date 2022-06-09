<!-- Content Header (Page header) -->
<style>
#chartdiv {
  width: 50%;
  height: 200px;
  margin-left: 250px;
}

</style>
<script src="<?php echo base_url(); ?>assets/dashboard/plugin/amchart/core.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugin/amchart/charts.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugin/amchart/animated.js"></script>
<section class="content-header">
  <h1>
    Task List <?php echo $this->session->userdata('full_name'); ?>
  </h1>
  <ol class="breadcrumb">
    <li class="active">Task List <?php echo $this->session->userdata('full_name'); ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
<div class="box box-primary">
  <div class="box-header">
    <i class="ion ion-clipboard"></i>
    <h3 class="box-title"></h3>
    <div class="box-tools pull-right">
      
    </div>
  </div>
  <div class="box-body">
    <ul class="todo-list">
      <li>
        
        <input type="checkbox" value="">
        <span class="text">Design a template</span>
        
        <div class="tools">
          <i class="fa fa-edit"></i>
          <i class="fa fa-trash-o"></i>
        </div>
      </li>
      <li>
        
        <input type="checkbox" value="">
        <span class="text">Make the template responsive</span>
        
        <div class="tools">
          <i class="fa fa-edit"></i>
          <i class="fa fa-trash-o"></i>
        </div>
      </li>
    </ul>
  </div>
  <div class="box-footer clearfix no-border">
  <input type="text" class="form-control todo-list-input" placeholder="My Task Today?">  
                        <div class="list-wrapper">
    <button type="button" class="btn btn-default pull-right">
      <i class="fa fa-plus"></i> Add item </button>
  </div>
</div>

       
</section><!-- /.content -->
