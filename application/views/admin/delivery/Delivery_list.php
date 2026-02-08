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
                        <h3 class="text-themecolor m-b-0 m-t-0">Manage Delivery</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Delivery List</li>
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
                                    <div class="col-12">
                                        <button id="btnAddNewAdmin" class="pull-right btn btn-success"><i class="fa fa-plus"></i> Add new</button>
                                    </div>
                                    
                                </div>

                                <table id="pageTable" class="table stylish-table">
                                    <thead>
                                        <tr>
                                            <th><b>ID</b></th> 
                                            <th><b>CATEGORY NO.</b></th> 
                                            <th><b>CATEGORY</b></th> 
                                            <th><b>END USER</b></th> 
                                            <th><b>Delivered By</b></th> 
                                            <th><b>DATE</b></th> 
                                            <th><b>STATUS</b></th>
                                            <th><b>ACTION</b></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($delivery as $key => $value): ?>
                                            <tr value="<?php echo $value['delivery_id'] ?>">
                                                <td><?php echo $value['delivery_id'] ?></td> 
                                                <td><?php echo $value['delivery_no'] ?></td>
                                                <td><?php echo $value['delivery_category'] ?></td> 
                                                <td><?php echo $value['delivery_end_user'] ?></td> 
                                                <td><?php echo $value['delivered_by'] ?></td>
                                                <td class="delivery_date_delivered"><?php echo $value['delivery_date_delivered'] ?></td>
                                                <td class="dr_status"><span class="badge px-2 py-1 <?php echo $value['delivery_status'] ?>"><?php echo $value['delivery_status'] ?></span></td> 
                                                <td><button id="viewDelivery" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Edit</button></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="containerDetails" class="row hide">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <button id="btnBACK" class="pull-left btn btn-success"><i class="fa fa-plus"></i> BACK</button>
                                <form id="formSaveDetail" method="POST" class="form-material" action="<?php echo base_url('admin/delivery/delivery_list/saveDetail') ?>">
                                    <div class="row">
                                        <div class="col-6 offset-3 text-center">

                                            <h3>Delivery Information</h3>
                                            <input type="hidden" name="delivery_id"> 
                                            <div class="form-group">
                                                 <label><u>NO. :</u></label>
                                                 <input style="width:300px;" required type="text" name="delivery_no" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                 <label><u>CATEGORY :</u></label>
                                                 <select required class="select2" style="width: 100%" name="delivery_category" >
                                                    <option value="N/A">N/A</option>
                                                    <option value="DELIVERY RECEIPT">DELIVERY RECEIPT</option>
                                                    <option value="SALES INVOICE">SALES INVOICE</option>  
                                                    <option value="CHARGE INVOICE">CHARGE INVOICE</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label><u>END USER :</u></label>
                                                <input onkeyup="this.value = this.value.toUpperCase();" style="width:300px;" required type="text" name="delivery_end_user" class="form-control text-center">
                                            </div> 
                                            <div class="form-group">
                                                <label><u>DELIVERED BY :</u></label>
                                                <input  style="width:300px;" required type="text" name="delivered_by" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                 <label><u>DELIVERY DATE :</u></label>
                                                 <div class="input-group">
                                                    <input name="delivery_date_delivered" class="form-control material_date_time text-center" value="" required>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                 </div>
                                            </div>
                                            <div class="form-group">
                                                 <label><u>DELIVERY STATUS :</u></label>
                                                 <select required class="select2" style="width: 100%" name="delivery_status" >
                                                    <option value="PENDING">PENDING</option>
                                                    <option value="DELIVERED">DELIVERED</option>
                                                    <option value="PICKED UP">PICKED UP</option>  
                                                    <option value="RETURNED">RETURNED</option>
                                                </select>
                                            </div>
                                            <span class="text-danger hide errorValue">Change the value!</span>
                                        </div>
                                    </div>

                                            <div class="offset-2 text-center">
                                                    <div class="containerAddPO">
                                                        <table id="tableCurrentPO" class="table stylish-table table-responsive">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Item</th> 
                                                                        <th>Item No.</th>      
                                                                        <th>Serial Number</th>
                                                                        <th>Qty</th>
                                                                        <th>Warranty</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                            <section  class="containerPO" >
                                                                 
                                                            </section>
                                                     </div>
                                               </div>
                                                                
                                                            <div class="text-center">
                                                                <a id="addPO" href="#"><i class="fas fa-plus-circle"></i></a>
                                                            </div>
                                               

                                           <div class="text-center">
                                                <button type="submit" class="btn btn-success" style="margin-top: 5px"><i class="fa fa-save fa-lg"></i> Save</button>
                                            </div>
                                    <!-- </div> -->
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
<style >
.sub_class ,.warranty {
     width: 100%;
}

.item_serial_number,.inputDescription,.inputSerialNumber{
  height: 150px;  
}

.inputSubClass,.inputDescription{
  width: 130px;
}
.delivery_date_delivered{
  width: 90px;
}
.inputQty,.inputWarranty{
  width: 100px;   
}
</style>
<script>
 
     $(document).on('keyup','.delivery_item_qty',function(e){
        var delivery_item_qty = $(this).val();
        var inventory_id =  $(this).closest('section').find(':selected').val();
        checkIfQtyExceed(delivery_item_qty,inventory_id);


              function checkIfQtyExceed(delivery_item_qty,inventory_id) {
                  $.post('<?php echo base_url('admin/delivery/delivery_list/checkIfQtyExceed') ?>',
                      {delivery_item_qty,inventory_id},function(data){

                          if (data == '1') {
                               $(e.target).val('');
                                $(e.target).closest('section').find('.errorValue').removeClass('hide');
                               alert('Delivery Quantity cannot be more than from the On-hand Quantity');
                          } else{
                              $(e.target).closest('section').find('.errorValue').addClass('hide');
                          }

                      });
              }

      });

$('.table').each(function() {
       $(this).find('.dr_status').css('color','white'); 
       $('.badge:contains("PENDING")').addClass('bg-danger');
       $('.badge:contains("DELIVERED")').addClass('bg-success');
       $('.badge:contains("PICKED UP")').addClass('bg-success');
       $('.badge:contains("RETURNED")').addClass('bg-warning'); 
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


    $(document).on('click', '#viewDelivery', function(e) {
           if(!$(e.target).closest('#viewDelivery').not(this).length){

                var delivery_id = $(this).closest('tr').attr('value');
                getDeliveryDetails(delivery_id);
                getDeliveryItemDetails(delivery_id);
                $('#containerDetails').removeClass('hide')
                $('#containerTable').addClass('hide');
                 $('.containerPO').empty();

                $('input[name=delivery_date_delivered]').prop('disabled',false);
                

               }else{      
                 console.log('Ignore parent event');
               }     
    });

    
    $('#formSaveDetail').on('submit',function(e){

        if ($('.errorValue').hasClass('hide')) {  

                  $('#formSaveDetail')[0].submit();
                  $(this).find(':submit').attr('disabled','disabled');
                  e.preventDefault();

            } else { e.preventDefault(); }
    });



    $('#btnAddNewAdmin').on('click',function(){
        $('#containerDetails').removeClass('hide')
        $('#containerTable').addClass('hide');

        $('#formSaveDetail')[0].reset();
        $('input[name=delivery_id]').removeAttr("value");
        $('#tableCurrentPO tbody').empty();
        $('select').trigger('change');
        $('.containerPO').empty();

            var today = new Date();
            var dd = today.getDate();

            var mm = today.getMonth()+1; 
            var yyyy = today.getFullYear();
            if(dd<10) 
            {
                dd='0'+dd;
            } 

            if(mm<10) 
            {
                mm='0'+mm;
            } 
            
             var today1 = yyyy+'-'+mm+'-'+dd;
            $('input[name=delivery_date_delivered]').val(today1);
             $('input[name=delivery_date_delivered]').prop('disabled',true);
        
    });

           // ==============================================================
   // ADD TAB ITEM
    // ==============================================================

           $('#addPO').on('click',function(e){
        e.preventDefault();
        var containerPO = $('.containerPO');
       var newSection = '<section>\
                            <div class="text-center" >\
                                <a class="removeSection" href="#"><i class="fas text-danger fa-minus-circle"></i></a>\
                            </div>\
                            <div class="row m-t-20 ">\
                                     <div class="form-group">\
                                         <h4><u>Select Item</u></h4>\
                                        <select required name="inventory_id[]" class="select3 inventory_id" style="width:100%"">\
                                                <?php foreach ($inventory as $key => $value): ?>\
                                                <option value="<?php echo $value['inventory_id'] ?>">\
                                                <?php echo $value['inventory_item_description'] ?> || <?php echo $value['inventory_item_qty_onhand'] ?> Pcs </option>\
                                                <?php endforeach ?>\
                                        </select>\
                                     </div>\
                                <div class="col-3">\
                                     <div class="form-group">\
                                         <h4><u>Write down your Serial Numbers</u></h4>\
                                         <textarea name="item_serial_number[]" class="item_serial_number" placeholder="Serial Numbers"></textarea>\
                                     </div>\
                                </div>\
                                <div class="col-3">\
                                     <div class="form-group">\
                                         <h4><u>Quantity</u></h4>\
                                         <input type="number" required name="delivery_item_qty[]" class="delivery_item_qty form-control text-center" placeholder="Quantity">\
                                          <span class="text-danger hide errorValue">Change the value!</span>\
                                     </div>\
                                </div>\
                                <div class="col-2">\
                                     <div class="form-group">\
                                         <h4><u>Warranty</u></h4>\
                                         <select required name="delivery_warranty[]" class="warranty form-control text-center">\
                                             <option value="N/A">N/A</option>\
                                             <option value="1 YEAR">1 YEAR</option>\
                                             <option value="2 YEARS">2 YEARS</option>\
                                             <option value="3 YEARS">3 YEARS</option>\
                                         </select>\
                                     </div>\
                                </div>\
                            </div> \
                        </section>';
        containerPO.append(newSection);
          $(".select3").select2({
                            theme: "classic",
                            width: '350px'
                        });

        $('.removeSection').on('click',function(e){
            e.preventDefault();
            $(this).closest('section').remove();
        });
    }); 


        //    $(function () {

        //     $('#delivery_status1').on('change',function(){
        //     var status = $(this).val();
        //     getUsers(status);              
        //     });

        //      function getUsers(status) {
        //                     $.post('<?php echo base_url('admin/delivery/delivery_list/getUsers') ?>',
        //                         {status},function(data){
        //                            console.log(status);

        //                             // $.toast({   
        //                             //         heading: 'Delete Success!',
        //                             //         text: 'Item successfully deleted!',
        //                             //         position: 'top-right',
        //                             //         loaderBg:'#17a2b8',
        //                             //         icon: 'success',
        //                             //         hideAfter: 3500, 
        //                             //         stack: 6
        //                             //       });
                                    
        //                         });
        //                 }
        // });



    function getDeliveryDetails(delivery_id) {
        $.post('<?php echo base_url('admin/delivery/delivery_list/getDeliveryDetails') ?>',
            {delivery_id},function(data){
                data = JSON.parse(data); 
                $.each(data,function(key,value){
                    $.each(value,function(k,v){
                        $('input[name='+k+']').val(v);
                        $('select[name='+k+']').val(v);
                    });
                });
                 $('select').trigger('change');
                
 
            });
    }


                                            // <td value="delivery_warranty">\
                                            // <select disabled id="select2_'+value.id+'" class="inputWarranty">\
                                            //      <option value="N/A">N/A</option>\
                                            //      <option value="1 YEAR">1 YEAR</option>\
                                            //      <option value="2 YEARS">2 YEARS</option>\
                                            //      <option value="3 YEARS">3 YEARS</option>\
                                            //  </select></td>\


    function getDeliveryItemDetails(delivery_id) {
        $.post('<?php echo base_url('admin/delivery/delivery_list/getDeliveryItemDetails') ?>',
            {delivery_id},function(data){
                data = JSON.parse(data);
                var tableCurrentPO = $('#tableCurrentPO tbody');
                    tableCurrentPO.empty();
                 if (data.length > 0 ) {
                        $.each(data,function(key,value){
                            var newTr = '<tr id="'+value.inventory_item_description+'" value="'+value.id+'">\
                                            <td>'+(key+1)+'</td>\
                                            <td value="inventory_id"><textarea disabled class="inputDescription">'+value.inventory_item_description+'</textarea></td>\
                                            <td id="inventory_id" value="'+value.inventory_id+'">'+value.inventory_id+'</td>\
                                            <td value="item_serial_number"><textarea class="inputSerialNumber">'+value.item_serial_number+'</textarea></td>\
                                            <td id="delivery_item_qty" value="'+value.delivery_item_qty+'"><input type="number" disabled class="inputQty" value="'+value.delivery_item_qty+'"></td>\
                                            <td value="delivery_warranty"><input type="text" disabled class="inputWarranty" value="'+value.delivery_warranty+'"></td>\
                                            <td><a class="deleteDelivery" href="#"><i class="fas fa-trash text-danger"></i></a></td>\
                                        </tr>';
                            tableCurrentPO.append(newTr); 
                            // $('#select2_'+value.id).val(value.delivery_warranty);
                        });
                         // $('.select2').trigger('change'); 

                        $('.deleteDelivery').on('click',function(e){
                            e.preventDefault();
                            var tr = $(this).closest('tr');
                            var id = $(this).closest('tr').attr('value');
                            var delivery_id = $('input[name=delivery_id]').val();
                            var description = $(this).closest('tr').attr('id');
                            var inventory_id =  $(this).closest('tr').find('#inventory_id').attr('value');
                            var delivery_item_qty =  $(this).closest('tr').find('#delivery_item_qty').attr('value');


                            swal({   
                                title: "Are you sure?",   
                                text: 'This will be deleted!',   
                                type: "warning",   
                                showCancelButton: true,   
                                confirmButtonColor: "#DD6B55",   
                                confirmButtonText: "Yes, delete it!",   
                                // closeOnConfirm: false ,
                                preConfirm: function() {
                                    deleteDeliveryItem(tr,id,description,inventory_id,delivery_item_qty,delivery_id);
                                }
                            }).then(function(){ 
                            });
                            
                        });

                             $('.inputSerialNumber').on('change',function(){

                                  var delivery_id = $('input[name=delivery_id]').val();
                                  var id = $(this).closest('tr').attr('value');
                                  var value = $(this).val();
                                  var field = $(this).closest('td').attr('value');
                                  var description = $(this).closest('tr').attr('id'); 
                                  updateDeliveryItems(id,field,value,delivery_id,description); 

                              });



                        function updateDeliveryItems(id,field,value,delivery_id,description) {
                            $.post('<?php echo base_url('admin/delivery/delivery_list/updateDeliveryItems') ?>',
                                {id,field,value,delivery_id,description},function(data){ 

                                    if (data>0) {
                                              $.toast({
                                                      heading: 'Update Success!',
                                                      text: field+' successfully updated to '+value,
                                                      position: 'top-right',
                                                      loaderBg:'#17a2b8',
                                                      icon: 'success',
                                                      hideAfter: 3500, 
                                                      stack: 6
                                                    });
                                    } else {
                                        alert('Session Expired');
                                        window.location.href = "../login";
                                        e.preventDefault(); 
                                    }

                                });
                        }


                        function deleteDeliveryItem(tr,id,description,inventory_id,delivery_item_qty,delivery_id) {
                            $.post('<?php echo base_url('admin/delivery/delivery_list/deleteDeliveryItem') ?>',
                                {id,description,inventory_id,delivery_item_qty,delivery_id},function(data){
                                    if (data>0) {
                                            tr.remove();
                                            $.toast({
                                                    heading: 'Delete Success!',
                                                    text: 'Item successfully deleted!',
                                                    position: 'top-right',
                                                    loaderBg:'#17a2b8',
                                                    icon: 'success',
                                                    hideAfter: 3500, 
                                                    stack: 6
                                                  });
                                    } else {
                                        alert('Session Expired');
                                        window.location.href = "../login";
                                        e.preventDefault(); 
                                    }
                                });
                        }
                    

                        
                      
                    } else {
                        // tableCurrentPO.append('<tr><td colspan="6">Click + below to add</td></tr>');
                    } 
                });
            }


</script>