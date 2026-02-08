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
                        <h3 class="text-themecolor m-b-0 m-t-0">Change Password</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div id="containerDetails" class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="formSaveDetail" method="POST" class="form-material" action="<?php echo base_url('admin/change_password/updatePassword') ?>">
                                    <div class="row">
                                        <div class="col-6 offset-3 text-center">

                                            
                                            <h3>User Information</h3>
                                            <input type="hidden" name="users_id" value="<?php echo $userdata['users_id'] ?>">
                                             <div class="form-group">
                                                <label for="detail_new_password">Old Password</label>
                                                <input required type="text" name="oldpassword" class="form-control">
                                                 <span class="text-danger hide errorOldPassword">Incorrect Old Password!</span>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="detail_new_password">New Password</label>
                                                <input required type="text" name="new_password" class="form-control">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="detail_confirm_password">Confirm New Password</label>
                                                <input required type="text" name="confirm_password" class="form-control">
                                                <span id='message'></span>
                                            </div>
                                           

                                            <button class="btn btn-success" style="margin-top: 5px"><i class="fas fa-save fa-lg"></i> Save</button>
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
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

<script>

 $('input[name=oldpassword]').on('keyup',function(){
        var oldpassword = $(this).val();
        var users_id = '<?php echo $userdata['users_id']; ?>' ;
        checkIfoldpasswordExist(oldpassword,users_id);
 });

 $('#formSaveDetail').on('submit',function(e){
      if ($('.errorOldPassword').hasClass('hide')) {
            if ($('#message').text() == 'Password match!') {

                        // var users_id = '<?php #echo $userdata['users_id']; ?>' ;
                        // if(users_id != ''){
                            $('#formSaveDetail')[0].submit();
                        // } else {
                        //     // alert('session not exist');
                        //      window.location.href = "../admin/login";
                        //      e.preventDefault();  
                 
                        // }

            }else{ e.preventDefault(); }

        } else { e.preventDefault(); }
            
        
    });



 $('input[name=confirm_password]').on('keyup', function () {
  if ($('input[name=new_password]').val() == $('input[name=confirm_password]').val()) {
    $('#message').html('Password match!').css('color', 'green');
  } else 
    $('#message').html('Passwords dont match!').css('color', 'red');
});

 function checkIfoldpasswordExist(oldpassword,users_id) {
        $.post('<?php echo base_url('admin/change_password/checkIfoldpasswordExist') ?>',
            {oldpassword,users_id},function(data){
                if (data == '0') {
                   $('.errorOldPassword').removeClass('hide');
                } else { 
                    $('.errorOldPassword').addClass('hide');
                }
            });
    }



</script>