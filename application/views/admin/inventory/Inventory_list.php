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
                        <h3 class="text-themecolor m-b-0 m-t-0">Onhand Item</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Item List</li>
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
                                <div class="row">
                    <?php if ($userdata['users_account_type'] == 'SuperUser' OR $userdata['users_account_type'] == 'IT Analyst'):  ?>
                                    <div class="col-12">
                                        <button id="btnAddNewAdmin" class="pull-right btn btn-success"><i class="fa fa-plus"></i> Add new
                                        </button>
                                    </div>
                                            
                    <?php endif ?>
                    

                                    
                                </div>
                                 <div class="table-responsive">
                                <table id="pageTable" class="table stylish-table">
                                    <thead>
                                        <tr>
                                            <th><b>ID</b></th> 
                                            <th><b>Supplier</b></th> 
                                            <th><b>Description</b></th> 
                                            <th><b>Brand Name</b></th>
                                            <th><b>Sub Class</b></th> 
                                            <th><b>Unit</b></th> 
                                            <th><b>Quantiy Onhand</th>
                                            <th><b>Status</b></th>
                                            <?php if ($userdata['users_account_type'] == 'SuperUser' OR $userdata['users_account_type'] == 'IT Analyst'):  ?> 
                                            <th><b>Action</b></th>
                                            
                                            <?php endif ?>
                                            <th><b>Created By</b></th> 
                                            <th><b>Date Created</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($product as $key => $value): ?>
                                            <tr value="<?php echo $value['inventory_id'] ?>">
                                                <td><?php echo $value['inventory_id'] ?></td> 
                                                <td><?php echo $value['supplier_name'] ?></td>
                                                <td><?php echo $value['inventory_item_description'] ?></td> 
                                                <td><?php echo $value['inventory_item_brand'] ?></td> 
                                                <td><?php echo $value['inventory_item_sub_class'] ?></td> 
                                                <td><?php echo $value['inventory_item_unit'] ?></td>       
                                                <td class="qty"><?php echo $value['inventory_item_qty_onhand'] ?></td>
                                                <td class="status" value="<?php echo $value['status'] ?>"><?php echo $value['status'] ?></td>

                                                <?php if ($userdata['users_account_type'] == 'SuperUser' OR $userdata['users_account_type'] == 'IT Analyst'):  ?>
                                                <td><button id="viewProducts" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Edit</button></td>
                                              
                                                <?php endif ?>

                                                <td><?php echo $value['inventory_item_created_by'] ?></td> 
                                                <td><?php echo $value['inventory_item_date_created'] ?></td> 
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
                                <form id="formSaveDetail" method="POST" class="form-material" action="<?php echo base_url('admin/inventory/inventory_list/saveDetail') ?>">
                                    <div class="row">
                                        <div class="col-6 offset-3 text-center">

                                            <h3>Item Information</h3>
                                            <input type="hidden" name="inventory_id">
                                             <input type="hidden" name="inventory_item_created_by">
                                            <input type="hidden" name="inventory_item_date_created">
                                            <div class="form-group">
                                                <label>SUPPLIER:</label>
                                                <select class="select2" style="width: 100%" name="supplier_id">
                                                    <option value="">Select Supplier</option>
                                                    <?php foreach ($supplier as $key => $value): ?>
                                                    <option value="<?php echo $value['supplier_id'] ?>">
                                                    <?php echo $value['supplier_name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                 <label><u>DESCRIPTION:</u></label>
                                                 <input required type="text" name="inventory_item_description" class="form-control text-center">
                                            </div>

                                            <div class="form-group">
                                                <label for="detail_category_name"><u>BRAND NAME</u></label>
                                                <input onkeyup="this.value = this.value.toUpperCase();" required type="text" name="inventory_item_brand" class="form-control text-center">
                                                <span class="text-danger hide errorResponse">Category Already Exist!</span>
                                            </div>
                                            <div class="form-group">
                                                <label><u>SUB CLASS:</u></label> 
                                                <select required class="select2" style="width: 100%" name="inventory_item_sub_class" >
                                                    <option value="">Select Sub Class</option>
                                                    <option value="HARDWARE">HARDWARE</option>
                                                    <option value="I.T CONSUMABLES">I.T CONSUMABLES</option>
                                                    <option value="I.T EQUIPMENT">I.T EQUIPMENT</option>  
                                                    <option value="I.T PERIPHERALS">I.T PERIPHERALS</option>
                                                    <option value="I.T ACCESSORIES">I.T ACCESSORIES</option> 
                                                </select>
                                            </div>    

                                            <!-- <div class="form-group">
                                                 <label>If the item has a serial number, Click to Enable, if not disabled it.</label><br>
                                                 <input type="checkbox" id="check1" name="  " class="chk-col-teal">
                                                 <label for="check1"  class="check11" href="#">Disabled</label><br>
                                            </div>  -->
                                            <!-- <div class="form-group">
                                                 <label><u>UNIT:</u></label>
                                                 <input required type="text" name="inventory_item_unit" class="form-control text-center">
                                            </div> -->
                                            <div class="form-group">
                                                <label><u>UNIT:</u></label> 
                                                <select required class="select2" style="width: 100%" name="inventory_item_unit" >
                                                    <option value="">Select Category</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Set">Set</option>  
                                                    <option value="Pck">Pack</option>
                                                    <option value="Box">Box</option> 
                                                </select>
                                            </div> 
                                            <div class="form-group">
                                                 <label><u>QUANTITY RECEIVED:</u></label>
                                                 <input required type="number" name="inventory_item_qty_received" class="form-control text-center">
                                            </div>
                                            <div id="onhand" class="form-group">
                                                 <label><u>QUANTITY ON-HAND:</u></label>
                                                 <input required type="number" name="inventory_item_qty_onhand" class="form-control text-center">
                                            </div>




                                            <!-- <div id="divElement" class="col-13 offset-0 text-center">
                                                    <div class="containerAddPO">
                                                        <table id="tableCurrentPO" class="table stylish-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Item<br>No.</th>
                                                                        <th>Serial Number</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                            <section  class="containerPO" >
                                                                 
                                                            </section>
                                                                
                                                            <div class="text-center">
                                                                <a id="addPO" href="#"><i class="fas fa-plus-circle"></i></a>
                                                            </div>
                                                    </div>
                                                </div> -->



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


$('.table').each(function() {
   $('.status:contains("Out of Stock")').css('color', 'red');
   $('.status:contains("In Stock")').css('color', 'green');  
});

    $(document).ready(function() {    

            // $('#tbody tr').each(function() {
            //              var qty = $(this).find(".qty").html();  
 
            //          if (qty > 0){
            //             $(this).find('.status').html('In Stock');
            //          } else {
            //             $(this).find('.status').html('Out of Stock');
            //          }
            // });

       // $('.status:contains("Out of Stock")').css('color', 'red');
       // $('.status:contains("In Stock")').css('color', 'green'); 
    });
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


     $(document).on('click', '#viewProducts', function(e) {
           if(!$(e.target).closest('#viewProducts').not(this).length){

                var inventory_id = $(this).closest('tr').attr('value');

                getProductDetails(inventory_id);
                // getProductSerialNumberDetails(inventory_id);
                
                $('#onhand').removeClass('hide');
                $('input[name=inventory_item_qty_onhand]').prop('required',true);

                $('#containerDetails').removeClass('hide')
                $('#containerTable').addClass('hide');
         

               }else{      
                 console.log('Ignore parent event');
               }     
    });


    $('#formSaveDetail').on('submit',function(e){
        // var users_id = '<?php echo $userdata['users_id']; ?>' ;
        // if(users_id != ''){
            $('#formSaveDetail')[0].submit();
            $(this).find(':submit').attr('disabled','disabled');
            e.preventDefault();
        // } else {
        //     // alert('session not exist');
        //      window.location.href = "../login";
        //      e.preventDefault();  
        // }
    });

    $('#btnAddNewAdmin').on('click',function(){
        $('#containerDetails').removeClass('hide')
        $('#containerTable').addClass('hide');

        $('#formSaveDetail')[0].reset();
        $('select').trigger('change');
        $('input[name=inventory_id]').removeAttr("value");
        $('input[name=inventory_item_created_by]').removeAttr("value");
        $('input[name=inventory_item_date_created]').removeAttr("value");
        $('#tableCurrentPO tbody').empty();

        
        $('input[name=inventory_item_qty_onhand]').removeAttr('required');
        $('#onhand').addClass('hide');
       
        // $('input[name=inventory_item_serial_status]').removeAttr("value");
    });

    // $('#check1').on('click',function(e){
    //                 // e.preventDefault();
    //                 var status = $('.check11').html(); 
    //                 if (status == 'Disabled') {
    //                     $('input[name=inventory_item_serial_status]').val("1");

    //                     $("input[name=inventory_item_qty_onhand]").prop('required',false);
    //                     $('#qty').addClass('hide');
    //                     $('.check11').html('Enabled');
    //                     $('#divElement').removeClass('hide');
    //                 } else if (status == 'Enabled') {
    //                     $('input[name=inventory_item_serial_status]').val("0");

    //                     $("input[name=inventory_item_qty_onhand]").prop('required',true);
    //                     $('#qty').removeClass('hide');
    //                     $('.check11').html('Disabled');
    //                     $('#divElement').addClass('hide');

    //                 }
                   
    //             });



       // ==============================================================
   // ADD TAB ITEM
    // ==============================================================

   // $('#addPO').on('click',function(e){
   //          e.preventDefault();
   //          var containerPO = $('.containerPO');
   //          var newSection = '<section>\
   //                              <div class="text-center" >\
   //                                  <a class="removeSection" href="#"><i class="fas text-danger fa-minus-circle"></i></a>\
   //                              </div>\
   //                                       <div class="form-group">\
   //                                           <h4><u>Serial Number</u></h4>\
   //                                           <input type="text" name="serial_number[]" class="form-control text-center" placeholder="Serial Number">\
   //                                       </div>\
   //                          </section>';
   //          containerPO.append(newSection);


   //                  $('.removeSection').on('click',function(e){
   //                      e.preventDefault();
   //                      $(this).closest('section').remove();
   //                  });
   //       }); 


        //    function getProductSerialNumberDetails(inventory_id) {
        // $.post('<?php echo base_url('admin/inventory/inventory_list/getProductSerialNumberDetails') ?>',
        //     {inventory_id},function(data){
        //         data = JSON.parse(data);
        //         var tableCurrentPO = $('#tableCurrentPO tbody');
        //             tableCurrentPO.empty();
        //          if (data.length > 0 ) {
        //                 $.each(data,function(key,value){
        //                     var newTr = '<tr value="'+value.id+'">\
        //                                     <td>'+(key+1)+'</td>\
        //                                     <td value="serial_number"><input type="text" class="inputSerialNumber form-control text-center" value="'+value.serial_number+'" placeholder="Serial Number"></td>\
        //                                     <td><a class="deleteSerial" href="#"><i class="fas fa-trash text-danger"></i></a></td>\
        //                                 </tr>';
        //                     tableCurrentPO.append(newTr); 
        //                     // $('#input_'+value.id).val(value.serial_number);
        //                 });

        //                 $('.deleteSerial').on('click',function(e){
        //                     e.preventDefault();
        //                     var tr = $(this).closest('tr');
        //                     var id = $(this).closest('tr').attr('value');
        //                     swal({   
        //                         title: "Are you sure?",   
        //                         text: 'This will be deleted!',   
        //                         type: "warning",   
        //                         showCancelButton: true,   
        //                         confirmButtonColor: "#DD6B55",   
        //                         confirmButtonText: "Yes, delete it!",   
        //                         // closeOnConfirm: false ,
        //                         preConfirm: function() {
        //                             deleteSerial(tr,id);
        //                         }
        //                     }).then(function(){ 
        //                     });
                            
        //                 });

        //                 $('.inputSerialNumber').on('change',function(){
        //                     var id = $(this).closest('tr').attr('value');
        //                     var value = $(this).val();
        //                     var field = $(this).closest('td').attr('value'); 
        //                     updateSerialNumber(id,field,value); 
        //                 });


        //                 function updateSerialNumber(id,field,value) {
        //                     $.post('<?php echo base_url('admin/inventory/inventory_list/updateSerialNumber') ?>',
        //                         {id,field,value},function(data){ 
        //                             $.toast({
        //                                     heading: 'Update Success!',
        //                                     text: field+' successfully updated to '+value,
        //                                     position: 'top-right',
        //                                     loaderBg:'#17a2b8',
        //                                     icon: 'success',
        //                                     hideAfter: 3500, 
        //                                     stack: 6
        //                                   });
        //                         });
        //                 }


        //                 function deleteSerial(tr,id) {
        //                     $.post('<?php echo base_url('admin/inventory/inventory_list/deleteSerial') ?>',
        //                         {id},function(data){
        //                             tr.remove();
        //                             $.toast({
        //                                     heading: 'Delete Success!',
        //                                     text: 'Serial Number successfully deleted!',
        //                                     position: 'top-right',
        //                                     loaderBg:'#17a2b8',
        //                                     icon: 'success',
        //                                     hideAfter: 3500, 
        //                                     stack: 6
        //                                   });
        //                         });
        //                 }
                    

                        
                      
        //             } else {
        //                 // tableCurrentPO.append('<tr><td colspan="6">Click + below to add</td></tr>');
        //             } 
        //         });
        //     }

    function getProductDetails(inventory_id) {
        $.post('<?php echo base_url('admin/inventory/inventory_list/getProductDetails') ?>',
            {inventory_id},function(data){
                data = JSON.parse(data); 
                $.each(data,function(key,value){
                    $.each(value,function(k,v){
                        $('input[name='+k+']').val(v);
                        $('select[name='+k+']').val(v);
                    });
                    // if(value.inventory_item_serial_status == 1){
                    //      $('input[name=inventory_item_qty_onhand]').prop('required',false);
                    //      $('#check1').prop('checked',true);
                    //      $('#qty').addClass('hide');
                    //      $('.check11').html('Enabled');
                    //      $('#divElement').removeClass('hide');

                    // }
                    // else if (value.inventory_item_serial_status == 0) {
                    //      $('input[name=inventory_item_qty_onhand]').prop('required',true);
                    //      $('#check1').prop('checked',false);
                    //      $('#qty').removeClass('hide');
                    //      $('.check11').html('Disabled');
                    //      $('#divElement').addClass('hide');
                    // }
                });
                $('select').trigger('change');
                 
 
            });
    }

    

</script>