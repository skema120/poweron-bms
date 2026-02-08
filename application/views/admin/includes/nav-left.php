        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(<?php echo base_url() ?>/assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?php echo base_url() ?>assets/images/users/<?php echo $userdata['image'] ?>?>" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $userdata['first_name'] ?> <?php echo $userdata['last_name'] ?> <span class="caret"></span></a>
                        <div class="dropdown-menu animated flipInY"> 
                            <a href="<?php echo base_url('admin/login/logout') ?>" class="dropdown-item"><i class="mdi mdi-logout"></i> Logout</a>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">POWER ON ENTERPRISE CO.</li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/dashboard') ?>" aria-expanded="false">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Dashboard</span> 
                            </a>
                        </li>

                          <?php if ($userdata['p_supplier'] == 'Allow'):  ?>
                               <li class="sidebar-item">
                                  <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/supplier/supplier_list') ?>" aria-expanded="false">
                                      <i class="mdi mdi-factory"></i>
                                      <span class="hide-menu">Supplier</span> 
                                  </a>
                              </li>
                          <?php endif ?>   

                            <?php if ($userdata['p_manage'] == 'Allow'):  ?>
                           <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark profile-dd" href="javascript:void(0)" aria-expanded="false">
                              <i class="fa fa-th-list"></i>
                                <span class="hide-menu">Manage</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <?php if ($userdata['p_inventory'] == 'Allow'):  ?>
                                <li class="sidebar-item">
                                    <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                        <i class="fa fa-tasks"></i>
                                        <span >Inventory</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <?php if ($userdata['p_onhand'] == 'Allow'):  ?> 
                                        <li class="sidebar-item">
                                            <a href="<?php echo base_url('admin/inventory/inventory_list') ?>" class="sidebar-link">
                                                <i class="fa fa-box-open"></i>
                                                <span> Onhand </span>
                                            </a>
                                        </li>
                                        <?php endif ?>  

                                        <?php if ($userdata['p_delivery'] == 'Allow'):  ?>  
                                        <li class="sidebar-item">
                                            <a href="<?php echo base_url('admin/delivery/delivery_list') ?>" class="sidebar-link">
                                                <i class="fa fa-truck-moving"></i>
                                                <span> Delivery</span>
                                            </a>
                                        </li>
                                         <?php endif ?>  
                                    </ul>
                                </li>
                                <?php endif ?>  

                                <?php if ($userdata['p_purchase_order'] == 'Allow'):  ?>
                                <li class="sidebar-item">
                                    <a class="has-arrow sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                        <i class="fa fa-tasks"></i>
                                        <span>Purchase Order</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse second-level">
                                        <?php if ($userdata['p_distributor'] == 'Allow'):  ?>
                                        <li class="sidebar-item">
                                            <a href="<?php echo base_url('admin/po/purchase_order') ?>" class="sidebar-link">
                                                <i class="fa fa-user"></i>
                                                <span> Distributor </span>
                                            </a>
                                        </li>
                                         <?php endif ?> 
                                       
                                        <?php if ($userdata['p_agency'] == 'Allow'):  ?>
                                        <li class="sidebar-item">
                                            <a href="<?php echo base_url('admin/po/agency') ?>" class="sidebar-link">
                                                <i class="fa fa-building"></i>
                                                <span> Agency</span>
                                            </a>
                                        </li>
                                          <?php endif ?> 
                                    </ul>
                                </li>
                                <?php endif ?> 

                            </ul>
                        </li>
                         <?php endif ?>  
                    <!-- ======================================================================================================== -->     <?php if ($userdata['p_system_settings'] == 'Allow'):  ?> 
                     <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-settings"></i>
                                <span class="hide-menu">System Settings</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                   <?php if ($userdata['p_user_permission'] == 'Allow'):  ?>
                                <li class="sidebar-item">
                                    <a href="<?php echo base_url('admin/system_settings/user_permission') ?>" class="sidebar-link">
                                        <i class="mdi mdi-account-settings-variant"></i>
                                        <span>Set User Permissions</span>
                                    </a>
                                </li>
                                 <?php endif ?>
                                 <?php if ($userdata['p_user_list'] == 'Allow'):  ?>
                                <li class="sidebar-item">
                                    <a href="<?php echo base_url('admin/users/users_list') ?>" class="sidebar-link">
                                        <i class="icon-people"></i>
                                        <span>Users List</span>
                                    </a>
                                </li>
                                 <?php endif ?>
                                 <?php if ($userdata['p_change_password'] == 'Allow'):  ?>
                                <li class="sidebar-item">
                                    <a href="<?php echo base_url('admin/change_password') ?>" class="sidebar-link">
                                        <i class="mdi mdi-lock-reset"></i>
                                        <span>Change Password</span>
                                    </a>
                                </li>
                                 <?php endif ?>

                                  <?php if ($userdata['p_system_log'] == 'Allow'):  ?>
                                <li class="sidebar-item">
                                    <a href="<?php echo base_url('admin/system_settings/system_logs') ?>" class="sidebar-link">
                                        <i class="mdi mdi-history"></i>
                                        <span>System Logs</span>
                                    </a>
                                </li>
                                 <?php endif ?>

                            </ul>
                        </li>
                         <?php endif ?>
                                            
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer" > 
                <!-- item-->
                <a style="width: 100%" href="<?php echo base_url('admin/login/logout') ?>" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
