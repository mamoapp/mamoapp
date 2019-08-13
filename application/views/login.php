<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MaMo</title>

    <!-- Bootstrap Core CSS -->
	
    <link href="<?php echo base_url('bootstrap/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('bootstrap/vendor/metisMenu/metisMenu.min.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('bootstrap/dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('bootstrap/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
				</br>
                <div class="panel panel-default">
                    <div class="panel-heading">						
						<h2 class="text-success"><?php echo $this->session->flashdata('signupSuccess'); ?></h2>
        
						<h4 class="text-success">Please Login</h4>
						
                    </div>
                    <div class="panel-body">
                        
						<fieldset>
						<?php echo form_open("LoginController/loginValidation"); ?>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" >
								<span class="text-danger"><?php echo form_error('username'); ?></span>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" >
								<span class="text-danger"><?php echo form_error('password'); ?></span>
						  
							</div>
							<span class="text-danger"><?php echo $this->session->flashdata('error'); ?></span>
							<!--<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" >Remember Me
								</label>
							</div>-->
							<!-- Change this to a button or input when using this as a form -->
							<!-- <a href="dashboard.php" class="btn btn-lg btn-success btn-block">Login</a>-->
							<button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
							
						<?php echo form_close();?>
							
							
							
						<!--
							Don't have an account?								
							
                            <button class="btn btn-link" title="Sign-up" onclick="show_signup()">
								Sign-up
							</button>

						-->
							
							
							
						</fieldset>
                        
                    </div>
                </div>
            </div>
			
			
			
	
                            
   
			
			
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('bootstrap/vendor/jquery/jquery.min.js');?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('bootstrap/vendor/bootstrap/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('bootstrap/vendor/metisMenu/metisMenu.min.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('bootstrap/dist/js/sb-admin-2.js');?>"></script>
	
		
<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

	$('select').on('change', function() {
	
		if(this.value == '9'){// Faculty
			$('#year_level_section').fadeOut('slow');
			$('#course_section').fadeOut('slow');
		}else{
			$('#year_level_section').fadeIn('slow');
			$('#course_section').fadeIn('slow');
		}
	})
});



function show_signup()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Sign up'); // Set Title to Bootstrap modal title

}


function sign_up()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('Participant/ajax_add')?>";


    // ajax adding data to database
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
			
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
			

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data'+jqXHR.responseText);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
</script>


	<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Signup Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
					<fieldset>					
						<div class="form-group">
							<label class="control-label col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input name="first_name" placeholder="First Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input name="last_name" placeholder="Last Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
						</div>								
						<div class="form-group">
							<label class="control-label col-md-3">Username</label>
                            <div class="col-md-9">
                                <input name="signup_username" placeholder="Username" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input name="signup_password" placeholder="Password" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
						</div>	
						<div class="form-group">
							<label class="control-label col-md-3">Confirm Password</label>
                            <div class="col-md-9">
                                <input name="signup_confirm_password" placeholder="Confirm Password" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
						</div>	
											
						<div class="form-group">
							<label class="control-label col-md-3">Type of User</label>
                            <div class="col-md-9">                           
								<select id="typeofuserid" name="user_type" class="form-control" style="width:50%">
									<!-- <option value="" label="Select Type of User" disabled selected></option> -->
									<?php
									foreach($user_type_look_up as $user_type)
									{
										?>
										<option value="<?php echo $user_type->look_up_id?>"><?php echo $user_type->description?></option>
										<?php
									}
									?>
								</select>
                                <span class="help-block"></span>								
							</div>							
						</div>	
						<div id="year_level_section" class="form-group">
							<label class="control-label col-md-3">Year Level</label>
                            <div class="col-md-9">                           
								<select name="year_level" class="form-control" style="width:50%">
									<option value="" label="Select Year Level" disabled selected></option>
									<?php
									foreach($year_level_look_up as $year_level)
									{
										?>
										<option value="<?php echo $year_level->look_up_id?>"><?php echo $year_level->description?></option>
										<?php
									}
									?>
								</select>
                                <span class="help-block"></span>								
							</div>							
						</div>	
						<div id="course_section" class="form-group">
							<label class="control-label col-md-3">Course</label>
                            <div class="col-md-9">
                                <input name="course" class="form-control" placeholder="Course" type="text">
                                <span class="help-block"></span>
                            </div>
						</div>
																	
					</fieldset>
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="sign_up()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->	
	
	
	
	
</body>

</html>
