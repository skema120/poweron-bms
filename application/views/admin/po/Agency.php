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
                        <h3 class="text-themecolor m-b-0 m-t-0">Agency</h3>
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
                                            <th><b>AGENCY NAME</th> 
                                            <th><b>DATE RECEIVED</th> 
                                            <th><b>PERSON RECEIVED</th>
                                            <th><b>DUE DATE</th> 
                                            <th><b>DELIVERY TERM</th>
                                            <th><b>AMOUNT</th>
                                            <th><b>STATUS</th>
                                            <th><b>REMARKS</th>
                                            <th><b>Action</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($agency as $key => $value): ?>
                                            <tr value="<?php echo $value['agency_id'] ?>"> 
                                                <td><?php echo $value['agency_po_number'] ?></td> 
                                                <td><?php echo $value['agency_name'] ?></td> 
                                                <td><?php echo $value['agency_date_received'] ?></td> 
                                                <td><?php echo $value['agency_person_received'] ?></td>
                                                <td><?php echo $value['agency_due_date'] ?></td> 
                                                <td><?php echo $value['agency_delivery_term'] ?></td> 
                                                <td><?php echo $value['agency_amount'] ?></td> 
                                                <td class="agency_status"><span class="badge px-2 py-1"><?php echo $value['agency_status'] ?></span></td> 
                                                <td><?php echo $value['agency_remarks'] ?></td>
                                                <td><button id="viewAgency" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Edit</button></td> 
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
                                <form id="formSaveDetail" enctype="multipart/form-data" method="POST" class="form-material" action="<?php echo base_url('admin/po/agency/saveDetail') ?>">
                                    <div class="row">
                                        <div class="col-6 offset-3 text-center">

                                            <h3>AGENCY PURCHASE ORDER</h3>
                                            <input type="hidden" name="agency_id">
                                            <div class="form-group">
                                                <label>PO. NUMBER:</label>
                                                <input required type="text" style="color:green;" name="agency_po_number" class="form-control text-center">
                                            </div> 
                                            <div class="form-group">
                                                <label>AGENCY NAME:</label>
                                                 <input onkeyup="this.value = this.value.toUpperCase();" required type="text" name="agency_name" class="form-control text-center">
                                            </div> 
                                            <div class="form-group">
                                                 <label>DATE RECEIVED:</label>
                                                 <div class="input-group">
                                                    <input name="agency_date_received" class="form-control material_date_time text-center" value="" required>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                <label>PERSON RECEIVED:</label>
                                                 <input onkeyup="this.value = this.value.toUpperCase();" required type="text" name="agency_person_received" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                 <label>DUE DATE:</label>
                                                 <div class="input-group">
                                                    <input name="agency_due_date" class="form-control material_date_time text-center" value="" required>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                <label>DELIVERY TERM:</label>
                                                 <input required type="text" name="agency_delivery_term" class="form-control text-center">
                                            </div>
                                             <div class="form-group">
                                                <label>AMOUNT:</label>
                                                 <input required type="number" name="agency_amount" class="form-control text-center">
                                            </div>
                                            <div class="form-group">
                                                <label style="color:red;"><b>STATUS:</b></label> 
                                                <select class="select2" style="width: 100%" name="agency_status" >
                                                    <option value="OPEN">OPEN</option> 
                                                    <option value="PENDING">PENDING</option> 
                                                    <option value="CLOSED">CLOSED</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>REMARKS:</label>
                                                <textarea required type="text" name="agency_remarks" class="form-control"></textarea>
                                            </div>                                                                                     
                                        </div>
                                      </div>


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
                                                  <button type="submit" class="btn btn-success" style="margin-top: 5px"><i class="fa fa-save fa-lg"></i> Save</button>
                                                </div>
                                  <!--   </div> -->
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
    $('.agency_status').css('color','white');  
    $('.badge:contains("OPEN")').addClass('bg-danger');
    $('.badge:contains("CLOSED")').addClass('bg-success');  
    $('.badge:contains("PENDING")').addClass('bg-warning'); 
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
                                             <input id="file" name="agency_file[]" type="file" accept="application/pdf"  onchange="return fileValidation()" />\
                            </section>';
            containerFile.append(newSection);


                    $('.removeSection').on('click',function(e){
                        e.preventDefault();
                        $(this).closest('section').remove();
                    });
         }); 



    // ==============================================================
   // RETRIEVE PO START
    // ==============================================================

    // $('#pageTable tbody').on('click','tr',function(){
    //     var agency_id = $(this).attr('value');
    //     getAgencyDetails(agency_id);
    //     getAgencyFileDetails(agency_id);

    //     $('#containerDetails').removeClass('hide')
    //     $('#containerTable').addClass('hide');
    // });

    $(document).on('click', '#viewAgency', function(e) {
           if(!$(e.target).closest('#viewAgency').not(this).length){

                var agency_id = $(this).closest('tr').attr('value');

                 getAgencyDetails(agency_id);
                 getAgencyFileDetails(agency_id);

                $('#containerDetails').removeClass('hide')
                $('#containerTable').addClass('hide');
         

               }else{      
                 console.log('Ignore parent event');
               }     
    });

function getAgencyDetails(agency_id) {
        $.post('<?php echo base_url('admin/po/agency/getAgencyDetails') ?>',
            {agency_id},function(data){
                data = JSON.parse(data); 
                $.each(data,function(key,value){
                    $.each(value,function(k,v){
                        $('input[name='+k+']').val(v);
                        $('select[name='+k+']').val(v);
                        $('textarea[name='+k+']').val(v);
                    });
                });
                 $('select').trigger('change');
 
            });
    }


         function getAgencyFileDetails(agency_id) {
        $.post('<?php echo base_url('admin/po/agency/getAgencyFileDetails') ?>',
            {agency_id},function(data){
                data = JSON.parse(data);
                var tableCurrentPO = $('#tableCurrentFile tbody');
                    tableCurrentPO.empty();
                 if (data.length > 0 ) {
                        $.each(data,function(key,value){
                            var newTr = '<tr id="'+value.agency_file+'"  value="'+value.id+'">\
                                            <td>'+(key+1)+'</td>\
                                            <td id="agency_file"><input type="text" class="agency_file form-control text-center" value="'+value.agency_file+'" disabled></td>\
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
                            var agency_po_number = $('input[name=agency_po_number]').val();
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
                                    deleteFile(tr,id,agency_po_number,file);
                                }
                            }).then(function(){ 
                            });
                            
                        });

                        

                        $('.downloadFile').on('click',function(e){
                            e.preventDefault();
                            var item = $(this).closest('tr').find('.agency_file').attr('value');

                            var download = '<?php echo base_url() ?>assets/file/pdf/agency/'+item;
                            window.open(download);
                            
                        });


                        function deleteFile(tr,id,agency_po_number,file) {
                            $.post('<?php echo base_url('admin/po/agency/deleteFile') ?>',
                                {id,agency_po_number,file},function(data){
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
                        // tableCurrentPO.append('<tr><td colspan="6">Click + below to add</td></tr>');
                    } 
                });
            }   
    

         // ==============================================================
   // RETRIEVE PO END HERE
    // ==============================================================                

    $('#btnBACK').on('click',function(){
        $('#containerTable').removeClass('hide');
        $('#containerDetails').addClass('hide');
    });


    $('#formSaveDetail').on('submit',function(e){
            $('#formSaveDetail')[0].submit();
            $(this).find(':submit').attr('disabled','disabled');
            e.preventDefault();
    });


    $('#btnAddNewAdmin').on('click',function(){
        $('#containerDetails').removeClass('hide')
        $('#containerTable').addClass('hide');


        $('#formSaveDetail')[0].reset();
        $('select').trigger('change');
        $('input[name=agency_id]').removeAttr("value");

        $('#tableCurrentFile tbody').empty();
        $('.containerFile').empty();
        
        
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
            $('input[name=agency_date_received]').val(today1);


    });


   
</script>