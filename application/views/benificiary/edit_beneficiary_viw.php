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
              <form role="form" action="<?php echo base_url();?>index.php/beneficiari/edit_beneficiari" method="post" id="form_add_benificiaryss">
                <div class="card-body">

                  <div class="row">
                    <input type="hidden" name="regid" id="regid" value="<?php echo $regid;?>">
                    <input type="hidden" name="page" id="page" value="<?php echo $pageid;?>">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <select class="form-control" id="ttl" name="ttl" required="required">
                          <option value="">Select Title</option>
                          <?php
                          if($title){
                            foreach($title as $ttl){
                            if($ttl->title_id==$beneficiary_data->title_id){
                           ?>
                           <option selected="selected" value="<?php echo $ttl->title_id;?>"><?php echo $ttl->title;?></option>
                           <?php
                          }else{
                          ?>
                          <option value="<?php echo $ttl->title_id;?>"><?php echo $ttl->title;?></option>
                           <?php
                          }
                          ?>
                          
                          <?php
                           }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Beneficiary Name *</label>
                        <input type="text" class="form-control" id="bname" name="bname" placeholder=""  required="required" value="<?php echo $beneficiary_data->child_name?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">GN Division *</label>
                        <select class="form-control" id="gndiv" name="gndiv" required="required">
                          <option value="">Select GN Division</option>
                          <?php
                          if($gn_div){
                            foreach($gn_div as $gnd){
                         
                            if($gnd->gn_div_id==$beneficiary_data->gn_division){
                           ?>
                           <option selected="selected" value="<?php echo $gnd->gn_div_id;?>"><?php echo $gnd->gn_division;?></option>
                           <?php
                          }else{
                          ?>
                          <option value="<?php echo $gnd->gn_div_id;?>"><?php echo $gnd->gn_division;?></option>
                           <?php
                          }
                          ?>
                          
                          <?php



                           }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" id="baddress" name="baddress" placeholder=""  required="required" value="<?php echo $beneficiary_data->c_address?>">
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Date of Birth *</label>
                        <input type="date" class="form-control" id="bdob" name="bdob" placeholder="" required="required" value="<?php echo $beneficiary_data->dob?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Contact No *</label>
                        <input type="number" class="form-control" id="dcontact" name="dcontact" placeholder="" required="required" value="<?php echo $beneficiary_data->c_contact?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">NIC *</label>
                        <input type="text" class="form-control" id="bnic" name="bnic" placeholder="" maxlength="12" value="<?php echo $beneficiary_data->bnic?>" required="required">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">E-mail *</label>
                        <input type="email" class="form-control" id="bmail" name="bmail" placeholder="" required="required" value="<?php echo $beneficiary_data->email_address?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Organization</label>
                        <select class="form-control" name="orgid" id="orgid" required="required">
                          <option value="">Select Organization</option>
                          <?php
                           if($orglist){
                             foreach($orglist as $olst){
                             if($olst->org_id==$beneficiary_data->org_id){
                             ?>
                             <option selected="selected" value="<?php echo $olst->org_id;?>" data-shortcode="<?php echo $olst->short_code;?>"><?php echo $olst->org_name;?></option>
                             <?php
                             }else{
                             ?>
                             <option value="<?php echo $olst->org_id;?>" data-shortcode="<?php echo $olst->short_code;?>"><?php echo $olst->org_name;?></option>
                             <?php
                             }
                          ?>
                          
                          
                         
                          <?php
                             }
                           }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Short Code</label>
                        <input type="text" class="form-control" id="shortcode" name="shortcode" placeholder="" required="required" readonly="readonly" value="<?php echo $beneficiary_data->benificiary_code;?>">
                      </div>
                    </div>
                  </div>

                 

                  
                 
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Edit</button>
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

     $('#orgid').change(function(){
        $('#shortcode').val("");
        var scode = $(this).find(':selected').attr('data-shortcode');
        $('#shortcode').val(scode);
     });
     

     var baselink = "<?php echo base_url();?>";
     $("#form_add_benificiary").on('submit', function(e){
        e.preventDefault();
        var ttl =  $('#ttl').val();
        var bname =  $('#bname').val();
        var gndiv =  $('#gndiv').val();
        var baddress =  $('#baddress').val();
        var bdob =  $('#bdob').val();
        var dcontact =  $('#dcontact').val();
        var uname = $('#uname').val();
        var pword = $('#pword').val();
        console.log(uname+" "+pword)
       // 
       $.ajax({
                            type: 'POST',
                            url:baselink+"index.php/beneficiari/check_username_and_password_exist",
                            dataType: 'json',
                            data:{'ttl':ttl,'bname':bname,'gndiv':gndiv,'baddress':baddress,'bdob':bdob,'dcontact':dcontact,'uname':uname,'pword':pword},
                            success: function(response){
                              console.log(response)
                              if(response==1){
                                e.preventDefault();
                                $('#unexist').html("Username Exist")
                                $('#pwexist').html("password Exist")
                              }else{
                                alert("Succesfully saved");
                                location.reload();
                              }
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
