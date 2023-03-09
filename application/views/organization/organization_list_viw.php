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
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
              
              <table class="table table-striped projects" id="example1">
                <thead>
                <tr>
                  <td>Organization Name</td>
                  <td>Short code</td>
                  <td>Reg: No</td>
                  <td>Address</td>
                  <td>Contact No</td>
                  <td>District</td>
                  <td>E-mail</td>
                  <td>Type</td>
                  <td>Status</td>
                  <td></td>
                </tr>
                </thead>
                <tbody>
                 <tr>
                  <td colspan="9"><strong>Active Organization List</strong></td>
                </tr>
                <?php
                 if($orglist){
                   foreach($orglist as $olst){
                    if($olst->org_stts==1){
                 ?>
                 <tr>
                  <td><?php echo $olst->org_name;?></td>
                  <td><?php echo $olst->short_code;?></td>
                  <td><?php echo $olst->reg_no;?></td>
                  <td><?php echo $olst->org_address;?></td>
                  <td><?php echo $olst->org_contact;?></td>
                  <td><?php echo $olst->district;?></td>
                  <td><?php echo $olst->org_mail;?></td>
                  <td><?php
                     if($olst->org_type==1){
                     echo "Main";
                     }else{
                        echo "Sub";
                     }
                    ?></td>
                  <td><?php
                     if($olst->org_stts==1){
                     echo "Active";
                     }else{
                        echo "Inactive";
                     }
                    ?></td>
                    <td>
                     <?php
                     if($olst->org_type==2){
                     ?>
                      <a class="btn btn-success btn-sm" href="<?php echo base_url()?>index.php/organization/edit_organization/<?php echo $olst->org_id;?>">Edit</a> &nbsp;&nbsp;
                      <?php
                      if($olst->org_stts==1){
                      ?>
                      <a class="btn btn-info btn-sm"  href="<?php echo base_url()?>index.php/organization/act_inact_organization/<?php echo $olst->org_id;?>/2">INACTIVE</a></td>
                      <?php
                      }else{
                      ?>
                      <a class="btn btn-danger btn-sm"  href="<?php echo base_url()?>index.php/organization/act_inact_organization/<?php echo $olst->org_id;?>/1">ACTIVE</a></td>
                      <?php
                      }
                    }else{
                     ?>
                     <a class="btn btn-success btn-sm" href="<?php echo base_url()?>index.php/organization/edit_organization/<?php echo $olst->org_id;?>">Edit</a> &nbsp;&nbsp;
                     <?php
                    }
                      ?>
                    
                      
                </tr>
                 <?php
                     }
                   }
                 }
                ?>

                <tr>
                  <td colspan="9"></td>
                </tr>
                <tr>
                  <td colspan="9"><strong>Inactive Organization List</strong></td>
                </tr>

                <?php
                 if($orglist){
                   foreach($orglist as $olst2){
                    if($olst2->org_stts==2){
                 ?>
                 <tr>
                  <td><?php echo $olst2->org_name;?></td>
                  <td><?php echo $olst2->short_code;?></td>
                  <td><?php echo $olst2->reg_no;?></td>
                  <td><?php echo $olst2->org_address;?></td>
                  <td><?php echo $olst2->org_contact;?></td>
                  <td><?php echo $olst2->org_mail;?></td>
                  <td><?php
                     if($olst2->org_type==1){
                     echo "Main";
                     }else{
                        echo "Sub";
                     }
                    ?></td>
                  <td><?php
                     if($olst2->org_stts==1){
                     echo "Active";
                     }else{
                        echo "Inactive";
                     }
                    ?></td>
                    <td>
                     <?php
                     if($olst2->org_type==2){
                     ?>
                      <a class="btn btn-success btn-sm" href="<?php echo base_url()?>index.php/organization/edit_organization/<?php echo $olst2->org_id;?>">Edit</a> &nbsp;&nbsp;
                      <?php
                      if($olst2->org_stts==1){
                      ?>
                      <a class="btn btn-info btn-sm"  href="<?php echo base_url()?>index.php/organization/act_inact_organization/<?php echo $olst2->org_id;?>/2">INACTIVE</a></td>
                      <?php
                      }else{
                      ?>
                      <a class="btn btn-danger btn-sm"  href="<?php echo base_url()?>index.php/organization/act_inact_organization/<?php echo $olst2->org_id;?>/1">ACTIVE</a></td>
                      <?php
                      }
                    }
                      ?>
                      
                </tr>
                 <?php
                    }
                   }
                 }
                ?>
              </tbody>
              </table>
              
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

<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
  $(document).ready( function() {
     
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      

    });


    });
</script>
</body>
</html>
