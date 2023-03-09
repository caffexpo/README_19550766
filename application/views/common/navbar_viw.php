<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
             <?php 
             $totnotification=$notificationdata['pending_benificiry']+$notificationdata['pending_projects']+$notificationdata['pending_events'];
             if($totnotification>0){
             ?>
             <i class="far fa-bell"></i>
             <span class="badge badge-danger navbar-badge"><?php echo $totnotification;?></span>
             <?php
             }else{
             ?>
             <i class="far fa-bell"></i>
             <!--<span class="badge badge-danger navbar-badge">0</span>-->
             <?php
             }
          ?>          
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
          
          </span>
          <div class="dropdown-divider"></div>

          
          <a href="<?php echo base_url();?>index.php/beneficiari/appr_disapprove_benificiary" class="dropdown-item">
            <i class="fa-thumbs-o-up mr-2"></i><?php echo $notificationdata['pending_benificiry'];?>  Pending Benificiary Applications
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          
          <a href="<?php echo base_url();?>index.php/project/list_project_approve_disaprove" class="dropdown-item">
            <i class="fa-thumbs-o-up mr-2"></i><?php echo $notificationdata['pending_projects'];?>  Pending Projects
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>

          <a href="<?php echo base_url();?>index.php/event/apprv_disapprove_event" class="dropdown-item">
            <i class="fa-thumbs-o-up mr-2"></i><?php echo $notificationdata['pending_events'];?>  Pending Events
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>

          <!--<a href="<?php echo base_url();?>index.php/event/apprv_disapprove_event" class="dropdown-item">
            <i class="fa-thumbs-o-up mr-2"></i><?php echo $notificationdata['x'];?>  x count
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>-->
          
          
          
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>index.php/auth/logout" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>