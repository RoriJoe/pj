<!DOCTYPE html>
<html>
<head>    
    <title><?php echo $judul; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
    <!--CSS AREA-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/plusstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/plusstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chart/xcharts.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chart/css/daterangepicker.css" />

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.8.0.min.js" ></script>
    <script type='text/javascript' src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/loading/pace.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/chart/highcharts.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/chart/highcharts-more.js" ></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dashboard.css" />
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/date.format.js"></script>
</head>

<body>
    <div id="header">
        <?php echo $this->load->view('template/head'); ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row">
                    <div class="span3">
                        <div class="bar-dash filter-bar">
                            <i class="icon-filter"></i> Filter Date Option
                        </div>
                        <div class="well well-small">
                            <div class="btn-group" data-toggle="buttons-radio">
                              <button class="btn btn-small" onclick="change('year')">Year</button>
                              <button class="btn btn-small" onclick="change('custom')">Custom</button>
                              <button class="btn btn-small" id="filter-clear" onclick="change('default')">Default</button>
                            </div>
                            <div class="row-margin">
                                <div id="drop-date" class="pull-left">
                                    <select name="" id="list-date" onchange="filterAll()" disabled>
                                        <option value="">-Select Year-</option>
                                    </select>
                                </div>
                                <!--<div id="btn-filter" class="pull-right">
                                    <button class="btn btn-primary" id="filter-submit" onclick="filterAll()">Filter</button>
                                    <button class="btn" id="filter-clear" onclick="loadChart()">Clear</button>
                                </div>-->
                                <div class="clearfix"></div>
                            </div>

                            
                            <div>
                                <form class="form-horizontal" id="list-date-cus">
                                    <div class="input-prepend">
                                      <span class="add-on"><i class="icon-calendar"></i></span>
                                      <input type="text" class="input-medium" name="range" id="range" disabled/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="span4 offset1">
                        <div class="well well-small">
                            <div class="row-fluid  text-center stat">
                                <div class="span6">
                                    <div id="container" style="width:100%; height:150px;"></div>
                                </div>
                                <div class="span6">
                                    <p>Average Sales Order Value</p>
                                    <p id="val1" class="val-mini"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="well well-small">
                            <div class="row-fluid  text-center stat">
                                <div class="span6">
                                    <div id="container2" style="width:100%; height:150px;"></div>
                                </div>
                                <div class="span6">
                                    <p>Average Qty / Sales Order</p>
                                    <p id="val2" class="val-mini"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="span6">
                <div class="bar-dash">
                    <span>Grafik Penjualan</span> &dash; <span id="filter-stat">Per 30 Hari</span>
                    <a  id="tes" 
                        class="btn pull-right" 
                        tittle="Filter" 
                        data-toggle="button" 
                        data-html="true" 
                        data-placement="bottom"
                        rel="popover"
                        data-content="
                            <select style='width:100%; margin-bottom:10px;' id='select-filters' onchange='filterPenjualan()'>
                              <option value='rev_great'>Revenue Is Greater Than</option>
                              <option value='rev_less'>Revenue Is Less Than</option>
                            </select>
                            <input type='text' id='fieldFilter'  style='width:145px;' placeholder='Rupiah'>
                            <div class='clearfix'></div>
                            <button class='btn btn-mini btn-success' onclick='applyFilter()'>Apply</button>
                            <button class='btn btn-mini' onclick='loadChart()'>Clear</button>
                        ">

                        <i class='icon-filter'></i> Filter
                    </a>
                </div>
                <div id="placeholder" style="margin-bottom:0">
                    <figure id="chart"></figure>
                </div>
                <div class="bar-dash" style="margin-bottom:15px;">
                    <a href="javascript:ajaxLoadFilter('','year')" id="breadYear" style="visibility:hidden">All Year</a>
                    <a href="" id="breadMonth" style="visibility:hidden">> Year</a>
                </div>
            </div>
            <div class="span6">
                <div class="row">
                    <div class="span3">
                        <div id="container3" style="width:100%; height:230px;"></div>
                    </div>
                    <div class="span3">
                        <div id="container4" style="width:100%; height:230px;"></div>
                    </div>
                    <div class="span3">
                        <div id="container5" style="width:100%; height:230px;"></div>
                    </div>
                    <div class="span3">
                        <div id="container6" style="width:100%; height:230px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <?php echo $this->load->view('template/footer'); ?>
    </div>

    <div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 id="myModalLabel">Detail</h3>
        </div>
        <div class="modal-body">
            <div id="list_detail"></div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>

</body>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<!-- xcharts includes -->
<script src="<?php echo base_url();?>assets/js/chart/js/d3.v2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chart/xcharts.min.js"></script>

<!-- The daterange picker bootstrap plugin -->
<script src="<?php echo base_url();?>assets/js/chart/js/sugar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chart/js/daterangepicker.js"></script>

<script>
    jQuery(document).ready(function(){
        loadChart();  
    });

    //CUSTOM FUNCTION//
    $(':not(#anything)').on('click', function (e) {
        $('#tes').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
                return;
            }
        });
    });
    function change(option) {
        var _dateOpt = option;
        var _div = document.getElementById('drop-date');
        var _text = document.getElementById('list-date');
        var _textCus = document.getElementById('list-dateCus');

        if(option == 'year'){ //year selected
            $("#range").attr('disabled',true);
            $("#filter-submit").attr('disabled',false);
            $.ajax({
                type:'POST',
                url: "<?php echo base_url();?>dashboard/date_call",
                data :{option:option},
                dataType: "html",
                success: function(data){
                    $('#drop-date').html(data);
                }
            });
        }else if(option == 'custom'){ //custom selected
            $("#list-date").attr('disabled',true);
            $("#range").attr('disabled',false);
        }else{ //default selected
            $("#range").attr('disabled',true);
            $("#list-date").attr('disabled',true);
            loadChart();
        }
    }
    function filterAll(){
        var myVal = $('#list-date').val();
        var myMode = 'year';

        if(myVal != ''){
            ajaxLoadMonth(myVal);
            loadGauge('','',myVal);
        }else{
            ajaxLoadFilter('','year');
        }
    }
    var pemisah_ribuan = '.';
    function pemisahRibuan(str){
        str = str.toString();   // konversi ke string
        var strleng = str.length;  // panjang string

        var p_sisa = strleng;   // panjang awal
        var arr = new Array;
            // dipisahkan tiap 3 digit
        var status = strleng >= 3 ? true : false;

        while (status){
            p_sisa = p_sisa - 3;
            // ambil 3 nilai terakhir, simpan di array
            arr.push(str.substr(p_sisa, 3));
            if ((p_sisa - 3) < 0) status = false;
        }
            // jika jumlah angka < 3, ambil semua
            if (p_sisa > 0) arr.push(str.substr(0, p_sisa));    
        
            // Gabungkan dengan pemisah ribuan
            return arr.reverse().join(pemisah_ribuan);          
    }
    function getmax(initval){
        var newVal;
        if(initval >= 0 && initval <=100){
            newVal = 100;
        }else if(initval > 100 && initval <= 1000){
            newVal = 1000;
        }else if(initval > 1000 && initval <= 10000){
            newVal = 10000;
        }else if(initval > 10000 && initval <= 100000){
            newVal = 100000;
        }else if(initval > 100000 && initval <= 1000000){
            newVal = 1000000;
        }else if(initval > 1000000 && initval <= 100000000){
            newVal = 100000000;
        }else if(initval > 100000000 && initval <= 1000000000){
            newVal = 1000000000;
        }else if(initval > 1000000000 && initval <= 10000000000){
            newVal = 10000000000;
        }else if(initval > 10000000000 && initval <= 100000000000){
            newVal = 100000000000;
        }else{
            newVal = 100;
        }

        return newVal;
    }
    //END OF CUSTOM FUNCTION//

    //HIGHCHART VARIABLE CHART//
    Highcharts.setOptions({
        credits: {
            enabled: false
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        legend: {
            enabled: false
        }
    });

    var miniColumn = {
        chart: {
            type: 'column',
        },
        title: {
            text: null
        },
        xAxis: {
            labels:
            {
              enabled: false
            }
        },
        yAxis: {
            title: {
                text: ''
            },
            labels:
            {
              enabled: false
            }
        },
        series: [{}]
    }

    var miniColumnSO = {
        chart: {
            type: 'column',
            renderTo: 'container'
        },
        title: {
            text: null
        },
        xAxis: {
            labels:
            {
              enabled: false
            }
        },
        yAxis: {
            title: {
                text: ''
            },
            labels:
            {
              enabled: false
            }
        },
        series: [{}]
    }

    var gaugePemesanan = {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
        },
        
        title: {
            text: 'Outstanding Pemesanan'
        },
        
        pane: {
            startAngle: -120,
            endAngle: 120,
        },
           
        // the value axis
        yAxis: {
            min: 0,
            max: 200,
            
            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',
    
            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',

            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Jumlah'
            },
            plotBands: [{
                from: 0,
                to: 120,
                color: '#55BF3B' // green
            }, {
                from: 120,
                to: 160,
                color: '#DDDF0D' // yellow
            }, {
                from: 160,
                to: 200,
                color: '#DF5353' // red
            }]        
        },

        series: [{}]
    }

    var gaugeTerkirim = {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
        },
        
        title: {
            text: 'Outstanding Terkirim'
        },
        
        pane: {
            startAngle: -120,
            endAngle: 120,
        },
           
        // the value axis
        yAxis: {
            min: 0,
            max: 200,
            
            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',
    
            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',

            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Jumlah'
            },
            plotBands: [{
                from: 0,
                to: 120,
                color: '#55BF3B' // green
            }, {
                from: 120,
                to: 160,
                color: '#DDDF0D' // yellow
            }, {
                from: 160,
                to: 200,
                color: '#DF5353' // red
            }]        
        },

        series: [{}]
    }

    var gaugeInvoice = {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            renderTo: 'container5'
        },
        
        title: {
            text: 'Invoice'
        },
        
        pane: {
            startAngle: -120,
            endAngle: 120,
        },
           
        // the value axis
        yAxis: {
            min: 0,
            max: 0,
            
            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',
    
            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',

            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Rupiah'
            }    
        },

        series: [{}]
    }

    var gaugeTerima = {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            renderTo: 'container6'
        },
        
        title: {
            text: 'Terima Tagihan'
        },
        
        pane: {
            startAngle: -120,
            endAngle: 120,
        },
           
        // the value axis
        yAxis: {
            min: 0,
            max: 0,
            
            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',
    
            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',

            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Rupiah'
            }    
        },

        series: [{}]
    }
    //END OF HIGHCHART VARIABLE CHART//

    /*DEFAULT CHART ON LOAD PAGE*/
    function loadChart() {
        if($("#bread:has(a.breads)").length > 0){
            var elem = document.getElementById("breadsID");
            elem.remove();
        }

        // Set the default dates
        var startDate   = Date.create().addDays(-29),    // 7 days ago
            endDate     = Date.create();                // today
        var range = $('#range');

        // Show the dates in the range input
        range.val(startDate.format('{MM}/{dd}/{yyyy}') + ' - ' + endDate.format('{MM}/{dd}/{yyyy}'));
        // Load chart
        ajaxLoadChart(startDate,endDate);
        loadGauge(startDate,endDate,'');
        
        range.daterangepicker({
            startDate: startDate,
            endDate: endDate,
            ranges: 
            {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.create().addDays(-6), 'today'],
                'Last 30 Days': [Date.create().addDays(-29), 'today']
            }
            },function(start, end){
                ajaxLoadChart(start, end);  
                loadGauge(start, end,'');
        });
        
        // The tooltip shown over the chart
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var data = {
            "xScale" : "time",
            "yScale" : "linear",
            "main" : [{
                className : ".stats0",
                "data" : []
            }]
        };

        var opts = {
            paddingLeft : 50,
            paddingTop : 20,
            paddingRight : 10,
            axisPaddingLeft : 25,
            tickHintX: 12, // How many ticks to show horizontally

            dataFormatX : function(x) {
                return Date.create(x);
            },
            tickFormatX : function(x) {
                return x.format('{MM}/{dd}');
            },
            "mouseover": function (d, i) {
                var pos = $(this).offset();
                tt.text(d.x.format('{Month} {ord}') + ': Rp.' + pemisahRibuan(d.y)).css({
                    top: topOffset + pos.top,
                    left: pos.left 
                }).show();
            },
            "mouseout": function (x) {
                tt.hide();
            },
            "click": function (d, i){
                $('#myModal').modal('show');
                listDetail(d.x.format('{yyyy}-{MM}-{dd}'));
            }
        };

        var chart = new xChart('line-dotted', data, '#chart' , opts);

        function ajaxLoadChart(startDate,endDate) {
            if(!startDate || !endDate){
                chart.setData({
                    "xScale" : "time",
                    "yScale" : "linear",
                    "main" : [{
                        className : ".statsClear",
                        data : []
                    }]
                });
                return;
            }
            // Otherwise, issue an AJAX request
            $.ajax({
                type:'POST',
                url:"<?php echo base_url();?>dashboard/dashboard_penjualan",
                data:{
                        start:  startDate.format('{yyyy}-{MM}-{dd}'),
                        end:    endDate.format('{yyyy}-{MM}-{dd}')
                    },
                dataType:'json',
                success:
                function(data) {
                    var set = [];
                    $.each(data, function() {
                        set.push({
                            x : this.label,
                            y : parseInt(this.value)
                        });
                    });
                    chart.setData({
                        "xScale" : "time",
                        "yScale" : "linear",
                        "main" : [{
                            className : ".statsx",
                            data : set
                        }]
                    });
                    $('#tes').popover('hide') ;
                }
            });
        }
    }

    //CUSTOM GAUGE & BAR
    function loadGauge(startDate,endDate,year){
        //empty data on update
        $("#container").empty();
        $("#container2").empty();
        miniColumn.series = [];
        miniColumnSO.series = [];

        $("#container3").empty();
        $("#container4").empty();
        $("#container5").empty();
        $("#container6").empty();
        gaugePemesanan.series = [];
        gaugeTerkirim.series = [];
        gaugeInvoice.series = [];
        gaugeTerima.series = [];

        var startD = '';
        var endD = '';

        if(year == ''){
            startD = startDate.format('{yyyy}-{MM}-{dd}');
            endD = endDate.format('{yyyy}-{MM}-{dd}');
        }

        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/custom_avg_so",
            data:{
                start:  startD,
                end:    endD,
                year:   year
            },
            dataType:'json',
            success:
            function(data) {
                var set = [];
                var avg_so = [];
                $.each(data, function() {
                    miniColumn.series.push({
                        name: this.label,
                        data: [parseInt(this.value)]
                    })
                    avg_so.push(parseInt(this.value))
                });

                var sum = 0;
                for(var i = 0; i < avg_so.length; i++)
                {
                    sum += parseInt(avg_so[i]);
                }
                var avg = sum/avg_so.length;

                myChart = $('#container').highcharts(miniColumn);
                document.getElementById("val1").innerHTML = 'Rp '+pemisahRibuan(Math.round(avg));
            }
        });

        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/custom_avg_unit",
            data:{
                start:  startD,
                end:    endD,
                year:   year
            },
            dataType:'json',
            success:
            function(data) {
                var set = [];
                var unit_so = [];
                $.each(data, function() {
                    miniColumnSO.series.push({
                        name: this.label,
                        data: [parseInt(this.value)]
                    })

                    unit_so.push(parseInt(this.value_avg))
                });

                var sum = 0;
                for(var i = 0; i < unit_so.length; i++)
                {
                    sum += parseInt(unit_so[i]);
                }
                var unit = sum/unit_so.length;

                myChart = $('#container2').highcharts(miniColumnSO);
                document.getElementById("val2").innerHTML = unit;
            }
        });

        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/dashboard_total_os",
            data :{
                start:  startD,
                end:    endD,
                year:    year
            },
            dataType:'json',
            success:
            function(msg){
                gaugePemesanan.series.push({
                    name: 'pemesanan',
                    data: [parseInt(msg.pesan)],
                }) 
                myGaugePemesanan = $('#container3').highcharts(gaugePemesanan);

                gaugeTerkirim.series.push({
                    name: 'Terkirim',
                    data: [parseInt(msg.terkirim)],
                }) 
                myGaugeTerkirim = $('#container4').highcharts(gaugeTerkirim);
            }
        }); 

        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/dashboard_total_keuangan",
            data :{
                start:  startD,
                end:    endD,
                year:    year
            },
            dataType:'json',
            success:
            function(msg){
                gaugeInvoice.series.push({
                    name: 'Invoice',
                    data: [parseInt(msg.pesan)],
                })

                gaugeTerima.series.push({
                    name: 'Terima Pembayaran',
                    data: [parseInt(msg.terkirim)],
                })  

                var myGaugeInvoice = new Highcharts.Chart(gaugeInvoice);
                myGaugeInvoice.yAxis[0].update({         
                    min:0,
                    max:getmax(parseInt(msg.pesan))
                });

                var myGaugeTerima = new Highcharts.Chart(gaugeTerima);
                myGaugeTerima.yAxis[0].update({         
                    min:0,
                    max:getmax(parseInt(msg.terkirim))
                });
                console.log(msg.terkirim);
            }
        }); 
    }

    /*FILTER PENJUALAN*/
    function applyFilter(){
        var e = document.getElementById("select-filters");
        var strUser = e.options[e.selectedIndex].value;
        var filter = $('#fieldFilter').val();

        ajaxLoadFilter(filter,strUser);
    }
    /*
    DRILL DOWN PENJUALAN
    */
    function ajaxLoadFilter(filter,column) {
        document.getElementById("filter-stat").innerHTML = 'By '+column +' '+filter;
        document.getElementById("breadYear").style.visibility = 'hidden';
        document.getElementById("breadMonth").style.visibility = 'hidden';
        // The tooltip shown over the chart
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var data;
        if(column == "month"){
            data = {
                "xScale" : "time",
                "yScale" : "linear",
                "main" : [{
                    className : ".statsMonth",
                    "data" : []
                }]
            };
        }else if(column == "rev_less"){
            data = {
                "xScale" : "time",
                "yScale" : "linear",
                "main" : [{
                    className : ".statsLess",
                    "data" : []
                }]
            };
        }else if(column == "rev_great"){
            data = {
                "xScale" : "time",
                "yScale" : "linear",
                "main" : [{
                    className : ".statsGreat",
                    "data" : []
                }]
            };
        }else{
            data = {
                "xScale" : "time",
                "yScale" : "linear",
                "main" : [{
                    className : ".statsYear",
                    "data" : []
                }]
            };
        }

        var opts = {
            paddingLeft : 50,
            paddingTop : 20,
            paddingRight : 10,
            axisPaddingLeft : 25,
            tickHintX: 12, // How many ticks to show horizontally

            dataFormatX : function(x) {
                return Date.create(x);
            },

            tickFormatX : function(x) {
                if(column == "month"){
                    return x.format('{MM}');
                }else{
                    return x.format('{yyyy}');
                }
            },
            
            "mouseover": function (d, i) {
                var pos = $(this).offset();
                if(column == "month"){
                    tt.text(d.x.format('{Month}') + ': Rp.' + pemisahRibuan(d.y)).css({
                        
                        top: topOffset + pos.top,
                        left: pos.left
                        
                    }).show();
                }else{
                    tt.text(d.x.format('{year}') + ': Rp.' + pemisahRibuan(d.y)).css({
                        
                        top: topOffset + pos.top,
                        left: pos.left
                        
                    }).show();
                }
            },
            
            "mouseout": function (x) {
                tt.hide();
            },

            "click": function (d, i){
                ajaxLoadMonth(d.x.format('{year}'));
            }
        };
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);

        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_penjualan_filter",
            data:{filter:filter, column:column},
            dataType:'json',
            success:
            function(data) {
                var set = [];
                $.each(data, function() {
                    set.push({
                        x : this.label,
                        y : parseInt(this.value)
                    });
                });
                
                chart.setData({
                    "xScale" : "ordinal",
                    "yScale" : "linear",
                    "main" : [{
                        className : ".stats",
                        data : set
                    }]
                });

                $('#tes').popover('hide'); 
            }

        });
    }
    
    function ajaxLoadMonth(year) {
        // The tooltip shown over the chart
        document.getElementById("breadMonth").style.visibility = 'hidden';
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var data = {
            "xScale" : "time",
            "yScale" : "linear",
            "main" : [{
                className : ".stats3",
                "data" : []
            }]
        };

        var opts = {
            paddingLeft : 50,
            paddingTop : 20,
            paddingRight : 10,
            axisPaddingLeft : 25,
            tickHintX: 10, // How many ticks to show horizontally

            dataFormatX : function(x) {
                return Date.create(x);
            },

            tickFormatX : function(x) {
                
                // Provide formatting for the x-axis tick labels.
                // This uses sugar's format method of the date object. 
                return x.format('{MM}/{yyyy}'); 
            },
            
            "mouseover": function (d, i) {
                var pos = $(this).offset();
                tt.text(d.x.format('{Month} {year}') + ': Rp.' + pemisahRibuan(d.y)).css({
                    
                    top: topOffset + pos.top,
                    left: pos.left
                    
                }).show();
            },
            
            "mouseout": function (x) {
                tt.hide();
            },

            "click": function (d, i){
                ajaxLoadDay(d.x.format('{MM}'), d.x.format('{year}'));
            }
        };

        // Create a new xChart instance, passing the type
        // of chart a data set and the options object
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        // Otherwise, issue an AJAX request
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_penjualan_month",
            data:{year:year},
            dataType:'json',
            success:
            function(data) {
                var set = [];
                $.each(data, function() {
                    set.push({
                        x : this.label,
                        y : parseInt(this.value)
                    });
                });
                
                chart.setData({
                    "xScale" : "time",
                    "yScale" : "linear",
                    "main" : [{
                        className : ".stats3",
                        data : set
                    }]
                });
                document.getElementById("breadYear").style.visibility = 'visible';
                $('#tes').popover('hide'); 
                document.getElementById('filter-stat').innerHTML = 'By Year';
            }
        });
    }

    function ajaxLoadDay(month, year) {
        // The tooltip shown over the chart
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var data = {
            "xScale" : "time",
            "yScale" : "linear",
            "main" : [{
                className : ".stats4",
                "data" : []
            }]
        };

        var opts = {
            paddingLeft : 50,
            paddingTop : 20,
            paddingRight : 10,
            axisPaddingLeft : 25,
            tickHintX: 9, // How many ticks to show horizontally

            dataFormatX : function(x) {
                return Date.create(x);
            },

            tickFormatX : function(x) {
                return x.format('{MM}/{dd}');
            },
            
            "mouseover": function (d, i) {
                var pos = $(this).offset();
                
                tt.text(d.x.format('{Month} {ord} {yyyy}') + ': Rp.' + pemisahRibuan(d.y)).css({
                    
                    top: topOffset + pos.top,
                    left: pos.left
                    
                }).show();
            },
            
            "mouseout": function (x) {
                tt.hide();
            },
            
            "click": function (d, i){
                $('#myModal').modal('show');
                listDetail(d.x.format('{yyyy}-{MM}-{dd}'));
            }
        };
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        // Otherwise, issue an AJAX request
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_day",
            data:{year:year, month:month},
            dataType:'json',
            success:
            function(data) {
                var set = [];
                $.each(data, function() {
                    set.push({
                        x : this.label,
                        y : parseInt(this.value)
                    });
                });
                
                chart.setData({
                    "xScale" : "time",
                    "yScale" : "linear",
                    "main" : [{
                        className : ".stats4",
                        data : set
                    }]
                });
                document.getElementById("breadMonth").style.visibility = 'visible';
                document.getElementById('breadMonth').innerHTML = '> '+year;
                document.getElementById('breadMonth').setAttribute('href', "javascript:ajaxLoadMonth('"+year+"')");
                $('#tes').popover('hide'); 
            }

        });
    }
    /*
    End of drill down Penjualan
    */

    //Table
    function listDetail(date){
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/dashboard/dashboard_detail_penjualan",
            data :{date:date},
            success:
            function(hh){
                $('#list_detail').html(hh);
                document.getElementById('myModalLabel').innerHTML = 'Detail Penjualan '+date;
            }
        });   
    }

    /*AVERAGE SALES ORDER
    function get_Avg_So(date){
        var mydate = date;
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_penjualan",
            data:{mydate:mydate},
            dataType:'json',
            success:
            function(data) {
                var set = [];
                $.each(data, function() {
                    miniColumnSO.series.push({
                        name: this.label,
                        data: [parseInt(this.value)]
                    })
                });
                var chart1 = new Highcharts.Chart(miniColumnSO);
            }
        });
    }*/
</script>
</html>
