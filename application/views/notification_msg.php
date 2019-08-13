<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>MaMo</title>
    <?php header('Access-Control-Allow-Origin: *'); ?>

	<script src="<?php echo base_url('bootstrap/jQuey/jquery-3.2.1.min.js');?>" type="text/javascript"></script>
	
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('bootstrap/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('bootstrap/vendor/metisMenu/metisMenu.min.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('bootstrap/dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('bootstrap/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

	
    <!-- DataTables CSS -->
    <link href="<?php echo base_url('bootstrap/vendor/datatables-plugins/dataTables.bootstrap.css');?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url('bootstrap/vendor/datatables-responsive/dataTables.responsive.css');?>" rel="stylesheet">

	
    <link href="<?php echo base_url('bootstrap/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="module" src="https://unpkg.com/x-frame-bypass"></script>

</head>

<body>

    <div id="wrapper">

        <?php include 'navigation.php'; ?>     

        <div id="page-wrapper">
      		<div class="container-fluid">

            <br>
            <div class="row">
                <div class="col-lg-9 col-md-6">

                <div class="">
                    <?php if($this->session->userdata('loggedInUser')['permission'] == 'admin' )
                    { 
                    ?>
                        <form action="#" id="form" class="">  
                        <fieldset >
                            <div class="form-group">   
                                <input name="subject" placeholder="Subject" class="form-control" /> 
                                <span class="text-danger"><?php echo form_error('subject'); ?></span>
                            </div>
                            
                            <div class="form-group">
                                <textarea name="description" class="form-control" placeholder="Compose message" rows="8"></textarea>
                                <span class="text-danger"><?php echo form_error('description'); ?></span>
                            </div>
                            <button type="button" onclick="createNotificationMsg();" class="btn btn-default pull-right">Post</button>
                        </fieldset>
                        </form>

                    
                    <?php }?>
                </div>
                        

                </div>
            </div>
            <br><br><br>
           



		  </div> 
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

 <!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('bootstrap/vendor/bootstrap/js/bootstrap.min.js');?>"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url('bootstrap/vendor/metisMenu/metisMenu.min.js');?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('bootstrap/dist/js/sb-admin-2.js');?>"></script>



<!-- DataTables JavaScript -->
<script src="<?php echo base_url('bootstrap/vendor/datatables/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/vendor/datatables-plugins/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/vendor/datatables-responsive/dataTables.responsive.js');?>"></script>
<script src="<?php echo base_url('bootstrap/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
	
	
<script type="text/javascript">
    
    function createNotificationMsg()
    {    
        // ajax adding data to database
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : "<?php echo site_url('NotificationMsgController/createNotificationMsg/')?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                { 
                    $('#modal_form').modal('show');
                    $('#form')[0].reset();
                }
                else
                { 
                    
                }
              
               

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error adding / update data'+jqXHR.textResponse);

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
                    <h3 class="modal-title">Success</h3>
                </div>

                <div class="modal-body form">
                    Message successfully posted.
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="$('#modal_form').modal('hide');"" class="btn btn-primary" style="float:left;">Close</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->    	
		
</body>

</html>
