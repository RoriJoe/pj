<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chart/css/xcharts.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chart/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chart/css/daterangepicker.css" />

<div id="content" class="row-fluid">
    <div class="span7">
        <div class="bar-dash filter-bar" style="margin-bottom:20px;border-radius: 3px;">
            <span style="margin-left:10px;">
                <form class="form-horizontal" style="display:inline-block">
                  <fieldset>
                    <div class="input-prepend">
                      <span class="add-on"><i class="icon-calendar"></i></span>
                      <input type="text" name="range" id="range" style="width:150px; margin-bottom:0px;" />
                    </div>
                  </fieldset>
                </form>
            </span>
            <div id="drop-date" class="pull-left">
                <select name="" id="list-date" onchange="filterAll()">
                    <option value="">-Select Year-</option>
                </select>
            </div>
            <a href="<?php echo base_url(); ?>dashboard/advance" id="tes2" class="btn btn-default pull-right"  rel="tooltip" data-placement="left" data-original-title="View Full Page Dashboard"><i class="icon-tasks"></i> </a>
        </div>

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
                    <select style='width:100%; margin-bottom:10px;' id='select-filters' onchange='filterOpt()'>
                      <option value='year'>By Year</option>
                      <option value='rev_great'>Revenue Is Greater Than</option>
                      <option value='rev_less'>Revenue Is Less Than</option>
                    </select>
                    <input type='text' id='fieldFilter'  style='width:145px;visibility:hidden;' placeholder='Rupiah'>
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

    <div class="span5">
        <div class="row-fluid">
            <div class="span12">
                <div class="bar-dash">
                    <span>Outstanding</span>
                </div>

                <div id="placeholder">
                    <div class="row-fluid">
                        <div class="span6">
                            <div id="pemesanan" style="height:150px;"></div>
                        </div>
                        <div class="span6">
                            <div id="kirim" style="height:150px;"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <div class="span12" style="margin-left:0px;">
                <div class="bar-dash">
                    <span>Keuangan</span>
                    <!--<div class="dropdown" style="float:right;">
                        <a class="dropdown-toggle btn" id="drop5" role="button" data-toggle="dropdown" href="#"><i class="icon-filter"></i></a>
                        <ul id="menu2" class="dropdown-menu pull-right" role="menu" aria-labelledby="drop5">
                          <li><a tabindex="-1" href="#" id="avg_keuangan">Average</a></li>
                          <li><a tabindex="-1" href="#" id="total_keuangan">Total</a></li>
                        </ul>
                    </div>-->
                </div>

                <div id="placeholder">
                    <div class="span6">
                        <div id="invoice"  style="height:150px;"></div>
                    </div>
                    <div class="span6">
                        <div id="tagihan"  style="height:150px;"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
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

<!-- xcharts includes -->
<script src="<?php echo base_url();?>assets/js/chart/js/d3.v2.js"></script>
<script src="<?php echo base_url();?>assets/js/chart/js/xcharts.min.js"></script>

<script src="<?php echo base_url();?>assets/js/chart/js/raphael.2.1.0.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chart/js/justgage.js"></script>

<!-- The daterange picker bootstrap plugin -->
<script src="<?php echo base_url();?>assets/js/chart/js/sugar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chart/js/daterangepicker.js"></script>

<!-- Our main script file -->
<script>
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
    $("#tes").popover({ title: 'Filter'});

    $("#stat").value = "tes";

    $(':not(#anything)').on('click', function (e) {
        $('#tes').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons and other elements within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
                return;
            }
        });
    });

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
        if(initval > 100 && initval <= 1000){
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

    function filterAll(){
        var myVal = $('#list-date').val();
        var myMode = 'year';

        if(myVal != ''){
            ajaxLoadMonth(myVal);
            updateGauge('','',myVal);
        }else{
            ajaxLoadFilter('','year');
        }
    }

    /*LOAD GAUGES*/
    jQuery(document).ready(function(){
        loadChart();
        var _dateOpt = 'year';

        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/date_call",
            data :{_dateOpt:_dateOpt},
            dataType: "html",
            success: function(data){
                $('#drop-date').html(data);
            }
        });
    });
    
    /*LOAD LINECHART*/
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
            
            ranges: {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.create().addDays(-6), 'today'],
                'Last 30 Days': [Date.create().addDays(-29), 'today']
            }
            },function(start, end){
                
                ajaxLoadChart(start, end);  
                updateGauge(start, end,'');
        });
        
        // The tooltip shown over the chart
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var data = {
            "xScale" : "time",
            "yScale" : "linear",
            "main" : [{
                className : ".stats",
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
                
                // This turns converts the timestamps coming from
                // ajax.php into a proper JavaScript Date object
                
                return Date.create(x);
            },

            tickFormatX : function(x) {
                
                // Provide formatting for the x-axis tick labels.
                // This uses sugar's format method of the date object. 

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

        // Create a new xChart instance, passing the type
        // of chart a data set and the options object
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        
        // Function for loading data via AJAX and showing it on the chart
        function ajaxLoadChart(startDate,endDate) {

            // If no data is passed (the chart was cleared)
            
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
                            className : ".stats",
                            data : set
                        }]
                    });
                    $('#tes').popover('hide') ;
                }

            });
        }
    }

    function loadGauge(startDate,endDate,year){
        var startD = '';
        var endD = '';

        if(year == ''){
            startD = startDate.format('{yyyy}-{MM}-{dd}');
            endD = endDate.format('{yyyy}-{MM}-{dd}');
        }

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
                g = new JustGage({
                    id: "pemesanan", 
                    value: parseInt(msg.pesan), 
                    min: 0,
                    max: getmax(parseInt(msg.pesan)),
                    title: "Pemesanan",
                    label: "Jumlah",
                    formatNumber: true,
                    relativeGaugeSize: true
                }); 

                h = new JustGage({
                    id: "kirim", 
                    value: parseInt(msg.terkirim), 
                    min: 0,
                    max: getmax(parseInt(msg.terkirim)),
                    title: "Terkirim",
                    label: "Jumlah",
                    formatNumber: true,
                    relativeGaugeSize: true
                });  
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
                i = new JustGage({
                    id: "invoice", 
                    value: parseInt(msg.pesan), 
                    min: 0,
                    max: getmax(parseInt(msg.pesan)),
                    title: "Invoice",
                    label: "Rupiah",
                    showMinMax: false,
                    formatNumber: true,
                    relativeGaugeSize: true
                }); 

                j = new JustGage({
                    id: "tagihan", 
                    value: parseInt(msg.terkirim), 
                    min: 0,
                    max: getmax(parseInt(msg.terkirim)),
                    title: "Terima Tagihan",
                    label: "Rupiah",
                    showMinMax: false,
                    formatNumber: true,
                    relativeGaugeSize: true
                });  
            }
        });    
    }

    function updateGauge(startDate,endDate,year){
        var startD = '';
        var endD = '';
        
        if(year == ''){
            startD = startDate.format('{yyyy}-{MM}-{dd}');
            endD = endDate.format('{yyyy}-{MM}-{dd}');
        }

        if(!startDate || !endDate){
            g.refresh(0); 
            h.refresh(0); 
            i.refresh(0); 
            j.refresh(0); 
        }

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
                g.refresh(msg.pesan); 

                h.refresh(msg.terkirim);  
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
                i.refresh(msg.pesan); 

                j.refresh(msg.terkirim);  
            }
        });    
    }

    //Table Barang
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

    var g, h, i, j;
    
    /*GAUGES FILTER*/
/*    $('#avg_os').click( function() { 
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/dashboard_avg_os",
            data :{},
            dataType:'json',
            success:
            function(msg){
                g.refresh(msg.pesan,100);

                h.refresh(msg.terkirim,100);
            }
        });
    } );

    $('#total_os').click( function() { 
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/dashboard_total_os",
            data :{},
            dataType:'json',
            success:
            function(msg){
                g.refresh(msg.pesan); 

                h.refresh(msg.terkirim);  
            }
        });
    } );*/

    function filterOpt(){
        var e = document.getElementById("select-filters");
        var strUser = e.options[e.selectedIndex].value;
        if(strUser == "year" || strUser == "month"){
            document.getElementById("fieldFilter").style.visibility = 'hidden';
        }else{
            document.getElementById("fieldFilter").style.visibility = 'visible';
        }
    }

    function applyFilter(){
        var e = document.getElementById("select-filters");
        var strUser = e.options[e.selectedIndex].value;
        var filter = $('#fieldFilter').val();

        ajaxLoadFilter(filter,strUser);
    }

    function ajaxLoadFilter(filter,column) {
        document.getElementById("filter-stat").innerHTML = 'By '+column +' '+filter;
        document.getElementById("breadYear").style.visibility = 'hidden';
        document.getElementById("breadMonth").style.visibility = 'hidden';
        // The tooltip shown over the chart
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var data;
        if(column == "rev_less"){
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
                return x.format('{yyyy}');
            },
            
            "mouseover": function (d, i) {
                var pos = $(this).offset();

                tt.text(d.x.format('{year}') + ': Rp.' + pemisahRibuan(d.y)).css({
                    
                    top: topOffset + pos.top,
                    left: pos.left
                    
                }).show();
            },
            
            "mouseout": function (x) {
                tt.hide();
            },

            "click": function (d, i){
                ajaxLoadMonth(d.x.format('{year}'));
            }
        };

        // Create a new xChart instance, passing the type
        // of chart a data set and the options object
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        // Otherwise, issue an AJAX request
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
                
                // This turns converts the timestamps coming from
                // ajax.php into a proper JavaScript Date object
                
                return Date.create(x);
            },

            tickFormatX : function(x) {
                
                // Provide formatting for the x-axis tick labels.
                // This uses sugar's format method of the date object. 

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

        // Create a new xChart instance, passing the type
        // of chart a data set and the options object
        
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
                //document.getElementById('stat').innerHTML = 'Year';
                $('#tes').popover('hide'); 
            }

        });
    }
</script>