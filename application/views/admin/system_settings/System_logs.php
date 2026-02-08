<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">System Logs</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Logs</li>
                        </ol>
                    </div> 
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row" id="containerTable">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="pageTable" class="table stylish-table">
                                    <thead>
                                        <tr>
                                            <th><b>User</th>
                                            <th><b>Transaction</th>  
                                            <th><b>Message</th> 
                                            <th><b>Ip Address</th> 
                                            <th><b>Date/Time</th> 
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($system_logs as $key => $value): ?>
                                            <tr value="<?php echo $value['logs_id'] ?>"> 
                                                <td><?php echo $value['fullname'] ?></td>
                                                <td><?php echo $value['logs_transaction'] ?></td> 
                                                <td><?php echo $value['logs_message'] ?></td> 
                                                <td><?php echo $value['logs_local_ip'] ?></td> 
                                                <td><?php echo $value['logs_date_time'] ?></td>
                                                
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>       
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== --> 
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== --> 
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
