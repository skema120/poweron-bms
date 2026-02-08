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
                        <h3 class="text-themecolor m-b-0 m-t-0">Users</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Users List</li>
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
                                            <th><b>Image</b></th>
                                            <th><b>First Name</b></th> 
                                            <th><b>Last Name</b></th> 
                                            <th><b>User Type</b></th> 
                                            <th><b>Date Created</b></th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $key => $value): ?>

                                            <?php if ($value['users_account_type'] != 'SuperUser'):  ?> 
                                             
                                                    <tr id="<?php echo $value['image'] ?>" value="<?php echo $value['users_id'] ?>"> 
                                                        <td><img src="<?php echo base_url() ?>assets/images/users/<?php echo $value['image'] ?>?>" class="rounded-circle" width="40" /></td> 
                                                        <td><?php echo $value['first_name'] ?></td> 
                                                        <td><?php echo $value['last_name'] ?></td> 
                                                        <td><?php echo $value['users_account_type'] ?></td> 
                                                        <td><?php echo $value['users_date_created'] ?></td> 
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
                                <form id="formSaveDetail"  enctype="multipart/form-data" method="POST" class="form-material" action="<?php echo base_url('admin/users/users_list/saveDetail') ?>">
                                    <div class="row">
                                        <div class="col-6 offset-3 text-center">

                                            <h3>Users Information</h3>
                                                 <input type="hidden" name="users_id"> 
                                                 <input type="hidden" name="users_date_created">
                                                 <input type="hidden" name="image"> 
                                            <div class="form-group">
                                                    <img id="img" src="" class="rounded-circle" width="150" /><br>
                                               
                                                    <i class="btn btn-success btn-rounded text-white font-14  fa fa-camera upload-button"></i> 
                                                    <input class="file-upload" name="file" type="file"  id="file"  accept="image/png, image/jpeg" />

                                                
                                            </div> 
                                            <div class="form-group">
                                                <label>First Name:</label>
                                                <input required type="text" name="first_name" class="form-control text-center">
                                            </div> 
                                            <div class="form-group">
                                                 <label>Last Name:</label>
                                                 <input required type="text" name="last_name" class="form-control text-center">
                                            </div>
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

                                            <div class="form-group">
                                                 <label>Username:</label>
                                                 <input required type="text" name="username" class="form-control text-center">
                                                <span class="text-danger hide errorUsername">Username Already Exist!</span>
                                            </div>

                                            <div class="form-group">
                                                 <label>Password:</label>
                                                 <!-- <input type="text" name="password" class="form-control text-center"> -->
                                                 <input required type="hidden" name="password" id="password" class="form-control hide"><br>
                                                <a href="#" class="btnResetPassword" ><i class="mdi mdi-lock-reset"></i> Reset Password</a>
                                            </div>

                                            <button type="submit" class="btn btn-success" id="save" style="margin-top: 5px"><i class="fa fa-save fa-lg"></i> Save</button>
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
<style>
    .file-upload{
        display:none;
        
    }
</style>

<script>
    $(document).ready(function() {
       
         $(".upload-button").on('click', function() {
           $(".file-upload").click();
        });

    });

$(function(){
      $('#file').change(function(){
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
                 {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                       $('#img').attr('src', e.target.result);
                    }
                   reader.readAsDataURL(input.files[0]);
                }
                else
                {
                  $('#img').attr('src', '<?php echo base_url() ?>assets/images/users/user_default.png');
                }
      });

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

    $('.btnResetPassword').on('click', function(event) {
        event.preventDefault();        
        var password = document.getElementById('password');
        password.value = 'poweron123';
        $('#save').click();
    });

   $('#btnBACK').on('click',function(){
        $('#containerTable').removeClass('hide');
        $('#containerDetails').addClass('hide');
    });


    $('#pageTable tbody').on('click','tr',function(){
        var users_id = $(this).attr('value');        

        getUsersDetails(users_id);
        $('#containerDetails').removeClass('hide')
        $('#containerTable').addClass('hide');

        $('#file').val('');

        var a = $(this).attr('id');        
         $('#img').attr('src', '<?php echo base_url() ?>assets/images/users/' + a);
         $('#img').attr('value', a);

    });


    
    $('#formSaveDetail').on('submit',function(e){
         if ($('.errorUsername').hasClass('hide')) {

                  $('#formSaveDetail')[0].submit();
                  $(this).find(':submit').attr('disabled','disabled');
                  e.preventDefault();

            } else {
            e.preventDefault();
        }
    });
   

    $('#btnAddNewAdmin').on('click',function(){
        $('#containerDetails').removeClass('hide')
        $('#containerTable').addClass('hide');

        $('#formSaveDetail')[0].reset();
        $('#img').removeAttr('src');
        $('#file').val('');
        $('select').trigger('change');
        $('input[name=users_id]').removeAttr("value");
        
    });

    function getUsersDetails(users_id) {
        $.post('<?php echo base_url('admin/users/users_list/getUsersDetails') ?>',
            {users_id},function(data){
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

    $('input[name=username]').on('keyup',function(){
        var username = $('input[name=users_id]').val();

        // if(username ==''){       
            var username = $(this).val();
            checkIfUsernameExist(username);
        // }


    });


    function checkIfUsernameExist(username) {
        $.post('<?php echo base_url('admin/users/users_list/checkIfUsernameExist') ?>',
            {username},function(data){
                if (data == '0') {
                    $('.errorUsername').addClass('hide');
                } else { 
                    $('.errorUsername').removeClass('hide');
                }
            });
    }


</script>