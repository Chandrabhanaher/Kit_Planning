

      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-4">
          <div class="card text-white bg-warning o-hidden h-100">
               <div class="card-body text-center">
                    <div class="clearfix">
                         <i class="fa fa-bar-chart float-right icon-grey-big"></i>
                    </div>
                   <div><h4 id="ssss"></h4></div>
                      
                   <p class="card-text"><b>Total Article Plan This Month</b></p>
                     <div class="progress">
                          <div class="progress-bar-striped active progress-bar progress-bar-success" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                </div>
           </div>
      </div>
      
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-4">
          <div class="card text-white bg-warning o-hidden h-100">
               <div class="card-body text-center">
                    <div class="clearfix">
                         <i class="fa fa-bar-chart float-right icon-grey-big"></i>
                    </div>
                   <div><h4 id="sssss"></h4></div>
                   <p class="card-text"><b>Total Article in Frozen</b></p>
                     <div class="progress">
                          <div class="progress-bar-striped active progress-bar progress-bar-warning" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                </div>
           </div>
      <!--<-- Revenue card ends -->
      </div>
      
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mb-4 bg-secondary">
          <div class="card text-white bg-warning o-hidden h-100">
               <div class="card-body text-center">
                    <div class="clearfix">
                         <i class="fa fa-bar-chart float-right icon-grey-big"></i>
                    </div>
                   <div><h4 id="ssssss"></h4></div>
                   <p class="card-text"><b>Total Article Close</b></p>
                     <div class="progress">
                          <div class="progress-bar-striped active progress-bar progress-bar-danger" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                     </div>
                </div>
           </div>
      </div>
      </div>
      
 </div>
 <div style="padding: 1%;font-family:Verdana;padding-left: 5%"><h1>ATLAS COPCO KITTING PROCESS.</h1></div>
 <div class="container">
     <div class="row">
         <div class="col-sm-6"><div id="line_chart" style="width: 600px; height: 300px;"></div></div>
      
         <div class="col-sm-6"><div id="piechart" style="width: 600px; height: 300px;"></div></div>
     </div>
 </div>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['line']});
            google.charts.setOnLoadCallback(drawChart);
  
            function drawChart() {  
                            $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url();?>charts/getdata',
          
                                    success: function (data1) {
                                    var data = new google.visualization.DataTable();  
                                    data.addColumn('string', 'Production Plan Article Number This Month');
                                    data.addColumn('number', 'No Of Article Plan');        
                                    var jsonData = $.parseJSON(data1);      
                                    for (var i = 0; i < jsonData.length; i++) {
                                          data.addRow([jsonData[i].ARTICLE_NO, parseInt(jsonData[i].QTY)]);
                                    }
                                    var options = {
                                      axes: {
                                        x: {
                                          0: {side: 'bottom'} 
                                        }
                                      }         
                                    };
                                var chart = new google.charts.Line(document.getElementById('line_chart'));
                                chart.draw(data, options);
                                 }
                            });
                        }
       </script>
       
        <script type="text/javascript">
         google.charts.load('current', {'packages':['corechart']});
         google.charts.setOnLoadCallback(drawChart);
          
         function drawChart() {
              $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>charts/getdata_pie_chart',
                success: function (data1) {
                  var data = new google.visualization.DataTable();
                  // Add legends with data type
                  data.addColumn('string', 'Article Number');
                 data.addColumn('number', 'No Of Article Plan');
                 //Parse data into Json
                 var jsonData = $.parseJSON(data1);
                 for (var i = 0; i < jsonData.length; i++) {
                   data.addRow([jsonData[i].name, parseInt(jsonData[i].count)]);
                 }
             var options = {
                    pieSliceText: 'label',
                    title: 'Performance',
               };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
               }
            });
          }
          
            </script>
            
             <script type="text/javascript">
                        $(document).ready(function() {
                            $.ajax({
                                url : "<?php echo base_url();?>Charts/getdata_article_plan",
                                type: "GET",
                                dataType: "JSON",
                                success: function(data)
                                {
                                    if (data[0] === undefined) return;
                                    $('#ssss').text(data[0].a_count);
                                    $('#ssssss').text(data[0].c_count);
                                    $('#sssss').text(data[0].f_count);
                                }
                            });     
                        })
                 </script>
                   
       