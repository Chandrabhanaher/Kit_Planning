<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    if (isset($this->session->userdata['logged_in'])) {
         $username = ($this->session->userdata['logged_in']['username']);  
    } else {
        header("location: Login");
    }

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css" rel="stylesheet">


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ATLAS COPCO</title>
        <link rel="shortcut icon" href="<?=base_url()?>/assests/img/logo.png" type="image/png">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> 
        <link href="<?php echo base_url();?>assests/css/main_headers.css" rel="stylesheet" type="text/css"/>     
       
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css" rel="stylesheet">     
    
        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      
        <style type="text/css">
         
            #customers{
              font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
              border-collapse: collapse;
              width: 100%;
              justify-content: center;
            }
            #customers td, #customers th {
              border: 1px solid #ddd;
              padding: 8px;
            }
            #customers tr:nth-child(even){background-color: #f2f2f2;}
            #customers tr:hover {background-color: #ddd;}
            #customers th {
              padding-top: 8px;
              padding-bottom: 8px;   
              text-align: right;
              background-color: #4CAF50;
              color: white;
              text-align: center;
            }
           .highlight td{
              background-color: #a2c4ab;
             }
           #user_data{
              font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            #user_data tr:nth-child(even){background-color: #f2f2f2;}
            #user_data tr:hover {background-color: #ddd;}
            #user_data th{
                  border: 1px solid #ddd;
                  padding: 8px;
                  color: white;
                  background-color: #4CAF50;
            }
            #user_data tr,#user_data td{
                padding: 1px;
                font-size: 12px;
            }
            #customers tr,#customers td{
                padding: 1px;
            }
            #frozens_data tr,#frozens_data td{
                padding: 1px;
                font-size: 12px;
            }
            #frozens_data{
              font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
              border-collapse: collapse;
            }
            #frozens_data tr:nth-child(even){background-color: #f2f2f2;}
            #frozens_data tr:hover {background-color: #ddd;}
            #frozens_data th{
                  border: 1px solid #ddd;
                  padding: 8px;
                  color: white;
                  background-color: #4CAF50;
            } 
            #user_data3{
              font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
              border-collapse: collapse;
            }
            #user_data3 tr:nth-child(even){background-color: #f2f2f2;}
            #user_data3 tr:hover {background-color: #ddd;}
            #user_data3 th{
                  border: 1px solid #ddd;
                  padding: 8px;
                  color: white;
                  background-color: #4CAF50;
            } 
            #user_data3 tr,#user_data3 td{
                padding: 1px;
                font-size: 12px;
            }
            #report_data{
              font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
              border-collapse: collapse;
            }
            #report_data tr:nth-child(even){background-color: #f2f2f2;}
            #report_data tr:hover {background-color: #ddd;}
            #report_data th{
                  border: 1px solid #ddd;
                  padding: 8px;
                  color: white;
                  background-color: #4CAF50;
            } 
            #report_data tr,#report_data td{
                padding: 1px;
                font-size: 12px;
            }
            td.details-control {
                background: url('<?= base_url();?>assests/img/details_open.png') no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.details-control {
                background: url('<?= base_url();?>assests/img/details_close.png') no-repeat center center;
            }
            td.frozens {
                background: url('<?= base_url();?>assests/img/details_open.png') no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.frozens {
                background: url('<?= base_url();?>assests/img/details_close.png') no-repeat center center;
            }
              .right {
                position: absolute;
                right: 15%;
                width: 300px;
                margin-top: 5%;
                border: 3px solid #73AD21;
                padding: 10px;
              }
              #child {
               font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
               border-collapse: collapse;
            }
            #child tr:nth-child(even){background-color: #f2f2f2;}
            #child tr:hover {background-color: #ddd;}
            #child th{
                  border: 1px solid #ddd;
                  padding: 8px;
                  color: white;
                  background-color: #4CAF50;
            }
            #child tr,#child td{
                padding: 1px;
            }
            #report_data{
              font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
              border-collapse: collapse;
            }
            #report_data tr:nth-child(even){background-color: #f2f2f2;}
            #report_data tr:hover {background-color: #ddd;}
            #report_data th{
                  border: 1px solid #ddd;
                  padding: 8px;
                  color: white;
                  background-color: #4CAF50;
            } 
      </style>
      <script type="text/javascript">
        function format ( d ) {            
            var LPROD =  d[6];
                var dataToReturn ='';  
                $.ajax({
                    type:"POST",
                    url:"<?php echo base_url().'secondLevel';?>",
                    dataType: "json",
                    data:{LPROD:LPROD},
                    async: false,
                    success: function (myData) { 
                       var len = myData.length;
                       for(var i=0;i<len;i++){
                           var BOLEVEL = myData[i].BOLEVEL;
                           var BOPARNT = myData[i].BOPARNT;
                           var BOCHILD = myData[i].BOCHILD;
                           var BOQTY = myData[i].BOQTY;
                       
                      
                           dataToReturn +='<tr>'+                                 
                                   '<td style="border: 1px solid black">'+BOLEVEL+'</td>'+
                                   '<td style="border: 1px solid black">'+BOPARNT+'</td>'+
                                   '<td style="border: 1px solid black">'+BOCHILD+'</td>'+
                                   '<td style="border: 1px solid black">'+BOQTY+'</td>'+
                                   '</tr>';
                       }
                      
                    },
                    error: function() {
                        alert('Error occured');
                    }
                });
                 return '<table style="border-collapse: collapse;border: 1px solid black">'+
                        '<thead>'+                             
                           '<th style="border: 1px solid black">BOM Level</th>'+
                             '<th style="border: 1px solid black">BOM PART</th>'+  
                             '<th style="border: 1px solid black">BOM CHILD</th>'+  
                             '<th style="border: 1px solid black">BOM QTY</th>'+  
                        '</thead><tbody>' +
                        dataToReturn+
                     '</tbody></table>';
            
        }
        $(document).ready(function(){  
              var table = $('#user_data3').DataTable({  
                   "processing":true,  
                   "serverSide":true,
                   "order":[],  
                   "ajax":{  
                        url:"<?php echo base_url() . 'all_article_plans'; ?>",  
                        type:"POST"  
                   },  
                   "columnDefs": [
                   {
                      "class"       :'details-control',
                      "targets"     :[0], 
                      "orderable"   :false
                      
                   },
                   { "data": "SEQ_NO"}
                 ],                 
              });
              $('#user_data3 tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                  // This row is already open - close it
                  row.child.hide();
                  tr.removeClass('shown');
                }
                else {
                  // Open this row
                  row.child( format(row.data()) ).show();
                  tr.addClass('shown');
                }
            });
//          Frozon Table
            var dataTable = $('#user_data').DataTable({  
                    "processing":true,  
                    "serverSide":true,  
                    "order":[],  
                    "ajax":{  
                        url:"<?php echo base_url() . 'all_plans'; ?>",  
                        type:"POST"  
                    },  
                    "columnDefs":[  
                        {  
                            "class"       :'details-control',
                            "targets"     :[0], 
                            "orderable"   :false 
                        },  
                    ] , 
                });
                $('#user_data tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = dataTable.row( tr );

                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    }else {
                        // Open this row
                        row.child( fozenChiled1(row.data()) ).show();
                        tr.addClass('shown');
                    }
                });
                 function fozenChiled1(d){
                    var a_seq =  d[1];
                    var a_pln =  d[2];
                    var frozenchild ='';
                    var NotDom ='';
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url().'bomLevels';?>",
                        dataType: 'json',
                        data: {seq:a_seq,al_plan:a_pln},
                        async: false,
                        success: function (myData) {                            
                            var len = myData.length;
                            var gg ='';
                            if (!$.trim(myData)){ 
                               NotDom = 'BOM is not available';
                           }else{
                               for(var i=0; i<len;i++){
                                var bo_level = myData[i].bo_level;
                                var bom_parent = myData[i].bom_parent;                               
                                var child = myData[i].child;
                                var bom_desc = myData[i].bom_desc;
                                var bom_child_qty = myData[i].bom_child_qty;
                                var vnders = myData[i].vender;
                                var req_stock = myData[i].req_stock;
                                var stocks = myData[i].stock;
                                var total_stock = myData[i].total_stock;
                                var avl_stock = myData[i].avl_stock;
                              
                                
                                if (avl_stock<=0){
                                    gg = '<p style="color:#FF0000;">'+avl_stock+'</p>';
                                }else{
                                     gg = '<p style="color:#008000;">'+avl_stock+'</p>';
                                }
                                var part_status = myData[i].part_status;
                                 
                                  frozenchild +='<tr>'+                                            
                                             '<td>'+bo_level+'</td>'+
                                             '<td>'+bom_parent+'</td>'+                                        
                                             '<td>'+child+'</td>'+
                                             '<td>'+bom_desc+'</td>'+
                                             '<td>'+bom_child_qty+'</td>'+
                                             '<td>'+vnders+'</td>'+
                                             '<td>'+req_stock+'</td>'+
                                             '<td>'+stocks+'</td>'+
                                             '<td>'+total_stock+'</td>'+
                                             '<td>'+gg+'</td>'+  
                                             '<td>'+part_status+'</td>'+
                                            '</tr>';
                            }
                           }                            
                        },
                        error: function (errorThrown) {
                            alert(errorThrown);
                            alert("There is an error with AJAX!");
                        }                        
                        
                    });
                     if(NotDom){
                        return NotDom;
                    }else{
                        return '<table  id ="child" class="table table-border table-hover">'+
                        '<thead>'+                                                 
                            '<th>BOM Level</th>'+                             
                            '<th>BOM Part</th>'+ 
                            '<th>BOM Child</th>'+ 
                            '<th>BOM Desc</th>'+
                            '<th>BOM Qty</th>'+ 
                            '<th>Supplier Name</th>'+
                            '<th>Req Qty</th>'+
                            '<th>Stock</th>'+
                            '<th>Total Stock</th>'+ 
                            '<th>Avl Qty</th>'+                            
                            '<th>Part Status</th>'+
                        '</thead><tbody>' +
                        frozenchild+
                     '</tbody></table>';
                    }
                }
            
         });
        $(document).ready(function(){
            var dataTable11 =  $('#frozens_data').DataTable({  
                "processing":true,  
                "serverSide":true,  
                "order":[],  
                "ajax":{  
                    url:"<?php echo base_url() . 'frozen_items'; ?>",  
                    type:"POST"  
                },  
                "columnDefs":[  
                    {  
                        "class"       :'frozens',
                        "targets"     :[0],               
                        "orderable":false  
                    },  
                ] , 
              });
           $('#frozens_data tbody').on('click', 'td.frozens', function () {
                var tr = $(this).closest('tr');
                var row = dataTable11.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }else {
                    // Open this row
                    row.child( fozen1(row.data()) ).show();
                    tr.addClass('shown');
                   }
            });

            function fozen1(d){
                var a_seq =  d[1];
                var a_pln =  d[2];
                var frozenchild ='';
                var NotDom ='';
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url().'bomLevels';?>",
                    dataType: 'json',
                    data: {seq:a_seq,al_plan:a_pln},
                    async: false,
                    success: function (myData) {                            
                        var len = myData.length;
                        var gg ='';
                        if (!$.trim(myData)){ 
                            NotDom = 'BOM is not available';
                        }else{
                            for(var i=0; i<len;i++){
                                var bo_level = myData[i].bo_level;
                                var bom_parent = myData[i].bom_parent;                               
                                var child = myData[i].child;
                                var bom_desc = myData[i].bom_desc;
                                var bom_child_qty = myData[i].bom_child_qty;
                                var vnders = myData[i].vender;
                                var req_stock = myData[i].req_stock;
                                var stocks = myData[i].stock;
                                var total_stock = myData[i].total_stock;
                                var avl_stock = myData[i].avl_stock;                        

                                if (avl_stock <= 0){
                                    gg = '<p style="color:#FF0000;">'+avl_stock+'</p>';
                                }else{
                                    gg = '<p style="color:#008000;">'+avl_stock+'</p>';
                                }
                                var part_status = myData[i].part_status;

                                frozenchild +='<tr>'+                                            
                                    '<td>'+bo_level+'</td>'+
                                    '<td>'+bom_parent+'</td>'+                                        
                                    '<td>'+child+'</td>'+
                                    '<td>'+bom_desc+'</td>'+
                                    '<td>'+bom_child_qty+'</td>'+
                                    '<td>'+vnders+'</td>'+
                                    '<td>'+req_stock+'</td>'+
                                    '<td>'+stocks+'</td>'+
                                    '<td>'+total_stock+'</td>'+
                                    '<td>'+gg+'</td>'+ 
                                    '<td>'+part_status+'</td>'+  
                                '</tr>';
                            }
                        }                            
                    },
                    error: function (errorThrown) {
                        alert(errorThrown);
                        alert("There is an error with AJAX!");
                    }         
                });
                if(NotDom){
                    return NotDom;
                }else{
                    return '<table  id ="child" class="table table-border table-hover">'+
                        '<thead>'+                                                 
                            '<th>BOM Level</th>'+                             
                            '<th>BOM Part</th>'+ 
                            '<th>BOM Child</th>'+ 
                            '<th>BOM Desc</th>'+
                            '<th>BOM Qty</th>'+ 
                            '<th>Supplier Name</th>'+
                            '<th>Req Qty</th>'+
                            '<th>Stock</th>'+
                            '<th>Total Stock</th>'+ 
                            '<th>Avl Qty</th>'+ 
                            '<th>Plan Status</th>'+
                        '</thead><tbody>' +
                        frozenchild+
                        '</tbody></table>';
                }
            }

         });
        $(document).on('click', '.export', function(){
            var a_seq = $(this).attr("id"); 
           $.ajax({
                 type: 'POST',
                    url: "<?php echo base_url().'export_frozen';?>",
                    dataType: 'json',
                    data: {seq:a_seq},
                    async: false
            });
        });
        // kit close date wise report =================================
        $(document).ready(function(){
           var report_data = $('#report_data').DataTable({
               "processing":true,  
               "serverSide":true,  
               "order":[],
               "ajax":{  
                   url:"<?php echo base_url() . 'kit_close_rerport'; ?>",  
                   type:"POST"  
               },  
           });
        });
       // ================================================

      </script>
    </head>
    <body>
        <div class="container" id='loadingmessage' style='display:none; text-align: center'>
            <img src='<?=base_url()?>/assests/img/ajax-loader.gif' style="align-content: center;padding-top:18%;"/>
        </div>
      
        <div class="container-fluid">                 
            <!-- Second navbar for sign in -->
            <nav class="navbar navbar-default" style="background-color: #afd9ee">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="<?= base_url();?>assests/img/logo1.png"/>             
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-2">
                  <ul class="nav navbar-nav navbar-right">
                    <li><label style="align-content: center; padding-top: 15px">User ID :<?php echo $username?> </label></li>
                    <li><a href="<?= base_url()?>goToHome_Dash">Home</a></li>
                    <li><a href="<?= base_url()?>Alls_Fronens">Frozen</a></li>  
                    <li><a href="<?= base_url()?>upload_doc1">Upload Files</a></li>  
                    <li>
                        <a class="btn btn-default btn-outline btn-circle" href="<?= base_url()?>logoutMe">Logout</a>
                    </li>                    
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container -->
            </nav><!-- /.navbar -->
       
