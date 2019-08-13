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

    <style>
        .menu-img{ 
            width: 33%; 
            border:1px; 
            padding:15px;
        }
    </style>
</head>

<body>

    <div id="wrapper">
        <?php include 'navigation.php'; ?>
        <div id="page-wrapper">
            <!--
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">SALES</h4>
                </div>
            </div>
    -->      <br/>
            <div class="row">
                <div class="col-lg-7"> 
                     <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4><b>Click an order</b></h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="#" id="addform" class="form-horizontal">  
                                <input type="hidden" value="<?php echo $parentPurchase->id;?>" name="purchase_id"/> 
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#burgertab" data-toggle="tab"><h4><b>BURGERS 
                                        <img src="<?php echo base_url(); ?>assets/burgericon.png" class="img-fluid" style="width:30px;"  /></b></h4></a>
                                    </li>
                                    <li><a href="#friestab" data-toggle="tab"><h4><h4><b>FRIES
                                        <img src="<?php echo base_url(); ?>assets/friesicon.png" class="img-fluid" style="width:23px;"  /></b></h4></a>
                                    </li>
                                    <li><a href="#drinktab" data-toggle="tab"><h4><h4><b>DRINKS
                                        <img src="<?php echo base_url(); ?>assets/drinksicon.png" class="img-fluid" style="width:23px;"  /></b></h4></a>
                                    </li>
    
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content" style="height:350px;">                                   
                                    <div class="tab-pane fade in active" id="burgertab">
                                        <?php foreach($burgerMenus as $burgerMenu)
                                        {
                                        ?>
                                            <div style="float:left; " class="menu-img">
                                                <a onclick="addOrder(<?php echo $burgerMenu->id; ?>);">
                                                    <img src="<?php echo base_url().$burgerMenu->img_path; ?>" class="img-fluid" style="width:100%;" alt="<?php echo $burgerMenu->product_name;?>"  />
                                                </a>
                                                <input name="qty<?php echo $burgerMenu->id; ?>" type="number" value="1" class="form-control text-center" min="1"  placeholder="qty" style="width:100%; font-size:24px;" >    
                                                                    
                                            </div>
                                        <?php
                                        }
                                        ?>                                            
                                    </div>

                                    <div class="tab-pane fade" id="friestab">
                                        <?php foreach($friesMenus as $friesMenu)
                                        {
                                        ?>
                                            <div style="float:left; " class="menu-img">
                                                <a onclick="addOrder(<?php echo $friesMenu->id; ?>);">
                                                    <img src="<?php echo base_url().$friesMenu->img_path; ?>" class="img-fluid" style="width:100%;" alt="<?php echo $friesMenu->product_name;?>"  />
                                                </a>
                                                <input name="qty<?php echo $friesMenu->id; ?>" type="number" value="1" class="form-control text-center" min="1"  placeholder="qty" style="width:100%; font-size:24px;" >      
                                                                    
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="drinktab">
                                        <?php foreach($drinksMenus as $drinksMenu)
                                        {
                                        ?>
                                            <div style="float:left;" class="menu-img">
                                                <a onclick="addOrder(<?php echo $drinksMenu->id; ?>);">
                                                    <img src="<?php echo base_url().$drinksMenu->img_path; ?>" class="img-fluid" style="width:100%;" alt="<?php echo $drinksMenu->product_name;?>"  />
                                                </a>
                                                <input name="qty<?php echo $drinksMenu->id; ?>" type="number" value="1" class="form-control text-center" min="1"  placeholder="qty" style="width:100%; font-size:24px;" >      
                                                                    
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>




                                </div>
                            </form> 
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>





             
                <div class="col-lg-5"> 
                   <div class="panel panel-warning">
                        <div class="panel-heading">

                            <form action="#" id="addform"  >  
                                <div class="table-responsive" id="ordersection">
                                    <table id="table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><strong><?php echo $parentPurchase->customer_name;?> Order</strong></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                           

                                <div class="table-responsive" id="totalsection">
                                    <table id="table-total" class="table table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h3 style="float:right;"><b>Total:
                                                        <?php
                                                            echo number_format((float) $parentPurchase->total_amount, 2, '.', '');  
                                                        ?>
                                                        </b>
                                                    </h3>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                            </form>    

                            <div class="col-lg-12" id="checkoutsection">
                                <button type="button" class="btn btn-success" onclick="$('#modal_form').modal('show');">                                    
                                    <p class="fa fa-money"></p> 
                                    Checkout
                                </button>                               
                            </div>
                            <br/><br/>

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
var table;
    $(document).ready(function() {       
        //datatables
        table = $('#table').DataTable({
            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "bPaginate": false,
            "bFilter": false,
            "bInfo" : false,
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('PurchaseDetailController/list/').$parentPurchase->id; ?>",
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


    });
    function reload_table()
    {       

        $("#totalsection").load(location.href + " #totalsection");
        table.ajax.reload(null,false);
    }

    function addOrder(productId)
    {    
        // ajax adding data to database
        var formData = new FormData($('#addform')[0]);
        $.ajax({
            url : "<?php echo site_url('PurchaseDetailController/addOrder')?>/"+productId,
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
                    $('#addform')[0].reset();
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


    function cancelOrder(id)
    {
        if(confirm('Are you sure to cancel this item?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('PurchaseDetailController/cancelOrder')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                { 
                    alert('Error deleting data');
                }
            });

            }
    }

    function doneCheckout(parentId){
        
        var formData = new FormData($('#checkoutform')[0]);
         // ajax delete data to database
         $.ajax({
            url : "<?php echo site_url('PurchaseDetailController/doneCheckout')?>/"+parentId,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');

                $('#checkoutform')[0].reset();

                window.location.href = "<?php echo base_url('index.php/invoice/'); ?>" +data.invoiceId;
            },
            error: function (jqXHR, textStatus, errorThrown)
            { 
                alert('Error  Checkout'+jqXHR.textResponse);
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
                    <h3 class="modal-title">Checkout Order</h3>
                </div>

                <div class="modal-body form">
                    <form action="#" id="checkoutform" class="form-horizontal">
                        <input type="hidden" value="" name="id"/> 
                        <div class="form-body">

                            <div class="form-group">
                                <div class="col-md-6">
                                    <input name="cash_received" placeholder="Cash" class="form-control" type="text">
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="doneCheckout(<?php echo $parentPurchase->id;?>)" class="btn btn-primary" style="float:left;">Done</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->       

</body>

</html>
