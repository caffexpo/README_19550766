<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo webheding;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php $this->load->view('common/navbar_viw');?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('common/aside_viw');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $titlename;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $titlename;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <?php 
           if($this->session->flashdata('errormsg')){
          ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error</strong><?php echo $this->session->flashdata('errormsg');?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php
           }
          ?>

          <?php 
           if($this->session->flashdata('successmsg')){
          ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> <?php echo $this->session->flashdata('successmsg');?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php
           }
        ?>

        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="eventform" action="<?php echo base_url();?>index.php/event/add_event" method="post">
                <div class="card-body">


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Project</label>
                        <input type="hidden" name="curbalance" id="curbalance">
                        <select class="form-control" name="projid" id="projid" required="required">
                          <option value="">Select Project</option>
                          <?php
                           if($projlist){
                             foreach($projlist as $prjs){
                          ?>
                          
                          <option value="<?php echo $prjs->proj_id;?>" data-curbudget="<?php echo $prjs->balance_budget;?>"><?php echo $prjs->project_name;?></option>
                         
                          <?php
                             }
                           }
                          ?>
                        </select>
                        <p id="bdgt"></p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Event Name</label>
                        <input type="text" class="form-control" id="eventname" name="eventname" placeholder="Enter Event Name" required="required">
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Location</label>
                        
                        <select id="elocation" name="elocation" required="required" class="form-control">
                          <option value="">Select Location</option>
                          <?php
                          foreach($locations as $loc){
                            ?>
                            <option value="<?php echo $loc->location;?>"><?php echo $loc->location;?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Year</label>
                        <select name="yr" id="yr" class="form-control select2" required="required">
                  <option value=""></option>
                  <?php
                   for($yr=2019;$yr<2060;$yr++){
                  ?>
                  <option value="<?php echo $yr;?>"><?php echo $yr;?></option>
                  <?php
                   }
                  ?>
                </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Month</label>
                        
                <select name="mnt" id="mnt" class="form-control select2" required="required">
                  <option value=""></option>
                  <?php
                   for($mnt=1;$mnt<=12;$mnt++){
                  ?>
                  <option value="<?php echo $mnt;?>"><?php echo $mnt;?></option>
                  <?php
                   }
                  ?>
                </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Budget</label>
                        <input type="text" class="form-control" id="evbudget" name="evbudget" placeholder="Budget" required="required">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputPassword1">No of Beneficiaries</label>
                        <input type="text" class="form-control" id="no_benifciaries" name="no_benifciaries" placeholder="No of Beneficiaries" required="required">
                      </div>
                    </div>


                  </div>

                  <div class="row">
                    

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Start On</label>
                        <input type="date" class="form-control" id="evestart" name="evestart" placeholder="" required="required">
                      </div>
                    </div>
                    
                  </div>
                  
                  
                 
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

   
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('common/footer_viw')?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url();?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url();?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>

<script type="text/javascript">
  $(function(){

    $('#projid').change(function(){
      var curbudget = $(this).find(':selected').attr('data-curbudget');
      $('#curbalance').val("");
      $('#curbalance').val(curbudget);
      $('#bdgt').html("");
      $('#bdgt').html("Budget Balance "+curbudget);
    });

    $("#eventform").on('submit', function(e){
      
      var balancebudget = $('#curbalance').val();
      var event_amt = $('#evbudget').val();
      if(parseInt(balancebudget)<parseInt(event_amt)){
        e.preventDefault();
        alert("Event Budget ("+balancebudget+") cant exceed project budget balance.")
      }else{
        $("#eventform").submit();
      }
    });

  });
</script>
</body>
</html>
