<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KZ's</title>

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

</head>

<body>

    <div id="wrapper">
        <?php include 'navigation.php'; ?>
        <div id="page-wrapper">

            <!--<div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">SALES</h4>
                </div>
            </div>-->
            <br/>
            <div class="row">    
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Choose payment options to begin order.
                        </div>
                        <div class="panel-body">
                            <form action="#" id="form" class="form-horizontal">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-money fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">Pay Now</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a onclick="payNow()" id="paynowbtnid">
                                            <div class="panel-footer">
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="panel panel-yellow">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-cutlery fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge">Pay Later</div>
                                                </div>
                                            </div>
                                        </div>
                                        <a onclick="payLater()" id="paylaterbtnid">
                                            <div class="panel-footer">
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input name="customer_name" type="text" class="form-control" placeholder="Enter Customer Name">                                 
                                    </div>
                                </div> 
                                <div class="col-lg-4">
                                    <button type="button" onclick="createNewPurchase()" 
                                        id="createNewPurchaseBtnId" class="btn btn-info">Create New Transaction</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                
            </div><!-- .row -->


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

    function payNow(){
        createNewPurchase(true);
    }
    function payLater(){
        createNewPurchase(false);
    }

    function createNewPurchase(payNow)
    {
        var url = "<?php echo site_url('PurchaseController/payNow/')?>";
        if(!payNow) {
            url = "<?php echo site_url('PurchaseController/payLater/')?>";
        }

        $('#paynowbtnid').attr('disabled',true); //set button disable

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
                    window.location.href = "<?php echo base_url('index.php/purchase/'); ?>" +data.id
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#createNewPurchaseBtnId').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data'+jqXHR.textResponse);
                $('#createNewPurchaseBtnId').attr('disabled',false); //set button enable 

            }
        });
    }
</script>	
		
</body>

</html>
