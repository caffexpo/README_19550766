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
              <form role="form" id="eventform" action="<?php echo base_url();?>index.php/complains/save_complain" method="post">
                <div class="card-body">


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Complain Category *</label>
                        
                        <select class="form-control" name="compcatid" id="compcatid" required="required">
                          <option value="">Complain Category</option>
                          <?php
                            if($complaincats){
                             foreach($complaincats as $cc){
                             ?>
                          
                          <option value="<?php echo $cc->compln_cat_id;?>"><?php echo $cc->complain_category;?></option>
                         
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
                        <label for="exampleInputEmail1">GN Division *</label>
                        <select class="form-control" id="gndiv" name="gndiv" required="required">
                          <option value="">Select GN Division</option>
                          <?php
                          if($gn_div){
                            foreach($gn_div as $gnd){
                          ?>
                          <option value="<?php echo $gnd->gn_division;?>" data-gndval="<?php echo $gnd->gn_div_id;?>"><?php echo $gnd->gn_division;?></option>
                          <?php
                           }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    
                    
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Beneficiary *</label>
                       
                        <select class="form-control" name="beni" id="beni" required="required">
                          <option value="">Select Beneficiary</option>
                          <?php
                             if($benificiary_list){
                               foreach($benificiary_list as $ben){
                             ?>
                          
                          <option value="<?php echo $ben->title.' '.$ben->child_name;?>"><?php echo $ben->title.' '.$ben->child_name;?></option>
                         
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
                        <label for="exampleInputPassword1">Complain *</label>
                        <textarea class="form-control" name="complains" rows="6" cols="5" required="required"></textarea>
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
    
    var baselink = "<?php echo base_url()?>";

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


    $('#gndiv').change(function(){
      $('#beni').html("");
      var gndiv = $(this).find(':selected').attr('data-gndval');
      $('#beni').html('<option value="">Select Beneficiary</option>');
      $.ajax({
                                type: 'POST',
                                url:baselink+'index.php/complains/get_gndiv_related_beneficiries',
                                dataType: 'json',
                                data:{'gndiv':gndiv},
                                success: function(response){
                                  console.log(response)
                                  $.each( response, function( index, value ) {
                                    $('#beni').append('<option value="'+value.child_name+'">'+value.child_name+'</option>');
                                  });               
                                },
                                error: function(e){
                                    console.log(e);
                                    //destroymodel();
                                }
              });
    });

  });
</script>
</body>
</html>
