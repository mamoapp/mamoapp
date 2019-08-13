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
                <div class="col-lg-12 col-md-6">


                    <div class="panel panel-default">
                    <div class="panel-body">

                        <?php if($this->session->userdata('loggedInUser')['permission'] == 'reporter' )
                        { 
                        ?>
                        <blockquote class=""><strong>
                        <?php echo 'Hello, '. $this->session->userdata('loggedInUser')['first_name'];?>
                        <br>I'm giving you the most recent reminders, emergency notifications and ordinance of our barangay.
                        <br>Hope these can help you be safe and updated all the time.
                        <strong></blockquote>
                        <br>
                        <?php
                        } ?>

                        <div class="table-responsive" id="incidentlistsection" style="width:100%;">
                            <table id="table" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><strong>Subject</strong></th>
                                        <th><strong>Message</strong></th>
                                        <th><strong>Date</strong></th>
                                        <?php if($this->session->userdata('loggedInUser')['permission'] == 'admin' )
                                        { 
                                        ?>
                                        <th><strong></strong></th>
                                        <?php }?>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                    </div>    

                </div>
            </div>    


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
    function refresh(){
        reload_table();        
        setTimeout(function(){
            refresh(); //this will send request again and again;
        }, 5000);
    }

    var table;
    $(document).ready(function() {
        //datatables
        table = $('#table').DataTable({
            "responsive": true,
            "processing": false, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": true,
            "bFilter": false,
            "bInfo" : true,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('NotificationMsgController/list/'); ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //first column
                    "orderable": false, //set not orderable
                },
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },

            ],
            

        });

        refresh();
    });
    function reload_table()
    {       
        table.ajax.reload(null,false);
    }



    function ajax_delete(id)
    {    
        // ajax adding data to database
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : "<?php echo site_url('NotificationMsgController/delete')?>/"+id,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                { 
                    reload_table();
                    $('#form')[0].reset();
                    
                   
                }
                else
                { 
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
              
               
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data'+jqXHR.textResponse);

            }
        });
    }
</script>
	
	
	
		
</body>

</html>
