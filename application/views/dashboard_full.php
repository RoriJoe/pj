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
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span6">
                <div class="row-fluid">
                    <div class="span6">
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
                                    <select name="" id="list-date" onchange="filterYear()" disabled>
                                        <option value="">-Select Year-</option>
                                    </select>
                                </div>
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
                    <div class="span6">
                        <div class="row-fluid">
                            <a href="javascript:detail_Penjualan('')" title="show table">
                                <div class="span12 cover-bar cover-bar2">
                                        <div class="pull-left">AVG <br/>Sales Order value</div>
                                        <div class="pull-right"><span class="mini-box" id="val-info">Rp 31.496.690</span></div>
                                </div>
                            </a>
                            <a href="javascript:detail_Penjualan('')" title="show table">
                                <div class="span12 cover-bar cover-bar2">
                                    <div class="pull-left">AVG<br/>Qty / Sales Order</div>
                                    <div class="pull-right"><span class="mini-box" id="qty-info">13</span></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="span12">
                        <div class="bar-dash">
                            <span>Grafik Penjualan</span> &dash; <span id="filter-stat">Per 30 Hari</span> 
                            <span id="legend" style="visibility:hidden">(<span style="color:#0033FF;">Penjualan</span> - <span style="color:#00BE1E;">Pembelian</span>)</span>
                            <a  id="tes" 
                                class="btn pull-right" 
                                tittle="Filter" 
                                data-toggle="button" 
                                data-html="true" 
                                data-placement="bottom"
                                rel="popover"
                                data-content="
                                    <select style='width:100%; margin-bottom:10px;' id='select-filters'>
                                      <option value='rev_great'>Total Lebih Besar Dari</option>
                                      <option value='rev_less'>Total Kurang Dari</option>
                                    </select>
                                    <input type='text' id='fieldFilter'  style='width:145px;' placeholder='Rupiah'>
                                    <div class='clearfix'></div>
                                    <button class='btn btn-mini btn-success' onclick='filterPenjualan()'>Apply</button>
                                ">

                                <i class='icon-filter'></i> Filter
                            </a>
                        </div>
                        <div id="placeholder" style="margin-bottom:0">
                            <figure id="chart"></figure>
                        </div>
                        <div class="bar-dash" style="margin-bottom:15px;">
                            <div class="pull-left">
                                <a href="javascript:filter_all_year('','year',0)" id="breadYear">All Year</a>
                                <a href="" id="breadMonth" style="visibility:hidden">> Year</a>
                            </div>
                            <div class="pull-right">
                                <div class="btn-group dropup">
                                  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
                                    Options
                                    <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu pull-right">
                                    <a href="#modalCompare" data-toggle="modal"><i class="icon-retweet"></i> Compare Penjualan</a>
                                    <a href="javascript:pembelian()"><i class="icon-adjust"></i> Compare with Pembelian</a>
                                    <a href="javascript:minMax()"><i class="icon-signal"></i> View Min - Max Value</a>
                                    <a href="javascript:detail_Penjualan('')" id="opsi"><i class="icon-th"></i> View Table</a>
                                  </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="row-fluid">
                    <div class="span6 gauges">
                        <div id="container3" style="width:100%; height:230px;"></div>
                    </div>
                    <div class="span6 gauges">
                        <div id="container4" style="width:100%; height:230px;"></div>
                    </div>
                    <div class="span12 text-center">
                        <a href="#" onclick="outstandingDetail()">Detail Outstanding</a>
                    </div>
                    <div class="span12">
                        <div id="container5" style="width:100%; height:230px;"></div>
                    </div>
                    <div class="span12 text-center">
                        <a href="#" onclick="keuanganDetail()">Detail Keuangan</a>
                    </div>
                    <div class="span12 text-center">
                        <div class="row-fluid">
                            <div class="span4 well well-small">
                            <p>Invoice</p>
                            <p><span id="invoice-stat" class="card-text">Rp. 151.484.850</span> </p>
                        </div>
                        <div class="span4 well well-small">
                            <p>Terima Pembayaran</p>
                            <p><span id="terima-stat" class="card-text">-</span></p>
                        </div>
                        <div class="span4 well well-small">
                            <p>Sisa Pembayaran</p>
                            <p><span id="sisa-stat" class="card-text" style="color: #DB4E4E;">Rp. 151.484.850</span> </p>
                        </div>
                        </div>
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

    <div class="modal hide fade" id="modalOutstanding" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel2">Detail</h3>
      </div>
      <div class="modal-body" style="height:400px">
        <div class="tabable tabs-below">
            <div id="myTabContent" class="tab-content" style="height:372px;">
                <div class="tab-pane fade active in" id="os_table">
                    <div id="list_detail_os"></div>
                </div>
                <div class="tab-pane fade" id="os_chart">
                    <figure id="chart_os"></figure>
                </div>
            </div>
            <ul id="myTab" class="nav nav-tabs" style="margin-bottom:0px;">
                <li class="active"><a href="#os_table" data-toggle="tab">Table</a></li>
                <li class=""><a href="#os_chart" data-toggle="tab">Chart</a></li>
            </ul>
        </div>
      </div>
      <div class="modal-footer">
        <span class="pull-left" style="background-color:#67C767">Terkirim</span>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>

    <div class="modal hide fade" id="modalKeuangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel3">Detail</h3>
      </div>
      <div class="modal-body" style="height:400px">
        <div id="list_detail_keuangan"></div>
      </div>
      <div class="modal-footer">
        <span class="pull-left" style="background-color:#67C767">Terima Tagihan</span>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>

    <div class="modal hide fade" id="modalCompare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel4">Compare Penjualan</h3>
      </div>
      <div class="modal-body">
        <table class="table">
            <tr>
                <td>Tahun</td>
                <td>
                    <div id="drop-date1" class="pull-left">
                        <select name="" id="list-dateComp1">
                            <option value="">-Select Year-</option>
                        </select>
                    </div>
                </td>
                <td>Bulan</td>
                <td>
                    <select name="" id="list-month1">
                        <option value="0">-Select-</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </td>
                <td>Minggu Ke</td>
                <td>
                    <select name="" id="list-week1">
                        <option value="0">-Select-</option>
                        <option value="1">1</option>
                        <option value="8">2</option>
                        <option value="15">3</option>
                        <option value="22">4</option>
                        <option value="29">5</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>
                    <div id="drop-date2" class="pull-left">
                        <select name="" id="list-dateComp2">
                            <option value="">-Select Year-</option>
                        </select>
                    </div>
                </td>
                <td>Bulan</td>
                <td>
                    <select name="" id="list-month2">
                        <option value="0">-Select-</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </td>
                <td>Minggu Ke</td>
                <td>
                    <select name="" id="list-week2">
                        <option value="0">-Select-</option>
                        <option value="1">1</option>
                        <option value="8">2</option>
                        <option value="15">3</option>
                        <option value="22">4</option>
                        <option value="29">5</option>
                    </select>
                </td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="compare()"><i class="icon-retweet icon-white"></i> Compare</button>
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
    $("#tes").popover({ title: 'Filter Penjualan / Tahun'});

    $("#stat").value = "tes";

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
            ajaxLoadChart(startDate,endDate,0);
            loadGauge(xdStart,xdEnd,'');
        }
    }

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

    var gaugePemesanan = {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
        },
        
        title: {
            text: 'Outstanding Barang Dipesan'
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
            }       
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
            text: 'Outstanding Barang Dikirim'
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
            }     
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
            max: 100,
            
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
                text: '%'
            },
            plotBands: [{
                from: 0,
                to: 30,
                color: '#DF5353' // green
            }, {
                from: 30,
                to: 60,
                color: '#DDDF0D' // yellow
            }, {
                from: 60,
                to: 100,
                color: '#55BF3B' // red
            }]        
        },

        series: [{}]
    }

    $(function () {
        $("[rel='tooltip']").tooltip();
    });

    var pemisah_ribuan = '.';
    var xdStart = '';
    var xdEnd = '';
    var xdYear = '';
    var xdMonth = '';

    var strUser = '';
    var filter = '';

    var monthT=new Array();
        monthT[0]="January";
        monthT[1]="February";
        monthT[2]="March";
        monthT[3]="April";
        monthT[4]="May";
        monthT[5]="June";
        monthT[6]="July";
        monthT[7]="August";
        monthT[8]="September";
        monthT[9]="October";
        monthT[10]="November";
        monthT[11]="December";

    var g, h, i, j;
    // Set the default dates
    var startDate   = Date.create().addDays(-29),    // 7 days ago
        endDate     = Date.create();                // today
    var range = $('#range');
        range.val(startDate.format('{dd}/{MM}/{yyyy}') + ' - ' + endDate.format('{dd}/{MM}/{yyyy}'));

        xdStart = startDate;
        xdEnd = endDate;
        xdYear = "";
        
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
                ajaxLoadChart(start, end,0);  
                updateGauge(start, end,'','','range');
                xdStart = start;
                xdEnd = end;
                xdYear = "";
                document.getElementById('list-date').value="";
                document.getElementById("filter-stat").innerHTML = '';
                document.getElementById("breadMonth").style.visibility = 'hidden';
                document.getElementById("legend").style.visibility = 'hidden';
        });
    //Tooltip Chart
    var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

    jQuery(document).ready(function(){
        //loadChart(0); 
        ajaxLoadChart(startDate,endDate,0);
        loadGauge(xdStart,xdEnd,'');
        listYear();      
        listYearCompare();
        listYearCompare2();
    });

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

    function filterYear(){
        var myVal = $('#list-date').val();
        var myMode = 'year';

        if(myVal != ''){
            filter_by_year(myVal,0);
            xdStart = "";
            xdEnd = "";
            xdYear = myVal;
            $("#range").val("");
        }else{
            var y = new Date();
            xdYear = '';
            filter_all_year('','year',0);
        }
    }

    function listYear(){
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
    }

    var data = {
        "xScale" : "time",
        "yScale" : "linear",
        "main" : [{
            className : ".statsDefault",
            "data" : []
        }]
    };

    /*Filter Penjualan Revenue*/
    function filterPenjualan(){
        var e = document.getElementById("select-filters");
        strUser = e.options[e.selectedIndex].value;
        filter = $('#fieldFilter').val();

        document.getElementById('list-date').value="";

        filter_all_year(filter,strUser,0);
    }
    /*LOAD LINE*/
    function ajaxLoadChart(startDate,endDate,compare) {
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var opts = {
            paddingLeft : 50,
            paddingTop : 20,
            paddingRight : 10,
            axisPaddingLeft : 25,
            tickHintX: 31, // How many ticks to show horizontally

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
                detail_Penjualan(d.x.format('{yyyy}-{MM}-{dd}'));
            }
        };
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        if(!startDate || !endDate){
            chart.setData({
                "xScale" : "ordinal",
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
                    end:    endDate.format('{yyyy}-{MM}-{dd}'),
                    compare:compare
                },
            dataType:'json',
            success:
            function(data) {
                var set = [];
                var set2 = [];

                if(compare == 1){
                    $.each(data.line1, function() {
                        set.push({
                            x : this.label,
                            y : parseInt(this.value)
                        });
                    });
                    $.each(data.line2, function() {
                        set2.push({
                            x : this.label2,
                            y : parseInt(this.value2)
                        });
                    });
                    
                    chart.setData({
                        "xScale" : "ordinal",
                        "yScale" : "linear",
                        "main" : [{
                            className : ".stats",
                            data : set
                        },{
                            className:".stats2",
                            data: set2
                        }
                        ],
                    });
                }else{
                    document.getElementById("legend").style.visibility = 'hidden';
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
                }

                
                $('#tes').popover('hide') ;
            }
        });
        info_penjualan();
    }
    /*Semua Penjualan*/
    function filter_all_year(filter,column,compare) {
        xdYear ="";
        xdMonth ="";
        xdStart ="";
        xdEnd ="";

        document.getElementById("filter-stat").innerHTML = 'By All Year';
        document.getElementById("breadMonth").style.visibility = 'hidden';

        // The tooltip shown over the chart
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

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
                filter_by_year(d.x.format('{year}'),0);
                updateGauge('','',d.x.format('{year}'),'');
            }
        };
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_penjualan_filter",
            data:{filter:filter, column:column,compare:compare},
            dataType:'json',
            success:
            function(data) {
                var set = [];
                var set2 = [];
                
                if(compare != 0){
                    $.each(data.line1, function() {
                        set.push({
                            x : this.label,
                            y : parseInt(this.value)
                        });
                    });
                    $.each(data.line2, function() {
                        set2.push({
                            x : this.label2,
                            y : parseInt(this.value2)
                        });
                    });
                    
                    chart.setData({
                        "xScale" : "ordinal",
                        "yScale" : "linear",
                        "main" : [{
                            className : ".statsAllYear",
                            data : set
                        },{
                            className:".stats2",
                            data: set2
                        }
                        ],
                    });
                }else{
                    document.getElementById("legend").style.visibility = 'hidden';
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
                            className : ".statsAllYear",
                            data : set
                        }]
                    });
                }
                $('#tes').popover('hide'); 
            }
        });

        updateGauge('','','','');
        info_penjualan();
    }
    /*Penjualan Based Tahun*/
    function filter_by_year(year,compare) {
        xdYear = year;
        xdMonth = "";
        document.getElementById("filter-stat").innerHTML = 'By Year '+year;
        document.getElementById('breadMonth').innerHTML = '> '+year;
        document.getElementById('breadMonth').setAttribute('href', "javascript:filter_by_year('"+year+"',0)");
        document.getElementById("breadMonth").style.visibility = 'visible';

        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

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
                return x.format('{Month}'); 
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
                filter_by_month(d.x.format('{M}'), d.x.format('{year}'),0);
            }
        };
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_drill_penjualan",
            data:{year:year,month:xdMonth,compare:compare},
            dataType:'json',
            success:
            function(data) {
                var set = [];
                var set2 = [];
                
                if(compare != 0){
                    $.each(data.line1, function() {
                        set.push({
                            x : this.label,
                            y : parseInt(this.value)
                        });
                    });
                    $.each(data.line2, function() {
                        set2.push({
                            x : this.label2,
                            y : parseInt(this.value2)
                        });
                    });
                    
                    chart.setData({
                        "xScale" : "ordinal",
                        "yScale" : "linear",
                        "main" : [{
                            className : ".stats",
                            data : set
                        },{
                            className:".stats2",
                            data: set2
                        }
                        ],
                    });
                }else{
                    document.getElementById("legend").style.visibility = 'hidden';
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
                } 

                $('#tes').popover('hide'); 
            }
        });

        updateGauge('','',year,'');
        info_penjualan();
    }
    /*penjualan Based bulan*/
    function filter_by_month(month,year,compare) {
        xdMonth = month;
        xdYear = year;

        document.getElementById("filter-stat").innerHTML = 'By Year '+year+' / '+monthT[month-1];
        document.getElementById('breadMonth').innerHTML = '> '+year+' > '+monthT[month-1];
        document.getElementById('breadMonth').setAttribute('href', "javascript:filter_by_year('"+year+"',0)");
        document.getElementById("breadMonth").style.visibility = 'visible';

        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var opts = {
            paddingLeft : 50,
            paddingTop : 20,
            paddingRight : 10,
            axisPaddingLeft : 25,
            tickHintX: 31,

            dataFormatX : function(x) {
                return Date.create(x);
            },

            tickFormatX : function(x) {
                return x.format('{MM}/{dd}');
            },
            
            "mouseover": function (d, i) {
                var pos = $(this).offset();
                
                tt.text(d.x.format('{ord} {Month} {yyyy}') + ': Rp.' + pemisahRibuan(d.y)).css({
                    
                    top: topOffset + pos.top,
                    left: pos.left
                    
                }).show();
            },
            
            "mouseout": function (x) {
                tt.hide();
            },
            
            "click": function (d, i){
                detail_Penjualan(d.x.format('{yyyy}-{MM}-{dd}'));
            }
        };
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_drill_penjualan",
            data:{year:year,month:month,compare:compare},
            dataType:'json',
            success:
            function(data) {
                var set = [];
                var set2 = [];
                
                if(compare != 0){
                    $.each(data.line1, function() {
                        set.push({
                            x : this.label,
                            y : parseInt(this.value)
                        });
                    });
                    $.each(data.line2, function() {
                        set2.push({
                            x : this.label2,
                            y : parseInt(this.value2)
                        });
                    });
                    
                    chart.setData({
                        "xScale" : "ordinal",
                        "yScale" : "linear",
                        "main" : [{
                            className : ".stats",
                            data : set
                        },{
                            className:".stats2",
                            data: set2
                        }
                        ],
                    });
                }else{
                    document.getElementById("legend").style.visibility = 'hidden';
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
                }                 
                $('#tes').popover('hide'); 
            }
        });
        
        updateGauge('','',year,month);
        info_penjualan();
    }
    /*Detail Penjualan*/
    function detail_Penjualan(date){
        var month,year = "";
        month = xdMonth;
        year = xdYear;
        var start = "";
        var end = "";

        if(xdYear == '' && xdStart != null && xdEnd != ''){
            start = xdStart.format('{yyyy}-{MM}-{dd}');
            end = xdEnd.format('{yyyy}-{MM}-{dd}');
        }

        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/dashboard/dashboard_detail_penjualan",
            data :{year:year,month:month,date:date,start:start,end:end},
            success:
            function(hh){
                $('#list_detail').html(hh);
                if(date != ""){
                    document.getElementById('myModalLabel').innerHTML = 'Detail Penjualan Tanggal '+date;
                }else if(start != ""){
                    document.getElementById('myModalLabel').innerHTML = 'Penjualan Tgl '+start+' / '+end;
                }else if(month != ""){
                    document.getElementById('myModalLabel').innerHTML = 'Detail Penjualan Bulan '+monthT[month-1]+' / '+year;
                }else if(year != ""){
                    document.getElementById('myModalLabel').innerHTML = 'Detail Penjualan Tahun '+year;
                }else{
                    document.getElementById('myModalLabel').innerHTML = 'Semua Penjualan';
                }
                
            }
        });   
        $('#myModal').modal('show');
    }
    function info_penjualan(){
        var start = "";
        var end = "";
        var year = "";
        var month = "";
        month = xdMonth;
        year = xdYear;

        if(xdYear == '' && xdStart != null && xdEnd != ''){
            start = xdStart.format('{yyyy}-{MM}-{dd}');
            end = xdEnd.format('{yyyy}-{MM}-{dd}');
        }

        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/custom_avg_so",
            data:{
                start:start,
                end:end,
                year:year,
                month:month
            },
            dataType:'json',
            success:
            function(data) {
                
                $.each(data, function() {
                    //avg_so.push(parseInt(this.value))
                    document.getElementById("val-info").innerHTML = 'Rp '+pemisahRibuan(this.value);
                    document.getElementById("qty-info").innerHTML = pemisahRibuan(this.qty);
                });
            }
        });
    }
    /*End Filter Penjualan*/

    /*LOAD GAUGE*/
    function loadGauge(startDate,endDate,year){
        $("#container").empty();
        $("#container2").empty();

        $("#container3").empty();
        $("#container4").empty();
        $("#container5").empty();
        $("#container6").empty();
        gaugePemesanan.series = [];
        gaugeTerkirim.series = [];
        gaugeInvoice.series = [];

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
                gaugePemesanan.series.push({
                    name: 'pemesanan',
                    data: [parseInt(msg.pesan)],
                }) 
                myGaugePemesanan = $('#container3').highcharts(gaugePemesanan);

                gaugeTerkirim.series.push({
                    name: 'Terkirim',
                    data: [parseInt(msg.terkirim)]
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
                year:   year
            },
            dataType:'json',
            success:
            function(msg){
                var hitung = parseInt(msg.terkirim)/parseInt(msg.pesan)*100;
                //alert(hitung);
                if (hitung >= 0) {
                    gaugeInvoice.series.push({
                        name: 'Invoice',
                        data: [hitung],
                    })
                }else{
                    gaugeInvoice.series.push({
                        name: 'Invoice',
                        data: [0],
                    })
                }

                var myGaugeInvoice = new Highcharts.Chart(gaugeInvoice);

                //myGaugePemesanan = $('#container3').highcharts(gaugePemesanan);
                document.getElementById("invoice-stat").innerHTML = "Rp. "+pemisahRibuan(msg.pesan);
                document.getElementById("terima-stat").innerHTML = "Rp. "+pemisahRibuan(msg.terkirim);

                var sisa = parseInt(msg.pesan)-parseInt(msg.terkirim);
                document.getElementById("sisa-stat").innerHTML = "Rp. "+pemisahRibuan(sisa);
            }
        });    
    }
    /*Filter Gauge*/
    function updateGauge(startDate,endDate,year,month){
        $("#container").empty();
        $("#container2").empty();

        $("#container3").empty();
        $("#container4").empty();
        $("#container5").empty();
        $("#container6").empty();
        gaugePemesanan.series = [];
        gaugeTerkirim.series = [];
        gaugeInvoice.series = [];

        var startD = '';
        var endD = '';

        if(year == "" && startDate != null && startDate != ''){
            startD = startDate.format('{yyyy}-{MM}-{dd}');
            endD = endDate.format('{yyyy}-{MM}-{dd}');

            //set public variable
            xdStart = startDate.format('{yyyy}-{MM}-{dd}');
            xdEnd = endDate.format('{yyyy}-{MM}-{dd}');
        }

        if(!startDate || !endDate){
            
            //j.refresh(0,100); 

            xdStart = "";
            xdEnd = "";
        }

        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/dashboard_total_os",
            data :{
                start:startD,
                end:  endD,
                year: year,
                month:month
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
                    data: [parseInt(msg.terkirim)]
                }) 
                myGaugeTerkirim = $('#container4').highcharts(gaugeTerkirim);
            }
        }); 

        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/dashboard_total_keuangan",
            data :{
                start:startD,
                end:  endD,
                year: year,
                month:month
            },
            dataType:'json',
            success:
            function(msg){
                
                //j.refresh(msg.terkirim,getmax(parseInt(msg.terkirim)));  
                var hitung = parseInt(msg.terkirim)/parseInt(msg.pesan)*100;
                var inv = 0;
                var terima = 0;
                if (hitung >= 0) {
                    gaugeInvoice.series.push({
                        name: 'Invoice',
                        data: [hitung],
                    })
                }else{
                    gaugeInvoice.series.push({
                        name: 'Invoice',
                        data: [0],
                    })
                }
                console.log(msg.terkirim);

                var myGaugeInvoice = new Highcharts.Chart(gaugeInvoice);

                document.getElementById("invoice-stat").innerHTML = "Rp. "+pemisahRibuan(msg.pesan);
                document.getElementById("terima-stat").innerHTML = "Rp. "+pemisahRibuan(msg.terkirim);

                var sisa = parseInt(msg.pesan)-parseInt(msg.terkirim);
                document.getElementById("sisa-stat").innerHTML = "Rp. "+pemisahRibuan(sisa);
            }
        });    
    }

    function outstandingDetail(){
        var startD = '';
        var endD = '';

        if(xdYear == '' && xdStart != null && xdEnd != ''){
            startD = xdStart.format('{yyyy}-{MM}-{dd}');
            endD = xdEnd.format('{yyyy}-{MM}-{dd}');
        }
        //alert(xdYear);
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/dashboard_detail_os",
            data :{
                start:  startD,
                end:    endD,
                year:   xdYear,
                month: xdMonth
            },
            success:
            function(hh){
                $('#list_detail_os').html(hh);
                if (xdYear != ''){
                    if(xdMonth != ''){
                        document.getElementById('myModalLabel2').innerHTML = 'Detail Outstanding Penjualan ' + xdYear+' / '+monthT[xdMonth-1];
                    }else{
                        document.getElementById('myModalLabel2').innerHTML = 'Detail Outstanding Penjualan ' + xdYear;
                    }
                }else{
                    document.getElementById('myModalLabel2').innerHTML = 'Detail Outstanding Penjualan';
                }
                $('#modalOutstanding').modal('show');
            }
        });
    }

    function keuanganDetail(){
        var startD = '';
        var endD = '';

        if(xdYear == '' && xdStart != null && xdEnd != ''){
            startD = xdStart.format('{yyyy}-{MM}-{dd}');
            endD = xdEnd.format('{yyyy}-{MM}-{dd}');
        }
        //alert(xdYear);
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/dashboard_detail_keuangan",
            data :{
                start:  startD,
                end:    endD,
                year:   xdYear,
                month: xdMonth
            },
            success:
            function(hh){
                $('#list_detail_keuangan').html(hh);
                if(xdYear != ''){
                    if(xdMonth != ''){
                        document.getElementById('myModalLabel3').innerHTML = 'Detail Keuangan '+xdYear+' / '+monthT[xdMonth-1];
                    }else{
                        document.getElementById('myModalLabel3').innerHTML = 'Detail Keuangan '+xdYear;
                    }
                }else{
                    document.getElementById('myModalLabel3').innerHTML = 'Detail Keuangan';
                }
                $('#modalKeuangan').modal('show');
            }
        });
    }

    function build_chart_os(){
        var start = "";
        var end = "";
        var year = "";
        var month = "";
        month = xdMonth;
        year = xdYear;

        if(xdYear == '' && xdStart != null && xdEnd != ''){
            start = xdStart.format('{yyyy}-{MM}-{dd}');
            end = xdEnd.format('{yyyy}-{MM}-{dd}');
        }

        var data2 = {
            "xScale" : "ordinal",
            "yScale" : "linear",
            "main" : [{
                className : ".statsDefault",
                "data" : []
            }]
        };
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;
 
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
                if(start != ""){
                    return x.format('{MM}/{dd}');
                }else if(month != ""){
                    return x.format('{MM}/{dd}');
                }else if(year != ""){
                    return x.format('{Month}');
                }else{
                    return x.format('{yyyy}');
                }
                
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
            }
        };

        var chart = new xChart('bar', data2, '#chart_os', opts);
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_chart_os",
            data:{start:start,
                end:  end,
                year: year,
                month:month},
            dataType:'json',
            success:
            function(data) {
                var set = [];
                var set2 = [];
                
                $.each(data.line1, function() {
                    set.push({
                        x : this.label,
                        y : parseInt(this.value)
                    });
                });
                $.each(data.line2, function() {
                    set2.push({
                        x : this.label2,
                        y : parseInt(this.value2)
                    });
                });
                
                chart.setData({
                    "xScale" : "ordinal",
                    "yScale" : "linear",
                    "main" : [{
                        className : ".stats",
                        data : set
                    },{
                        className:".stats2",
                        data: set2
                    }
                    ],
                });               
                $('#tes').popover('hide'); 
            }
        });
    }
    /*End Filter Gauge*/

    function listYearCompare(){
        var _dateOpt = 'year';
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/date_callCompare",
            data :{_dateOpt:_dateOpt},
            dataType: "html",
            success: function(data){
                $('#drop-date1').html(data);
            }
        });
    }
    function listYearCompare2(){
        var _dateOpt = 'year';
        $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>dashboard/date_callCompare2",
            data :{_dateOpt:_dateOpt},
            dataType: "html",
            success: function(data){
                $('#drop-date2').html(data);
            }
        });
    }

    $('#modalCompare').on('show', function () {
        if(xdYear != null && xdYear != ""){
            document.getElementById('list-date1').value=xdYear;
        }else if(xdMonth != null && xdMonth != ""){
            document.getElementById('list-month11').value=parseInt(xdMonth);
        }
    })
    $('#modalOutstanding').on('show', function () {
        build_chart_os();
    })

    function compare(){
        var year1 = $("#list-date1").val();
        var year2 = $("#list-date2").val();
        var month1 = $("#list-month1").val();
        var month2 = $("#list-month2").val();
        var week1 = parseInt($("#list-week1").val());
        var week2 = parseInt($("#list-week2").val());

        document.getElementById("filter-stat").innerHTML = 'Comparison';
        document.getElementById("breadMonth").style.visibility = 'hidden';

        xdYear ="";
        xdMonth ="";
        xdStart = "";
        xdEnd = "";
        // The tooltip shown over the chart
        var tt = $('<div class="ex-tooltip">').appendTo('body'),
            topOffset = -32;

        var data;
        var opts
        data = {
            "xScale" : "time",
            "yScale" : "linear",
            "main" : [{
                className : ".statsYear",
                "data" : []
            }]
        };
        //alert(week1);
        if(week1 != 0){
            opts = {
                paddingLeft : 50,
                paddingTop : 20,
                paddingRight : 10,
                axisPaddingLeft : 25,
                tickHintX: 7, // How many ticks to show horizontally

                dataFormatX : function(x) {
                    return Date.create(x);
                },

                tickFormatX : function(x) {
                    return x.format('{MM} / {dd}');
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
                    //$('#myModal').modal('show');
                    //listDetail(d.x.format('{yyyy}-{MM}-{dd}'));
                }
            };
        }else if(month1 != 0){
            opts = {
                paddingLeft : 50,
                paddingTop : 20,
                paddingRight : 10,
                axisPaddingLeft : 25,
                tickHintX: 31, // How many ticks to show horizontally

                dataFormatX : function(x) {
                    return Date.create(x);
                },

                tickFormatX : function(x) {
                    return x.format('{MM} {ord}');
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
                    //$('#myModal').modal('show');
                    //listDetail(d.x.format('{yyyy}-{MM}-{dd}'));
                }
            };
        }else{
            opts = {
                paddingLeft : 50,
                paddingTop : 20,
                paddingRight : 10,
                axisPaddingLeft : 25,
                tickHintX: 12, // How many ticks to show horizontally

                dataFormatX : function(x) {
                    return Date.create(x);
                },

                tickFormatX : function(x) {
                    return x.format('{Month}');
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
                    //$('#myModal').modal('show');
                    //listDetail(d.x.format('{yyyy}-{MM}-{dd}'));
                }
            };
        }
        
        var chart = new xChart('line-dotted', data, '#chart' , opts);
        $.ajax({
            type:'POST',
            url:"<?php echo base_url();?>dashboard/dashboard_penjualan_compare",
            data:{
                year1:year1,
                year2:year2,
                month1:month1,
                month2:month2,
                week1:week1,
                week2:week2
            },
            dataType:'json',
            success:
            function(data) {
                var set = [];
                var set2 = [];
                $.each(data.line1, function() {
                    set.push({
                        x : this.label,
                        y : parseInt(this.value)
                    });
                });
                $.each(data.line2, function() {
                    set2.push({
                        x : this.label2,
                        y : parseInt(this.value2)
                    });
                });
                
                chart.setData({
                    "xScale" : "ordinal",
                    "yScale" : "linear",
                    "main" : [{
                        className : ".stats",
                        data : set
                    },{
                        className:".stats2",
                        data: set2
                    }
                    ],
                });
                $('#tes').popover('hide'); 
                $('#modalCompare').modal('hide');
            }

        });
    }

    function detailCompare(){

    }

    function pembelian(){
        //alert("Tahun ="+xdYear+" Bulan ="+xdMonth+" TanggalMulai ="+xdStart+" filter="+filter+" string="+strUser);
        document.getElementById("legend").style.visibility = 'visible';
        if(xdStart != null && xdStart != ''){
            ajaxLoadChart(startDate,endDate,1);
        }else if(xdMonth != ""){
            filter_by_month(xdMonth,xdYear,1);
        }else if(xdYear != ""){
            filter_by_year(xdYear,1);
        }else{
            filter_all_year(filter,strUser,1);
        }
    }

    function minMax(){
        //alert("Tahun ="+xdYear+" Bulan ="+xdMonth+" TanggalMulai ="+xdStart+" filter="+filter+" string="+strUser);
        document.getElementById("legend").style.visibility = 'visible';
        if(xdStart != null && xdStart != ''){
            ajaxLoadChart(startDate,endDate,2);
        }else if(xdMonth != ""){
            filter_by_month(xdMonth,xdYear,2);
        }else if(xdYear != ""){
            filter_by_year(xdYear,2);
        }else{
            filter_all_year(filter,strUser,2);
        }
    }
</script>
</html>
