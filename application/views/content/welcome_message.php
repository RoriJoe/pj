<!--<div class="div-judul-login">
    <p>Welcome <?php echo $user;?></p>
</div>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/swfobject.js"></script>

<div class="row-fluid">
  <div class="span9">
    <div class="bar-span">
      Summary Chart Sample
    </div>
    <div class="content-span">
      <?php echo $c1;?>
    </div>

<div class="content-span">
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab3" data-toggle="tab">Sample</a></li>
    <li><a href="#tab1" data-toggle="tab">Web Progress</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab3">
      <div id="gauge" class="300x150px" style="display: inline-block; width: 200px; height:140px;"></div>
      <div id="gauge2" class="300x150px" style="display: inline-block; width: 200px; height:140px;"></div>
    </div>
    <div class="tab-pane" id="tab1">
        <div id="stat" class="pull-left">
            <p>Status : Beta Development</p>
            <p>Current Version : 0.10.01-Beta</p>
            <p>Date Update : 30/09/2013</p>
        </div>
        <div id="prog" class="pull-right">
            <table width="460px">
                
                <tr>
                    <td width="18%">
                        HTML
                    </td>
                    <td>
                        <div class="progress progress-warning" style="margin: 0">
                            <div class="bar" style="width: 75%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="18%">
                        CSS
                    </td>
                    <td>
                        <div class="progress progress-success" style="margin: 0">
                            <div class="bar" style="width: 90%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="18%">
                        Function
                    </td>
                    <td>
                        <div class="progress progress-danger" style="margin: 0">
                            <div class="bar" style="width: 70%"></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="span3">
<div class="bar-span">
  Card Layer
</div>
<div class="content-span">
  
</div>

<div class="bar-span" style="margin-top: 10px;margin-left:0;">
  Summary Pie Chart
</div>  
<div class="content-span">
  <?php echo $c2;?>
</div>
</div>
</div>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/raphael.2.1.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/justgage.1.0.1.min.js"></script>
<script>
$(document).ready(function(){
  var g = new JustGage({
    id: "gauge", 
    value: 67, 
    min: 0,
    max: 100,
    title: "Visitors"
  }); 

  var h = new JustGage({
    id: "gauge2", 
    value: getRandomInt(10, 90), 
    min: 0,
    max: 100,
    title: "Sample"
  }); 
});

</script>