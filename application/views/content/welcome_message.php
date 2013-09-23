<!--<div class="div-judul-login">
    <p>Welcome <?php echo $user;?></p>
</div>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/swfobject.js"></script>
<div class="" style="width: 98%">
	<div class="bar-span bar-info" style="margin-left: 0;">
		<marquee scrollamount="3" onmouseout="this.start();" onmouseover="this.stop();" behavior="scroll">
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