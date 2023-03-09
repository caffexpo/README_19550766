<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo webheding;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php $this->load->view('common/navbar_viw');?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('common/aside_viw');?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $empdata->emp_name;?></h3>

                <p class="text-muted text-center"><?php echo $empdata->designation;?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Organization : <?php echo $empdata->org_name;?></b> <a class="float-right"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Contact : <?php echo $empdata->emp_contact;?></b> <a class="float-right"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Address : <?php echo $empdata->emp_address;?></b> <a class="float-right"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Base Location : <?php echo $empdata->district;?></b> <a class="float-right"</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
         <?php 
         if($ids==$this->session->userdata('emp_id')){
         ?>


          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Login Change</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <form role="form" action="<?php echo base_url();?>index.php/users/change_password" method="post" id="reset_login_form">
                <div class="card-body">


                 
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" id="un" name="un" placeholder="Enter Username" required="required" value="<?php echo $this->session->userdata('username');?>" readonly="readonly">
                      </div>
                    </div>
                    

                  </div>

                  <div class="row">
                   
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" id="pw" name="pw" placeholder="" required="required" ><input type="checkbox" onclick="myFunction()">Show Password
                      </div>
                    </div>

                   

                  </div>

                  <div class="row">
                   
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Re enter Password</label>
                        <input type="password" class="form-control" id="rtpw" name="rtpw" placeholder="" required="required" value=""><input type="checkbox" onclick="myFunction2()">Show Password
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
              
                  </div>
                
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <?php } ?>







          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
<script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/dist/js/demo.js"></script>

<script type="text/javascript">
  
 function myFunction() {
  var x = document.getElementById("pw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

 function myFunction2() {
  var x = document.getElementById("rtpw");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


$(function(){
      $("#reset_login_form").on('submit', function(e){
       // e.preventDefault();
       var pw = $('#pw').val();
       var rtpw = $('#rtpw').val();

       if(pw==rtpw){
         $("#reset_login_form").submit();
       }else{
         e.preventDefault();
         alert("password and confirm password not matching")
       }

      });   
     

});

</script>
</body>
</html>
