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

                <?php if($this->session->userdata('loggedInUser')['permission'] == 'reporter' )
                { 
                ?>
                <form action="#" id="form" class="form-horizontal">  
                    <div class="div-1">
                        <blockquote class=""><strong>
                        <?php echo 'Hi, '. $this->session->userdata('loggedInUser')['first_name'];?>
                        <br>I can help you report concerns/ incidents to maintain peace and order 
                        within our barangay.
                        <br>Just start to notify the barangay authorities.
                        <strong></blockquote>
                        <button type="button" onclick="$('.div-1').hide(1000); $('.div-2').show(1000);" class="btn btn-outline btn-info pull-right">Notify barangay authorities</button>
                    </div>
                
                    <div class="div-2" style="display: none;">
                        <blockquote class=""><strong>
                        <?php echo 'Okay, '. $this->session->userdata('loggedInUser')['first_name'];?>
                        <br>What category does this fall?
                        <select name="category" class="form-control">
                            <option value="Violence" label="Violence" selected></option>
                            <option value="Robbery" label="Robbery"></option>
                            <option value="Accidents" label="Accidents"></option>
                            <option value="Disturbance" label="Disturbance"></option>
                            <option value="Public Gambling" label="Public Gambling"></option>
                            <option value="Fraud" label="Fraud"></option>
                            
                        </select>
                        <strong></blockquote>
                        <button type="button" onclick="$('.div-2').hide(1000); $('.div-3').show(1000);" class="btn btn-outline btn-info pull-right">Continue</button>
                    </div>

                    <div class="div-3" style="display: none;">
                        <blockquote class=""><strong>
                        <br>Please give me a brief description that I will tell the barangay authorities.
                        <strong>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                        </blockquote>
                        <button type="button" onclick="$('.div-3').hide(1000); $('.div-4').show(1000); createIncident();" class="btn btn-outline btn-info pull-right">Send Report</button>
                    </div>

                    <div class="div-4" style="display: none;">
                        <blockquote class=""><strong>
                        <br>Thank you for reporting this. 
                        <br>I will be notifying the barangay authorities. Please standby as of the moment.
                        <strong></blockquote>
                    </div>
                
                </form>
                <?php }?>






                <?php if($this->session->userdata('loggedInUser')['permission'] == 'admin' )
                { 
                ?>
                    <div class="table-responsive" id="incidentlistsection" style="width:100%;">
                        <table id="table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><strong>Sent By</strong></th>
                                    <th><strong>Category</strong></th>
                                    <th><strong>Created Date</strong></th>
                                    <th><strong>Description</strong></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                <?php }?>

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
                "url": "<?php echo site_url('IncidentController/list/'); ?>",
                "type": "POST"
            },

            

        });

        refresh();
    });
    function reload_table()
    {       

        table.ajax.reload(null,false);
    }



    function createIncident()
    {    
        // ajax adding data to database
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : "<?php echo site_url('IncidentController/createIncident/')?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                { 
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
