<!--<div class="div-judul-login">
    <p>Welcome <?php echo $user;?></p>
</div>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/swfobject.js"></script>
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

  var i = new JustGage({
    id: "gauge3", 
    value: getRandomInt(40, 80), 
    min: 0,
    max: 100,
    title: "Sample"
  }); 
});

</script>

<div class="" style="width: 98%">
	<div class="bar-span bar-info" style="margin-left: 0;">
		<marquee scrollamount="3" behavior="scroll">
		    Info Here : Lorem ipsum dolor sit amet, 50% 
		    consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
		    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
		    consequat. 
		</marquee>
		
	</div>
</div>
<div class="span7" style="margin-left: 0; width: 720px;">
<div class="bar-span">
	Summary Chart Sample
</div>
<div class="content-span" style="height: 205px;">
	<?php echo $c1;?>
</div>

<div class="content-span" style="height: 190px;">
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab3" data-toggle="tab">Sample</a></li>
    <li><a href="#tab1" data-toggle="tab">Web Progress</a></li>
    <li><a href="#tab2" data-toggle="tab">Bug Tracking</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab3">
      <div id="gauge" class="300x150px" style="display: inline-block; width: 200px; height:140px;"></div>
      <div id="gauge2" class="300x150px" style="display: inline-block; width: 200px; height:140px;"></div>
      <div id="gauge3" class="300x150px" style="display: inline-block; width: 200px; height:140px;"></div>
    </div>
    <div class="tab-pane" id="tab1">
        <div id="stat" class="pull-left">
            <p>Status : Beta Development</p>
            <p>Current Version : 0.9.24-Beta</p>
            <p>Date Update : 24/09/2013</p>
        </div>
        <div id="prog" class="pull-right">
            <table width="460px">
                
                <tr>
                    <td width="18%">
                        HTML
                    </td>
                    <td>
                        <div class="progress progress-warning" style="margin: 0">
                            <div class="bar" style="width: 60%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="18%">
                        CSS
                    </td>
                    <td>
                        <div class="progress progress-success" style="margin: 0">
                            <div class="bar" style="width: 80%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="18%">
                        Function
                    </td>
                    <td>
                        <div class="progress progress-danger" style="margin: 0">
                            <div class="bar" style="width: 50%"></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
      
    </div>
    <div class="tab-pane" id="tab2">
      <div class="tabbable tabs-right">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#rA" data-toggle="tab">Issues</a></li>
                <li><a href="#rB" data-toggle="tab">Enhance'</a></li>
                <li><a href="#rC" data-toggle="tab">Report</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="rA">
                  <div id="hasil"></div>
                </div>
                <div class="tab-pane" id="rB">
                  <p>Nothing To Enhance at This time</p>
                </div>
                <div class="tab-pane" id="rC">
                    
                  <form id="formID">
                      <table width="100%">
                      <tr>
                          <td width="20%">
                              Name*  
                          </td>
                          <td width="45%">
                              <input type="text" placeholder="Name" id="namas">
                          </td>
                          <td rowspan="3">
                              Priority* : <br/>
                              <label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>
                              Low
                              </label>
                              <label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="2">
                              Medium
                              </label>
                              <label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="3">
                              High
                              </label>
                              <button class="btn btn-primary btn-small" id="save">submit</button>
                          </td>
                      </tr>
                      <tr>
                          <td width="20%">
                              Title*    
                          </td>
                          <td width="45%">
                              <input type="text" placeholder="Title" id="title">
                          </td>
                      </tr>
                      <tr>
                          <td width="20%">
                              Description*  
                          </td>
                          <td>
                              <textarea rows="1" style="height: 50px;" placeholder="Add Info, Description, tips, or url" id="desc"></textarea>
                          </td>
                      </tr>
                    </table>
                  </form>
                  
                </div>
              </div>
            </div>
    </div>
  </div>
</div>
</div>

</div>
<div class="span3">
<div class="bar-span">
	Summary
</div>
<div class="content-span" style="height: 130px;">
	<table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product</th>
                  <th>Paymnt' Taken</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr class="success">
                  <td>1</td>
                  <td>TB - Monthly</td>
                  <td>01/04/2012</td>
                  <td>Approved</td>
                </tr>
                <tr class="error">
                  <td>2</td>
                  <td>TB - Monthly</td>
                  <td>02/04/2012</td>
                  <td>Declined</td>
                </tr>
                <tr class="info">
                  <td>3</td>
                  <td>TB - Monthly</td>
                  <td>03/04/2012</td>
                  <td>Pending</td>
                </tr>
              </tbody>
            </table>
</div>

<div class="bar-span" style="margin-top: 10px;">
	Summary Pie Chart
</div>	
<div class="content-span">
	<?php echo $c2;?>
</div>
</div>

<script>
function loadBug(){
  $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/bug/view",
    data :{},
    success:
    function(hh){
        $('#hasil').html(hh);
    }
    });  
}
    
loadBug();
$("#save").click(function(){
        var x = $('input:radio[name=optionsRadios]:checked').val();
        
        var nama = $('#namas').val();
        var title = $('#title').val();
        var desc = $('#desc').val();
        var priority = x;
        
        if(nama != "" && title != "" && desc != "")
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/bug/insert", //SEND TO CONTROLLER
            data :{nama:nama,title:title,desc:desc,priority:priority},

            success:
            function()
            {
                        window.alert("Thanks for Your Feedback and Support");
                        $('#formID').each(function(){
                            this.reset();
                        });
                        loadBug();
            }
            });
        }else{
            window.alert("Form tidak boleh kosong");
        }
});

</script>