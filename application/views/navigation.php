<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url() ?>index.php/incident">
                <h4>MaMo</h4>
				</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
	
                        <?php if($this->session->userdata('loggedInUser')['permission'] == 'reporter' )
                        { 
                        ?>

                        <li>
                            <a href="<?php echo base_url() ?>index.php/incident"><i class="fa fa-bars fa-fw"></i> Report Incident/ Concern</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>index.php/message_list"><i class="fa fa-envelope-o fa-fw"></i> Emergency Notifications</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>index.php/barangay_form"><i class="fa  fa-book fa-fw"></i> Request Brgy. Forms</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>index.php/hotlines"><i class="fa fa-phone fa-fw"></i> Emergency Hotlines</a>
                        </li>    
                        <?php 
                        }
                        ?>


                        <?php if($this->session->userdata('loggedInUser')['permission'] == 'admin' )
                        { 
                        ?>

                        <li>
                            <a href="<?php echo base_url() ?>index.php/incident"><i class="fa fa-bars fa-fw"></i> Reported Incidents</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope-o fa-fw"></i> Emergency Notification</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url() ?>index.php/compose"><i class="fa fa-plus"></i> Compose</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>index.php/sent"><i class="fa fa-send"></i> Sent</a>
                                </li>
                            </ul>    
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>index.php/barangay_form_requests"><i class="fa  fa-book fa-fw"></i> Brgy. Form Requests</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>index.php/hotlines"><i class="fa fa-phone fa-fw"></i> Emergency Hotlines</a>
                        </li>    
                        <?php 
                        }
                        ?>

						<li>
                            <a href="<?php echo base_url() ?>index.php/"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		
		