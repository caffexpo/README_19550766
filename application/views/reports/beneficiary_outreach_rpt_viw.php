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
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker.css">

   <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

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
            <form action="<?php echo base_url();?>index.php/report/beneficiary_event_rpt" method="post">
            <div class="row">
              <div class="col-md-3">
                Date From
                <input type="date" name="fromd" class="form-control" required="required">
                
                
              </div>
              <div class="col-md-3">
                Date To
                <input type="date" name="tod" class="form-control" required="required">
                
                
              </div>
              <div class="col-md-2">&nbsp;<input type="submit" class="btn btn-success btn-sm" name="search" value="Find"></div>
            </div>
            </form>
            <br>
            <!-- general form elements -->
            <div class="card card-primary">
              <h3><?php echo $rpt_title;?></h3>
              <table class="table table-bordered table-striped" id="example1">
                <thead>
                <tr>
                  
                  <td>Project Name</td>
                  <td>Event</td>
                  <td>Event Date</td>
                  <td>Location</td>
                  <td>No of benificiaries</td>
                  
                  
                </tr>
                </thead>
                <tbody>
                <?php
                //print_r($benificiary_outreach);
                 if($benificiary_outreach){
                   foreach($benificiary_outreach as $projlist){
                 ?>
                 <tr>
                  <td><?php echo $projlist->project_name;?></td>
                  <td><?php echo $projlist->event_title;?></td>
                  <td><?php echo $projlist->event_date;?></td>
                  <td><?php echo $projlist->location;?></td>
                  <td><?php echo $projlist->benicount;?></td>
                  
                  
                  
                </tr>
                 <?php
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

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->

<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url()?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/dist/js/demo.js"></script>



<!-- Select2 -->
<script src="<?php echo base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>

<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>


<script src="<?php echo base_url()?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script type="text/javascript">
  
$(document).ready( function(){
    $("#example1").DataTable({
      "bPaginate": false,
      dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: '<?php echo $rpt_title;?>'
            },
            {
                extend: 'pdfHtml5',
                orientation: 'horizontal',
                title: '<?php echo $rpt_title;?>',
                pageSize: 'LEGAL',
                customize: function(doc) {
                  doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10 
                  doc.styles.tableHeader.fontSize = 10; 
               } 
            }
        ]
      
    });
});

</script>
</body>
</html>
