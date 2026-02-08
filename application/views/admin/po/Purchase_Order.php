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
                        <h3 class="text-themecolor m-b-0 m-t-0">Distributor</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">List</li>
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
                                            <th><b>PO NUMBER</th> 
                                            <th><b>SUPPLIER</th> 
                                            <th><b>CLASSIFICATION</th> 
                                            <th><b>PAYMENT TERMS</th>
                                            <th><b>AGENCY</th> 
                                            <th><b>STATUS</th>
                                            <th><b>DATE</th>
                                            <th><b>Action</b></th>
                                            <th><b>Created By</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($po as $key => $value): ?>
                                            <tr value="<?php echo $value['po_id'] ?>"> 
                                                <td><?php echo $value['po_number'] ?></td> 
                                                <td><?php echo $value['supplier_name'] ?></td> 
                                                <td><?php echo $value['po_classification'] ?></td> 
                                                <td><?php echo $value['po_payment_terms'] ?></td>
                                                <td><?php echo $value['po_end_user'] ?></td> 
                                                <td class="status"><span class="badge px-2 py-1"><?php echo $value['po_status'] ?></span></td> 
                                                <td><?php echo $value['po_date'] ?></td>
                                                <td><button id="viewDistributor" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Edit</button></td>
                                                <td><?php echo $value['po_created_by'] ?></td> 

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

                                <div class="row">
                                    <div class="col-12">
                                        <button id="btnBACK" class="pull-left btn btn-success"><i class="fa fa-plus"></i> BACK</button>
                                         <br>
                                         <br>
                                         <button id="btnVIEW" class="pull-left hide btn btn-success"><i class="fa fa-search"></i>VIEW</button>
                                    </div>
                                    
                                </div>

                                <form id="formSaveDetail" enctype="multipart/form-data" method="POST" class="form-material" action="<?php echo base_url('admin/po/purchase_order/saveDetail') ?>">
                                    <div class="row">
                                        <div class="col-6 offset-3 text-center">

                                            <h3>PURCHASE ORDER</h3>
                                            <input type="hidden" name="po_id">
                                            <input type="hidden" name="po_date">
                                            <input type="hidden" name="po_created_by">
                                            <div id="po_number" class="form-group">
                                                <label>PO. NUMBER:</label>
                                                <input required type="text" style="color:green;" name="po_number" class="form-control text-center" readonly>
                                            </div> 
                                            <div class="form-group">
                                                <label>SUPPLIER:</label>
                                                <select required class="select2" style="width: 100%" name="supplier_id">
                                                    <option value="">Select Supplier</option>
                                                    <?php foreach ($supplier as $key => $value): ?>
                                                    <option value="<?php echo $value['supplier_id'] ?>">
                                                    <?php echo $value['supplier_name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div> 
                                            <div id="supplier_address" class="form-group">
                                                 <label>ADDRESS:</label>
                                                 <input type="text" name="supplier_address" class="form-control" disabled="true">
                                            </div>
                                            <div class="form-group">
                                                <label>CLASSIFICATION:</label> 
                                                <select required class="select2" style="width: 100%" name="po_classification" >
                                                    <option value="">Select Classification</option>
                                                    <option value="HARDWARE">HARDWARE</option>
                                                    <option value="I.T CONSUMABLES">I.T CONSUMABLES</option>
                                                    <option value="I.T EQUIPMENT">I.T EQUIPMENT</option>  
                                                    <option value="I.T PERIPHERALS">I.T PERIPHERALS</option>
                                                    <option value="I.T ACCESSORIES">I.T ACCESSORIES</option> 
                                                </select>
                                            </div> 
                                            <div class="form-group">
                                                <label>PAYMENT TERMS:</label> 
                                                <select required class="select2" style="width: 100%" name="po_payment_terms" >
                                                    <option value="">Select Type</option>
                                                    <option value="CASH">CASH</option> 
                                                    <option value="CBD">CBD</option> 
                                                </select>
                                            </div>
                                             <div class="form-group">
                                                 <label>AGENCY:</label>
                                                 <input onkeyup="this.value = this.value.toUpperCase();" required type="text" name="po_end_user" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                 <label>DATE:</label>
                                                 <div class="input-group">
                                                    <input id="po_date" name="po_date" class="form-control material_date_time text-center" value="" required>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                 </div>
                                             </div>
                                            <div class="form-group">
                                                <label style="color:red;"><b>STATUS:</b></label> 
                                                <select class="select2" style="width: 100%" name="po_status" >
                                                    <option value="OPEN">OPEN</option> 
                                                    <option value="CLOSED">CLOSED</option>
                                                      <option value="CANCELLED">CANCELLED</option> 
                                                </select>
                                            </div>

                                        </div>
                                      </div>

                                            <!--  <div class="form-group">
                                                 <label>Document:</label>
                                                 <div class="input-group">
                                                    <input type="file" id="po_file" name="po_file" />
                                                    <input type="button" class="button" value="Upload" id="but_upload">
                                                 </div>
                                             </div> -->


                                             <div class="col-13 offset-0 text-center">
                                                    <div class="containerAddFile">
                                                        <table id="tableCurrentFile" class="table stylish-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="color:darkblue">Item<br>No.</th>
                                                                        <th style="color:darkblue">File</th>
                                                                        <th style="color:darkblue">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                            <section  class="containerFile" >
                                                                 
                                                            </section>
                                                                
                                                            <div class="text-center">
                                                                <a id="addFile" href="#"><i class="fas fa-plus-circle"></i></a>
                                                            </div>
                                                    </div>
                                              <!--   </div> -->
                                         


                                      
                                               <!-- <div id="divElement" class="col-13 offset-0 text-center"> -->
                                                    <div class="containerAddPO">
                                                        <table id="tableCurrentPO" class="table stylish-table table-responsive">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="color:darkblue">Item No.</th>
                                                                        <th style="color:darkblue">Unit</th>
                                                                        <th style="color:darkblue">Qty</th>
                                                                        <th style="color:darkblue">Description</th>
                                                                        <th style="color:darkblue">Unit&nbspCost</th>
                                                                        <th style="color:darkblue">Amount</th>
                                                                        <th style="color:darkblue">Action</th>
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
                                              <!--   </div> -->
                                      



                                              <button type="submit" class="btn btn-success" style="margin-top: 5px"><i class="fa fa-save fa-lg"></i> Save</button>
                                        </div>
                                  <!--   </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>






                <div id="popUpModalPrintPO" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"> 
                            <div class="modal-body">  
                                <div class="row" id="PRINTPO">
                                 <!--  <div class="c"> -->
                                        <img  class="image" style="height:100px; width:100%;" src="<?php echo base_url() ?>/assets/images/purchase-order-header.png" alt="user" /> 
                                  <!-- </div> --> 
                                  <div style="width:100%;" class="c"></div>            
                                  <div class="txtcenter"><h3 class="txt1"><u>PURCHASE ORDER</u></h3></div>                     
                                    <table id="tableHeaderMODALPO" class="head" width="100%">
                                             <thead>
                                              
                                             </thead>
                                            <tbody>

                                            </tbody>
                                    </table>
                                      <br>
                                    <table id="tableMODALPO" width="100%">
                                           <thead>
                                            <tr>
                                                  <th width="7.2%" class="wborder txt txtcenter"><b>Item No.</b></th>
                                                  <th width="12.4%" class="wborder txt txtcenter"><b>Unit</b></th>
                                                  <th width="8%" class="wborder txt txtcenter"><b>Qty</b></th>
                                                  <th width="39.5%" class="wborder txt"><b>Description</b></th>
                                                  <th width="16.5%" class="wborder txt txtcenter"><b>Unit&nbspCost</b></th>
                                                  <th width="16.4%" class="wborder txt txtcenter"><b>Amount</b></th>
                                              </tr>
                                           </thead>
                                          <tbody>
                                            
                                        
                                          </tbody>

                                          <tfoot>
                                                  <tr>
                                                    <th class="wborder txtcenter"></th>
                                                    <th class="wborder txtcenter"></th>
                                                    <th class="wborder txtcenter"></th>
                                                    <th class="wborder txt txtcenter"><b>TOTAL:</b></th>
                                                    <th class="wborder txtcenter"></th>
                                                    <th class="wborder txt txtcenter"><b><span id="sum"></span></b></th>
                                                  </tr>
                                          </tfoot>
                                  </table>
                                  <br>
                                  <br>
                                  <br>
                                  <div class="resultContainer">
                                      <div class="wrapper">
                                        <span class="bookTitle txt">
                                                <b>Purchaser:</b><span class="bookPrice4 ">PENKY C. ARANETA</span><br/>
                                        </span>
                                      </div>
                                 
                                   <br>
                                   <br>
                             
                                      <div class="wrapper">
                                        <span class="bookTitle txt">
                                                <b>Checked and Verified:</b><span class="bookPrice1">ROSELYN A. COMANDANTE</span><br/>
                                                <span class="bookPrice">
                                                    Accounting
                                                </span>
                                        </span>
                                      </div>
                                 
                                   <br>
                                   <br>
                                 
                                      <div class="wrapper">
                                        <span class="bookTitle txt">
                                                <b>Recommending Approval:</b><span class="bookPrice2">VERA MAE C. MUÑOZ</span><br/>
                                                <span class="bookPrice_1">
                                                    Managing Partner/Co-Owner
                                                </span>
                                        </span>
                                      </div>
                                   
                                  <br>
                                  <br>

                                      <div class="wrapper">
                                        <span class="bookTitle txt">
                                                <b>Approved by:</b><span class="bookPrice3">FRANCIS GIOVANNI C. RIVERA</span><br/>
                                                <span class="bookPrice">
                                                    Co-Owner
                                                </span>
                                        </span>
                                      </div>
                                   </div>




                                <!--  ========================================================================= -->   
                                </div> 
                                <br>
                                <div class="col-12">
                                        <button id="btnPRINT"  class="pull-left btn btn-info"><i class="fa fa-print"></i> PRINT</button>
                                    </div>
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
<style>
#divElement{
/*    margin-top: -10px;*/
    margin-left: -265px;
    width: 210%;
}

.textareadescription{
  height: 150px;  
}

.inputUnitCost {
     width: 90%;
}

.inputUnit, .inputQty{
  width: 60%;
}

.wborder{
  border:1px solid black;
}

.txtcenter{
  text-align: center;
  color: black;
  margin:  0 auto;
}
.txt{
  color: black;
  font-family: Calibri, sans-serif;
}
.txt1{
  color: black;
  font-family: Arial Rounded Bold, Arial,sans-serif;
}


.image {
  display: block;
  margin-left: auto;
  margin-right: auto;
}


.resultContainer {
 
  width: 100%;
  position: relative;
  left: 0;
  margin-top: 30px;
  margin-bottom: 20px;
  padding: 10px;
}

.wrapper {
  display: flex;
  align-self: center;
}

.bookTitle {
  margin-left: 20px;
}
.bookPrice1 {
  margin-left: 120px;
}
.bookPrice2 {
  margin-left: 106px;;
}
.bookPrice3 {
  margin-left: 160px;
}
.bookPrice4 {
  margin-left: 215px;
}
.bookPrice {
  margin-left: 300px;
}
.bookPrice_1 {
  margin-left: 250px;
}

div.c {
border-bottom: 3px double #333;
/*padding: 10px 0;*/
/*margin-bottom: 10px;*/
}
.head{
  margin-bottom: 20px;
}
</style>


<script>

$('.table').each(function() {
    $('.status').css('color','white');  
    $('.badge:contains("OPEN")').addClass('bg-danger');
    $('.badge:contains("CLOSED")').addClass('bg-success');  
    $('.badge:contains("CANCELLED")').addClass('bg-warning'); 
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
     // ==============================================================
   // AUTO TOTAL
    // ==============================================================
     (function() {
    $("#tableCurrentPO").on("keyup", "input", function() {
      var row = $(this).closest("tr");
      var qty = parseFloat(row.find(".inputQty").val());
      var price = parseFloat(row.find(".inputUnitCost").val());
      var total = qty * price;
      row.find(".total").val(isNaN(total) ? "" : total.toFixed(2));


    });
  })();

   (function() {
    $(".containerPO").on("keyup", "input", function() {
      var row = $(this).closest("section");
      var qty = parseFloat(row.find(".qty").val());
      var price = parseFloat(row.find(".unitcost").val());
      var total = qty * price;
      row.find(".total").val(isNaN(total) ? "" : total.toFixed(2));


    });
  })();


 // // ==============================================================
 //   // CALENDAR
 //    // ==============================================================
 //     $(function () {
 //            $('.mydatetimepicker').datepicker({
 //            format: "mm-yyyy",
 //            viewMode: "years", 
 //            minViewMode: "months"   
 //            });
 //        });
 //        $(function () {
 //            $('.mydatetimepickerFull').datepicker({
 //            format: "yyyy-mm-dd"   
 //            });
 //        });


function fileValidation() {
            var fileInput = 
                document.getElementById('file');
              
            var filePath = fileInput.value;
          
            // Allowing file type
            // var allowedExtensions = 
            //         /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            var allowedExtensions = 
                    /(\.pdf)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            } 
        }

         // ==============================================================
   // ADD TAB ITEM
    // ==============================================================
    $('#addFile').on('click',function(e){
            e.preventDefault();
            var containerFile = $('.containerFile');
            var newSection = '<section>\
                                <div class="text-center" >\
                                    <a class="removeSection" href="#"><i class="fas text-danger fa-minus-circle"></i></a>\
                                </div>\
                                             <h4><u>File</u></h4>\
                                             <input id="file" name="file[]" type="file" accept="application/pdf"  onchange="return fileValidation()" />\
                            </section>';
            containerFile.append(newSection);


                    $('.removeSection').on('click',function(e){
                        e.preventDefault();
                        $(this).closest('section').remove();
                    });
         }); 

           $('#addPO').on('click',function(e){
        e.preventDefault();
        var containerPO = $('.containerPO');
       var newSection = '<section>\
                            <div class="text-center" >\
                                <a class="removeSection" href="#"><i class="fas text-danger fa-minus-circle"></i></a>\
                            </div>\
                            <h5 >Description</h5> \
                            <textarea required name="description[]" class="form-control" placeholder="Description"></textarea>\
                            <div class="row m-t-20 ">\
                                <div class="col-3">\
                                     <div class="form-group">\
                                         <h4><u>Unit</u></h4>\
                                         <input type="text" name="unit[]" class="form-control text-center" placeholder="Unit">\
                                     </div>\
                                </div>\
                                <div class="col-3">\
                                     <div class="form-group">\
                                         <h4><u>Qty</u></h4>\
                                         <input type="number" name="qty[]" class="qty form-control text-center" placeholder="Qty">\
                                     </div>\
                                </div>\
                                <div class="col-3">\
                                     <div class="form-group">\
                                         <h4><u>Unit Cost</u></h4>\
                                         <input type="number" step="any" name="unit_cost[]" class="unitcost form-control text-center" placeholder="Unit Cost">\
                                     </div>\
                                </div>\
                                 <div class="col-3">\
                                     <div class="form-group">\
                                         <h4><u>Amount</u></h4>\
                                          <input type="text" style="color:red;" class="total form-control text-center" placeholder="total" readonly>\
                                     </div>\
                                </div>  \
                            </div> \
                        </section>';
        containerPO.append(newSection);


        $('.removeSection').on('click',function(e){
            e.preventDefault();
            $(this).closest('section').remove();
        });
    }); 



    // ==============================================================
   // RETRIEVE PO START
    // ==============================================================

    // $('#pageTable tbody').on('click','tr',function(){
    //     var po_id = $(this).attr('value');
    //     getPODetails(po_id);
    //     getDetailFromPOitems(po_id);
    //     getPOFileDetails(po_id);

    //     $('#btnVIEW').removeClass('hide');
    //     $('#containerDetails').removeClass('hide')
    //     $('#containerTable').addClass('hide');
    // });

     $(document).on('click', '#viewDistributor', function(e) {
           if(!$(e.target).closest('#viewDistributor').not(this).length){

                var po_id = $(this).closest('tr').attr('value');

                 getPODetails(po_id);
                 getDetailFromPOitems(po_id);
                 getPOFileDetails(po_id);

                 $('#btnVIEW').removeClass('hide');
                $('#containerDetails').removeClass('hide')
                $('#containerTable').addClass('hide');

                $('#po_number').removeClass('hide');
                $('#supplier_address').addClass('hide');
         

               }else{      
                 console.log('Ignore parent event');
               }     
    });

function getPODetails(po_id) {
        $.post('<?php echo base_url('admin/po/purchase_order/getPODetails') ?>',
            {po_id},function(data){
                data = JSON.parse(data); 
                $.each(data,function(key,value){
                    $.each(value,function(k,v){
                        $('input[name='+k+']').val(v);
                        $('select[name='+k+']').val(v);
                        $('textarea[name='+k+']').val(v);
                    });
                });
                 $('select').trigger('change');
                 $('input[name=po_number]').prop('readonly',true);
 
            });
    }


         function getPOFileDetails(po_id) {
        $.post('<?php echo base_url('admin/po/purchase_order/getPOFileDetails') ?>',
            {po_id},function(data){
                data = JSON.parse(data);
                var tableCurrentPO = $('#tableCurrentFile tbody');
                    tableCurrentPO.empty();
                 if (data.length > 0 ) {
                        $.each(data,function(key,value){
                            var newTr = '<tr id="'+value.file+'" value="'+value.id+'">\
                                            <td>'+(key+1)+'</td>\
                                            <td value=""><input type="text" class="agency_file form-control text-center" value="'+value.file+'" disabled></td>\
                                            <td>\
                                            <a class="deleteFile" href="#"><i class="fas fa-trash text-danger"></i></a>\
                                            &nbsp&nbsp&nbsp\
                                            <a class="downloadFile" href="#"><i class="fas fa-download text-success"></i></a>\
                                            </td>\
                                        </tr>';
                            tableCurrentPO.append(newTr); 
                            // $('#input_'+value.id).val(value.serial_number);
                        });

                        $('.deleteFile').on('click',function(e){
                            e.preventDefault();
                            var po_number = $('input[name=po_number]').val();
                            var tr = $(this).closest('tr');
                            var id = $(this).closest('tr').attr('value');
                            var file = $(this).closest('tr').attr('id');
                            swal({   
                                title: "Are you sure?",   
                                text: 'This will be deleted!',   
                                type: "warning",   
                                showCancelButton: true,   
                                confirmButtonColor: "#DD6B55",   
                                confirmButtonText: "Yes, delete it!",   
                                // closeOnConfirm: false ,
                                preConfirm: function() {
                                    deleteFile(tr,id,po_number,file);
                                }
                            }).then(function(){ 
                            });
                            
                        });

                         $('.downloadFile').on('click',function(e){
                            e.preventDefault();
                            var item = $(this).closest('tr').find('.agency_file').attr('value');

                            var download = '<?php echo base_url() ?>assets/file/pdf/distributor/'+item;
                            window.open(download);
     
                        });


                        function deleteFile(tr,id,po_number,file) {
                            $.post('<?php echo base_url('admin/po/purchase_order/deleteFile') ?>',
                                {id,po_number,file},function(data){
                                    if (data>0) {
                                            tr.remove();
                                            $.toast({
                                                    heading: 'Delete Success!',
                                                    text: 'File successfully deleted!',
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
                        tableCurrentPO.append('<tr><td colspan="6">Click + below to add</td></tr>');
                    } 
                });
            }

function getDetailFromPOitems(po_id) {
        $.post('<?php echo base_url('admin/po/purchase_order/getDetailFromPOitems') ?>',
            {po_id},function(data){
                data = JSON.parse(data);
                var tableCurrentPO = $('#tableCurrentPO tbody');
                    tableCurrentPO.empty();
                 if (data.length > 0 ) {
                        $.each(data,function(key,value){
                            var total = value.unit_cost*value.qty;
                            var newTr = '<tr id="'+value.description+'" value="'+value.id+'">\
                                            <td>'+(key+1)+'</td>\
                                            <td value="unit"><input type="text" class="inputUnit form-control" value="'+value.unit+'" placeholder="Unit"></td>\
                                            <td value="qty"><input type="number" name="inputQty" class="inputQty form-control" value="'+value.qty+'" placeholder="Qty"></td>\
                                            <td value="description"><textarea class="textareadescription" placeholder="Description">'+value.description+'</textarea></td>\
                                            <td value="unit_cost"><input type="number" step="any" id="input_'+value.id+'" name="inputUnitCost" class="inputUnitCost form-control" value="'+value.unit_cost+'"></td>\
                                            <td value="total"><input type="number" lang="en-150" style="color:red;" class="total form-control" value="'+total.toFixed(2)+'" readonly></td>\
                                            <td><a class="deletePO" href="#"><i class="fas fa-trash text-danger"></i></a></td>\
                                        </tr>';
                            tableCurrentPO.append(newTr); 
                            $('#input_'+value.id).val(value.unit_cost);
                        });

                        $('.deletePO').on('click',function(e){
                            e.preventDefault();
                            var tr = $(this).closest('tr');
                            var id = $(this).closest('tr').attr('value');
                            var description = $(this).closest('tr').attr('id');
                            var po_number = $('input[name=po_number]').val();
                            swal({   
                                title: "Are you sure?",   
                                text: 'This will be deleted!',   
                                type: "warning",   
                                showCancelButton: true,   
                                confirmButtonColor: "#DD6B55",   
                                confirmButtonText: "Yes, delete it!",   
                                // closeOnConfirm: false ,
                                preConfirm: function() {
                                    deletePO(tr,id,description,po_number);
                                }
                            }).then(function(){ 
                            });
                            
                        });

                         $('.textareadescription,.inputUnit,.inputQty,.inputUnitCost').on('change',function(){
                            var id = $(this).closest('tr').attr('value');
                            var value = $(this).val();
                            var field = $(this).closest('td').attr('value'); 
                            var po_number = $('input[name=po_number]').val();
                            updatePurchaseOrderItems(id,field,value,po_number); 
                        });


                        function updatePurchaseOrderItems(id,field,value,po_number) {
                            $.post('<?php echo base_url('admin/po/purchase_order/updatePurchaseOrderItems') ?>',
                                {id,field,value,po_number},function(data){ 

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


                        function deletePO(tr,id,description,po_number) {
                            $.post('<?php echo base_url('admin/po/purchase_order/deletePO') ?>',
                                {id,description,po_number},function(data){

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
                        tableCurrentPO.append('<tr><td colspan="6">Click + below to add</td></tr>');
                    } 
                });
            }


function getDetailFromPOitems_Print(po_id) {
        $.post('<?php echo base_url('admin/po/purchase_order/getDetailFromPOitems_Print') ?>',
            {po_id},function(data){
                data = JSON.parse(data);
                var tableMODALPO = $('#tableMODALPO tbody');
                    tableMODALPO.empty();
                 if (data.length > 0 ) {
                        $.each(data,function(key,value){
                            var total = value.unit_cost*value.qty;
                            var newTr = '<tr>\
                                            <td class="wborder txt txtcenter">'+(key+1)+'</td>\
                                            <td class="wborder txt txtcenter">'+value.unit+'</td>\
                                            \
                                            <td class="wborder txt txtcenter">'+value.qty+'</td>\
                                            \
                                            <td class="wborder txt">'+value.description+'</td>\
                                            \
                                            <td class="unit_cost wborder txt txtcenter">'+value.unit_cost+'</td>\
                                            \
                                            <td class="total wborder txt txtcenter">'+total.toFixed(2)+'</td>\
                                        </tr>';
                                       
                            tableMODALPO.append(newTr); 
                            $('#input_'+value.id).val(value.unit_cost);
                        });
                    
                        $('.unit_cost, .total').formatNumber({
                                    cents: '.',
                                    decimal: ','
                                  });
                        
                      
                    } else {
                        // tableMODALPO.append('<tr><td colspan="6">Click + below to add</td></tr>');
                    } 
                });
            }


    function getPrintPODetails(po_id) {
        $.post('<?php echo base_url('admin/po/purchase_order/getPrintPODetails') ?>',
            {po_id},function(data){
                data = JSON.parse(data);
                var tableHeaderMODALPO = $('#tableHeaderMODALPO tbody');
                    tableHeaderMODALPO.empty();
                 if (data.length > 0 ) {
                        $.each(data,function(key,value){
                            var newTr = '<tr>\
                                            <td width="62.8%" class="wborder txt"><b>SUPPLIER:</b> '+value.supplier_name+'</td>\
                                            <td width="37.1%" class="wborder txt"><b>PO. NUMBER:</b> '+value.po_number+'</td>\
                                        </tr>\
                                        <tr>\
                                            <td width="62.8%" class="wborder txt"><b>ADDRESS:</b> '+value.supplier_address+'</td>\
                                            <td width="37.1%" class="wborder txt"><b>DATE:</b> '+value.po_date+'</td>\
                                        </tr>\
                                        <tr>\
                                            <td colspan="2" class="wborder txt"><b>CLASSIFICATION:</b> '+value.po_classification+'</td>\
                                        </tr>\
                                        <tr>\
                                            <td colspan="2" class="wborder txt"><b>PAYMENT TERMS:</b> '+value.po_payment_terms+'</td>\
                                        </tr>\
                                        <tr>\
                                            <td colspan="2" class="wborder txt"><b>AGENCY:</b> '+value.po_end_user+'</td>\
                                        </tr>';
                            tableHeaderMODALPO.append(newTr); 
                        });
                    

                        
                      
                    } else {
                        // tableHeaderMODALPO.append('<tr><td colspan="6">Click + below to add</td></tr>');
                    } 
                });
            }        
    

         // ==============================================================
   // RETRIEVE PO END HERE
    // ==============================================================                

    $('#btnBACK').on('click',function(){
        $('#containerTable').removeClass('hide');
        $('#containerDetails').addClass('hide');
        $('input[name=po_date]').prop('disabled',false);
    });


    $('#formSaveDetail').on('submit',function(e){
            $('#formSaveDetail')[0].submit();
            $(this).find(':submit').attr('disabled','disabled');
            e.preventDefault();
    });



    $('#btnAddNewAdmin').on('click',function(){
        $('#containerDetails').removeClass('hide')
        $('#containerTable').addClass('hide');
        $('#btnVIEW').addClass('hide');

        $('#formSaveDetail')[0].reset();
        $('select').trigger('change');
        $('input[name=po_id]').removeAttr("value");

        $('#tableCurrentPO tbody').empty();
        $('#tableCurrentFile tbody').empty();
        $('.containerPO').empty();
        $('.containerFile').empty();

        $('#po_number').addClass('hide');
        $('#supplier_address').addClass('hide');
        
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
            // today = mm+'-'+dd+'-'+yyyy;

            // <?php foreach ($lastpo as $key => $value): ?>
            //          var po_number =  <?php echo $value['po_number'] ?> + 1;
            //  <?php endforeach ?>

            // today = yyyy+'-'+mm+dd+'-'+po_number;
            //  $('input[name=po_number]').val(today);

             var today1 = yyyy+'-'+mm+'-'+dd;
            $('input[name=po_date]').val(today1);
             $('#po_date').prop('disabled',true);             
            


    });


    $('#btnVIEW').click(function(){
      $('#popUpModalPrintPO').modal('show');
     var po_id = $('input[name=po_id]').val();

     getSum_Print(po_id);
     getDetailFromPOitems_Print(po_id);
     getPrintPODetails(po_id);

   
    })




    function getSum_Print(po_id) {
        $.post('<?php echo base_url('admin/po/purchase_order/getSum_Print') ?>',
            {po_id},function(data){
                data = JSON.parse(data); 
                $.each(data,function(key,value){
                    $.each(value,function(k,v){
                        $('#sum').text(v); 
                        // console.log(k)
                    });
                });

                  $('#sum').formatNumber({
                    cents: '.',
                    decimal: ','
                  });
  
            });
    }

    $('#btnPRINT').click(function(){
        var _html = document.getElementById("PRINTPO").innerHTML;
        var htmlToPrint = '' +
        '<style type="text/css">' +
        'table {'+
        'border-collapse: collapse;'+
        '}' +
        'table th, table td {' +
        'border:1px solid #000;' +
        '}' +
        '.txtcenter {' +
        'text-align:center;' +
        '}' +
        '.bookPrice {'+
        'margin-left: 300px;'+
        '}' +
        '.bookPrice_1 {'+
        'margin-left: 250px;'+
        '}' +
        '.bookPrice1 {'+
        'margin-left: 120px;'+
        '}' +
        '.bookPrice2 {'+
        'margin-left: 106px;'+
        '}' +
        '.bookPrice3 {'+
        'margin-left: 160px;'+
        '}' +
        '.bookPrice4 {'+
        'margin-left: 215px;'+
        '}' +
        'div.c {'+
        'border-bottom: 3px double #000;'+
        '}'+
        '.txt{'+
          'color: black;'+
          'font-family: Calibri, sans-serif;'+
        '}'+
        '.txt1{'+
          'color: black;'+
          'font-family: Arial Rounded Bold, Arial,sans-serif;'+
        '}'+
        '</style>';
        htmlToPrint += _html;
        var newWindow = window.open("","_blank","menubar=no,scrollbars=yes,resizable=yes,width=700,height=600");
        newWindow.document.write(htmlToPrint);
        newWindow.document.close();
        newWindow.focus();
        newWindow.print();
        setTimeout(function(){newWindow.close()}, 750);


    })

   
</script>