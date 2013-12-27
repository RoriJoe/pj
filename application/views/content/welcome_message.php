<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chart/css/xcharts.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chart/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/chart/css/daterangepicker.css" />

<div id="content" class="row" style="margin-left:0px;">
    <div class="span8">
        <h3>Grafik Penjualan</h3>
        <form class="form-horizontal">
          <fieldset>
            <div class="input-prepend">
              <span class="add-on"><i class="icon-calendar"></i></span>
              <input type="text" name="range" id="range" style="margin-bottom:0;width:150px;" />
            </div>
          </fieldset>
        </form>

        <div id="placeholder">
            <figure id="chart"></figure>
        </div>
    </div>
</div>

<!-- xcharts includes -->
<script src="//cdnjs.cloudflare.com/ajax/libs/d3/2.10.0/d3.v2.js"></script>
<script src="<?php echo base_url();?>assets/js/chart/js/xcharts.min.js"></script>

<!-- The daterange picker bootstrap plugin -->
<script src="<?php echo base_url();?>assets/js/chart/js/sugar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chart/js/daterangepicker.js"></script>

<!-- Our main script file -->
<script>
    $(function() {

    // Set the default dates
    var startDate   = Date.create().addDays(-6),    // 7 days ago
        endDate     = Date.create();                // today

    var range = $('#range');

    // Show the dates in the range input
    range.val(startDate.format('{MM}/{dd}/{yyyy}') + ' - ' + endDate.format('{MM}/{dd}/{yyyy}'));

    // Load chart
    ajaxLoadChart(startDate,endDate);
    
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
            
            tt.text(d.x.format('{Month} {ord}') + ': Rp.' + d.y).css({
                
                top: topOffset + pos.top,
                left: pos.left
                
            }).show();
        },
        
        "mouseout": function (x) {
            tt.hide();
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
                    className : ".stats",
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
                
            }

        });
    }
});

</script>