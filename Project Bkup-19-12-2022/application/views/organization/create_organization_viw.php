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
              <form role="form" action="<?php echo base_url();?>index.php/organization/add_organization" method="post" id="org_form">
                <div class="card-body">
                 
                 <?php echo form_open('form'); ?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Organization Name *</label>
                        <?php echo form_error('orgname'); ?>
                        <input type="text" class="form-control" id="orgname" name="orgname" placeholder="Enter Organization Name" required="required" value="<?php echo set_value('orgname'); ?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Code * (type 3 charater)</label>
                        <?php echo form_error('shortcode'); ?>
                        <input type="text" class="form-control" id="shortcode" name="shortcode" placeholder=" ex : NBS" required="required" maxlength="3" value="<?php echo set_value('shortcode'); ?>">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Registration No</label>
                        <?php echo form_error('regno'); ?>
                        <input type="text" class="form-control" id="regno" name="regno" placeholder="Registration No" value="<?php echo set_value('regno'); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Organization Address</label>
                        <?php echo form_error('orgaddress'); ?>
                        <input type="text" class="form-control" id="orgaddress" name="orgaddress" placeholder="Enter Organization Address" value="<?php echo set_value('orgaddress'); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Organization Contact *</label>
                        <?php echo form_error('orgcontact'); ?>
                        <input type="number" class="form-control" id="orgcontact" name="orgcontact" placeholder="Organization Contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" minlength="10" required="required" value="<?php echo set_value('orgcontact'); ?>">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Organization Type *</label>
                        <?php echo form_error('orgtype'); ?>
                        <select class="form-control" name="orgtype" id="orgtype" required="required">
                          <option value="">Select Organization Type</option>
                          <option value="1" <?php echo set_select('orgtype', '1'); ?>>Main</option>
                          <option value="2" <?php echo set_select('orgtype', '2'); ?>>Sub</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">ORG Email *</label>
                        <?php echo form_error('orgemail'); ?>
                        <input type="email" class="form-control" id="orgemail" name="orgemail" placeholder="Organization E-mail" required="required" value="<?php echo set_value('orgemail'); ?>">
                      </div>
                    </div>
                    
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">District *</label>
                       <?php echo form_error('base_station'); ?>
                        <select class="form-control" name="base_station" id="base_station" required="required">
                          <option value="">Select District</option>
                          <?php
                          if($basestation){
                          foreach($basestation as $bst){
                          ?>
                          <option value="<?php echo $bst->destrict_id;?>" <?php echo set_select('base_station', $bst->destrict_id); ?>><?php echo $bst->district;?></option>
                          <?php
                            }
                          }
                          ?>
                        </select>
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
  
$(document).ready(function() {
  var baselink = "<?php echo base_url()?>";
  

  
});

</script>
</body>
</html>
