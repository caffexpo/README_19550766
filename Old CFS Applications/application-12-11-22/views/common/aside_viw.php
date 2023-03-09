  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url();?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $this->session->userdata('org_name');?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('logged_user');?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url();?>index.php/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                System Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/users/user_privilages" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Privilages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/users/login_manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/configuration/create_gn_division" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>GN Division Management</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/configuration/create_designation" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Designation Management</p>
                </a>
              </li>

              
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Organization
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/organization/create_organization" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/organization/list_organizations" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Employee
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/employee/create_employee" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/employee/list_employee" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Donor
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/donor" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/donor/view_donor" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Benifishier
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/beneficiari" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/beneficiari/view_benificiary" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-briefcase"></i>
              <p>
                Projects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/project/create_project" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/project/list_project_approve_disaprove" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approve/Disapprove</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/project/list_project" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-gamepad"></i>
              <p>
                Event
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/event/create_event" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/event/apprv_disapprove_event" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approve/Disapprove</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/event/list_event" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-gamepad"></i>
              <p>
                Feedbacks
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/feedback/advance_feedback" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advace Feedback</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/feedback/general_feedback" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Feedback</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-gamepad"></i>
              <p>
                Complaints
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/complains/create_complain_category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Complaints category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/complains" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Complaints</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/complains/list_complains" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Complains</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/report/project_status_rpt" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Status Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/report/donations_inhand" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Donations in Hand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>index.php/report/beneficiary_event_rpt" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Beneficiaries Event Report</p>
                </a>
              </li>
              
              
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>