<!-- Page wrapper -->
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
                    <div class="col-lg-3 col-md-4 col-xs-12 justify-content-start d-flex align-items-center">
                         <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 d-flex justify-content-start justify-content-md-end align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card material-card">
                            <div class="card-body">
                                <h5 class="card-title">Users</h5>
                                <div class="d-flex align-items-center mb-2 mt-4">
                                    <h2 class="mb-0 display-5"><i class="icon-people text-info"></i></h2>
                                    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                                    <div class="ms-auto">
                                          <?php foreach ($users as $key => $value): ?>
                                        <h2 class="mb-0 display-6"><span class="fw-normal"><?php echo $value['users'] ?></span></h2>
                                          <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card material-card">
                            <div class="card-body">
                                <h5 class="card-title">Supplier</h5>
                                <div class="d-flex align-items-center mb-2 mt-4">
                                    <h2 class="mb-0 display-5"><i class="mdi mdi-factory text-warning"></i></h2>
                                    <div class="ms-auto">
                                         <?php foreach ($supplier as $key => $value): ?>
                                        <h2 class="mb-0 display-6"><span class="fw-normal"><?php echo $value['supplier'] ?></span></h2>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card material-card">
                            <div class="card-body">
                                <h5 class="card-title">Onhand</h5>
                                <div class="d-flex align-items-center mb-2 mt-4">
                                    <h2 class="mb-0 display-5"><i class="fa fa-box-open text-success"></i></h2>
                                    <div class="ms-auto">
                                         <?php foreach ($onhand as $key => $value): ?>
                                        <h2 class="mb-0 display-6"><span class="fw-normal"><?php echo $value['onhand'] ?></span></h2>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card material-card">
                            <div class="card-body">
                                <h5 class="card-title">Delivery</h5>
                                <div class="d-flex align-items-center mb-2 mt-4">
                                    <h2 class="mb-0 display-5"><i class="fas fa-truck-moving text-danger"></i></h2>
                                    <div class="ms-auto">
                                         <?php foreach ($delivery as $key => $value): ?>
                                        <h2 class="mb-0 display-6"><span class="fw-normal"><?php echo $value['delivery'] ?></span></h2>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                <!-- ============================================================== -->
                <!-- END Page Content -->
                <!-- ============================================================== -->
            </div>
             <!-- ============================================================== -->
                <!-- User Table & Profile Cards Section  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="card material-card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase mb-0">TODAY's Item Received</h5>
                            
                            <div class="table-responsive">
                                <table id="TItemTable" class="table stylish-table  user-table mb-4">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Brand</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Description</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <?php foreach ($today_item as $key => $value): ?>
                                        <tr>
                                            <td class="pl-4"><?php echo $value['row_num'] ?></td>
                                            <td><?php echo $value['inventory_item_brand'] ?></td>
                                            <td><?php echo $value['inventory_item_description'] ?></td>
                                            <td style="color:white;"><span class="badge bg-success px-2 py-1"><?php echo $value['inventory_item_qty_received'] ?></span></td>
                                        </tr>
                                            <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-12 col-lg-6">
                        <div class="card material-card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase mb-0">Delivery PENDING Status</h5>
                            
                            <div class="table-responsive">
                                <table id="DTable" class="table stylish-table  user-table mb-4">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">No.</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Category</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">END User</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <?php foreach ($pending_delivery_status as $key => $value): ?>
                                        <tr>
                                            <td class="pl-4"><?php echo $value['row_num'] ?></td>
                                            <td><?php echo $value['delivery_no'] ?></td>
                                            <td><?php echo $value['delivery_category'] ?></td>
                                            <td><?php echo $value['delivery_end_user'] ?></td>
                                            <td style="color:white;"><span class="badge px-2 py-1"><?php echo $value['delivery_status'] ?></span></td>
                                        </tr>
                                            <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
            
                <!-- ============================================================== -->
                <!-- User Table & Profile Cards Section  -->
                <!-- ============================================================== -->
                             
                    <div class="col-md-12 col-lg-6">
                        <div class="card material-card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase mb-0"><b>Distributor</b> Purchase Order OPEN Status</h5>
                            
                            <div class="table-responsive">
                                <table id="POTable" class="table stylish-table  user-table mb-4">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">PO No.</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Agency</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php foreach ($open_po_status as $key => $value): ?>
                                        <tr>
                                            <td class="pl-4"><?php echo $value['row_num'] ?></td>
                                            <td><?php echo $value['po_number'] ?></td>
                                            <td><?php echo $value['po_end_user'] ?></td>
                                            <td style="color:white;"><span class="badge px-2 py-1"><?php echo $value['po_status'] ?></span></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <div class="card material-card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase mb-0"><b>Agency</b> Purchase Order OPEN Status</h5>
                            
                            <div class="table-responsive">
                                <table id="ATable" class="table stylish-table  user-table mb-4">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">PO No.</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Agency</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <?php foreach ($open_agency_status as $key => $value): ?>
                                        <tr>
                                            <td class="pl-4"><?php echo $value['row_num'] ?></td>
                                            <td><?php echo $value['agency_po_number'] ?></td>
                                            <td><?php echo $value['agency_name'] ?></td>
                                            <td style="color:white;"><span class="badge px-2 py-1"><?php echo $value['agency_status'] ?></span></td>
                                        </tr>
                                            <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>


                </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

<script >
        $(document).ready(function() {
            // $('.status').css('color','white');  
            // $('.badge:contains("OPEN")').addClass('bg-danger');
            // $('.badge:contains("PENDING")').addClass('bg-danger');
            // $('.badge:contains("DELIVERED")').addClass('bg-success');
            // $('.badge:contains("CHECKING")').addClass('bg-warning');  


        });


        $('.table').each(function() {
            $('.status').css('color','white');  
            $('.badge:contains("OPEN")').addClass('bg-danger');
            $('.badge:contains("CLOSED")').addClass('bg-success');  
            $('.badge:contains("PENDING")').addClass('bg-warning'); 
        });
</script>