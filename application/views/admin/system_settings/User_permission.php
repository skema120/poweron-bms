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
                        <h3 class="text-themecolor m-b-0 m-t-0">User Management</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Set User Permissions</li>
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
                                            <th><b>Account Type</th> 
                                            <th><b>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user_permission as $key => $value): ?>

                                            <?php if ($value['users_account_type'] != 'SuperUser' AND $value['users_account_type'] != 'Administrator'):  ?> 

                                                <tr value="<?php echo $value['permission_id'] ?>"> 
                                                    <td><?php echo $value['users_account_type'] ?></td> 
                                                    <td><button id="viewUserPermission" class="btn btn-success"><i class="mdi mdi-lead-pencil"></i> Edit</button></td>
                                                </tr>

                                            <?php endif ?>
                                            
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
                                <form id="formSaveDetail" method="POST" class="form-material" action="<?php echo base_url('admin/system_settings/user_permission/saveDetail') ?>">
                                    <div class="row">
                                        <div class="col-6 offset-3 text-center">

                                            <h3>Assign Permission</h3>
                                            <input type="hidden" name="permission_id"> 
                                            <div class="form-group">
                                                <label>Account Type:</label> 
                                                <select required class="select2" style="width: 100%" name="users_account_type" >
                                                    <option value="">Select Type</option>
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Accounting">Accounting</option>
                                                    <option value="Purchaser">Purchaser</option>  
                                                    <option value="Admin Staff">Admin Staff</option>
                                                    <option value="IT Analyst">IT Analyst</option>
                                                </select>
                                            </div>  
                                            <div class="form-group hide">
                                                <label style="color: green;">Edit:</label> 
                                                <select required class="select2" style="width: 100%" name="p_edit" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div> 
                                            <div class="form-group hide">
                                                <label style="color: green;">Delete:</label> 
                                                <select required class="select2" style="width: 100%" name="p_delete" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div> 
                                            <div class="form-group">
                                                <label style="color: red;">Supplier Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_supplier" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: red;">Manage Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_manage" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: #CCCC00;">Inventory Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_inventory" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: blue;">Onhand Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_onhand" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: blue;">Delivery Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_delivery" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: #CCCC00;">Purchase Order Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_purchase_order" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: blue;">Distributor Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_distributor" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: blue;">Agency Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_agency" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: red;">System Settings Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_system_settings" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: #CCCC00;">User Permission Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_user_permission" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: #CCCC00;">Change Password Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_change_password" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: #CCCC00;">User List Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_user_list" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="color: #CCCC00;">System Log Tab:</label> 
                                                <select required class="select2" style="width: 100%" name="p_system_log" >
                                                    <option value="Allow">Allow</option>
                                                    <option value="Block">Block</option>  
                                                </select>
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

    $(document).on('click', '#viewUserPermission', function(e) {
           if(!$(e.target).closest('#viewUserPermission').not(this).length){

                var permission_id = $(this).closest('tr').attr('value');

                getUserPermissionDetails(permission_id);

                $('#containerDetails').removeClass('hide')
                $('#containerTable').addClass('hide');
         

               }else{      
                 console.log('Ignore parent event');
               }     
    });


    $('#formSaveDetail').on('submit',function(e){
        // var users_id = '<?php #echo $userdata['users_id']; ?>' ;
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
        $('input[name=permission_id]').removeAttr("value");
        
    });

    function getUserPermissionDetails(permission_id) {
        $.post('<?php echo base_url('admin/system_settings/user_permission/getUserPermissionDetails') ?>',
            {permission_id},function(data){
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


</script>