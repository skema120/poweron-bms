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
                        <h3 class="text-themecolor m-b-0 m-t-0">Supplier</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Supplier List</li>
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
                    <div class="col-lg-12 col-md-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <button id="btnAddNewAdmin" class="pull-right btn btn-success"><i class="fa fa-plus"></i> Add new</button>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                <table id="pageTable" class="table stylish-table mt-4 v-middle">
                                    <thead>
                                        <tr>
                                            <th class="border-0 text-muted font-weight-medium"><b>SUPPLIER NAME</b></th> 
                                            <th class="border-0 text-muted font-weight-medium"><b>SUPPLIER ADDRESS</b></th> 
                                            <th class="border-0 text-muted font-weight-medium"><b>CONTACT PERSON</b></th> 
                                            <th class="border-0 text-muted font-weight-medium"><b>CONTACT NUMBER</b></th>
                                            <th class="border-0 text-muted font-weight-medium"><b>Action</b></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($supplier as $key => $value): ?>
                                            <tr value="<?php echo $value['supplier_id'] ?>"> 
                                                <td><?php echo $value['supplier_name'] ?></td> 
                                                <td><?php echo $value['supplier_address'] ?></td> 
                                                <td><?php echo $value['supplier_contact_person'] ?></td> 
                                                <td><?php echo $value['supplier_contact_number'] ?></td>
                                                <td><button id="viewSupplier" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Edit</button></td> 
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="containerDetails" class="row hide">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <button id="btnBACK" class="pull-left btn btn-success"><i class="fa fa-plus"></i> BACK</button>
                                <form id="formSaveDetail" method="POST" class="form-material" action="<?php echo base_url('admin/supplier/supplier_list/saveDetail') ?>">
                                    <div class="row">
                                        <div class="col-6 offset-3 text-center">

                                            <h3>Supplier Information</h3>
                                            <input type="hidden" name="supplier_id"> 
                                            <div class="form-group">
                                                <label for="detail_category_name">SUPPLIER NAME:</label>
                                                <input required type="text" name="supplier_name" class="form-control text-center">
                                                <span class="text-danger hide errorResponse">Supplier Already Exist!</span>
                                            </div> 
                                            <div class="form-group">
                                                 <label>SUPPLIER ADDRESS:</label>
                                                 <input required type="text" name="supplier_address" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                 <label>CONTACT PERSON:</label>
                                                 <input type="text" name="supplier_contact_person" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                 <label>CONTACT NUMBER:</label>
                                                 <input type="number" name="supplier_contact_number" class="form-control text-center">
                                            </div>

                                            <button type="submit" class="btn btn-success" style="margin-top: 5px"><i class="fa fa-save fa-lg"></i> Save</button>
                                        </div>
                                    </div>
                                </form>
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
<script>
     // ==============================================================
   // ESCAPE TO BACK
    // ==============================================================
   $(document).keydown(function(e) {
    // ESCAPE key pressed
    if (e.keyCode == 27) {
         document.getElementById("btnBACK").click();
    }
});

   $('#btnBACK').on('click',function(){
        $('#containerTable').removeClass('hide');
        $('#containerDetails').addClass('hide');
    });

    // $('#pageTable tbody').on('click','tr',function(){
    //     var supplier_id = $(this).attr('value');
    //     getSupplierDetails(supplier_id);
    //     $('#containerDetails').removeClass('hide')
    //     $('#containerTable').addClass('hide');
    // });

    $(document).on('click', '#viewSupplier', function(e) {
           if(!$(e.target).closest('#viewSupplier').not(this).length){

                var supplier_id = $(this).closest('tr').attr('value');

                getSupplierDetails(supplier_id);

                $('#containerDetails').removeClass('hide')
                $('#containerTable').addClass('hide');
         

               }else{      
                 console.log('Ignore parent event');
               }     
    });


    
    $('#formSaveDetail').on('submit',function(e){
        //  var users_id = '<?php echo $userdata['users_id']; ?>' ;
        // if(users_id != ''){
            $('#formSaveDetail')[0].submit();
            $(this).find(':submit').attr('disabled','disabled');
            e.preventDefault();
        //     } else {
        //     // alert('session not exist');
        //      window.location.href = "../login";
        //      e.preventDefault();  
        // }
    });

    $('#btnAddNewAdmin').on('click',function(){
        $('#containerDetails').removeClass('hide')
        $('#containerTable').addClass('hide');

        $('#formSaveDetail')[0].reset();
        $('input[name=supplier_id]').removeAttr("value");
        
    });

    function getSupplierDetails(supplier_id) {
        $.post('<?php echo base_url('admin/supplier/supplier_list/getSupplierDetails') ?>',
            {supplier_id},function(data){
                data = JSON.parse(data); 
                $.each(data,function(key,value){
                    $.each(value,function(k,v){
                        $('input[name='+k+']').val(v);
                    });
                });
 
            });
    }


</script>