		<script>
			function setcurDate()
{

	var d = new Date();
	var weekday=new Array(7);
	weekday[0]="Sunday";
	weekday[1]="Monday";
	weekday[2]="Tuesday";
	weekday[3]="Wednesday";
	weekday[4]="Thursday";
	weekday[5]="Friday";
	weekday[6]="Saturday";
	var day="";
	var month="";
	var hour="";
	var minute="";
	var second="";
	
	if(d.getMonth()<10)
	{	
		month="0"+d.getMonth();
	}
	else
	{
		month=d.getMonth();
	}
	
	if(d.getDate()<10)
	{	
		day="0"+d.getDate();
	}
	else
	{
		day=d.getDate();
	}
	
	if(d.getHours()<10)
	{	
		hour="0"+d.getHours();
	}
	else
	{
		hour=d.getHours();
	}
	
	if(d.getMinutes()<10)
	{	
		minute="0"+d.getMinutes();
	}
	else
	{
		minute=d.getMinutes();
	}
	
	if(d.getSeconds()<10)
	{	
		second="0"+d.getSeconds();
	}
	else
	{
		second=d.getSeconds();
	}
	
	var x= document.getElementById("curdate").innerHTML=weekday[d.getDay()]+", "+day+"-"+month+"-"+d.getFullYear()+" "+hour+":"+minute+":"+second;
	setTimeout("setcurDate()", 1000) 
}

		$(document).ready(function(){
			setcurDate();
		});
		</script>
		<div id="colhead" >
        	<div id="logoimg"><img src="<?php echo base_url().'asset/logo.png'; ?>"  width="250" height="50"/></div>
        </div>
        <div id="colmenu">
            <div id="menu">
               	<ul id="ulmenu">
                    <li><a href="<?php echo base_url().'index.php/home'; ?>">Home</a></li>
				<?php
					$userid=$this->session->userdata('wahanalogid');
					if($userid){						
				?>
                    <li><a>Master</a>
                        <ul>
							<li><a>Akuntasi & Keuangan <img src="<?php echo base_url().'asset/arrow.png'; ?>" width="15" height="15" /></a>
                            	<ul style="margin-left:180px;">
                                	<li><a href="<?php echo base_url().'index.php/perkiraan' ?>">Perkiraan</a></li>
                                	<li><a href="<?php echo base_url().'index.php/settingneraca' ?>">Setting Neraca</a></li>
                                	<li><a href="<?php echo base_url().'index.php/settingrugilaba' ?>">Setting Laba Rugi</a></li>
                                	<li><a href="<?php echo base_url().'index.php/mappingperkiraan' ?>">Mapping Perkiraan</a></li>
                                	<li><a href="<?php echo base_url().'index.php/settingmapping' ?>">Setting Mapping</a></li>
                                <!--	<li><a href="<?php// echo base_url().'index.php/settabtutuptahun' ?>">Tabel Tutup Tahun</a></li> -->
                                	<li><a href="<?php echo base_url().'index.php/tutuptahun' ?>">Tutup Tahun</a></li>
                                </ul>
                            </li>  	
                            <li><a>akuntansi <img src="<?php echo base_url().'asset/arrow.png'; ?>" width="15" height="15" /></a>
                                <ul style="margin-left:115px;">
                                	 <li><a href="<?php echo base_url().'index.php/jurnal' ?>">Jurnal</a></li>
                                </ul>
                            </li>
							<li><a>Cetak <img src="<?php echo base_url().'asset/arrow.png'; ?>" width="15" height="15" /></a>
								<ul>                            
									<li><a href="<?php echo base_url().'index.php/cetakjurnal' ?>">Transaksi Jurnal</a></li>
									<li><a href="<?php echo base_url().'index.php/cetakbukubesar' ?>">Buku Besar</a></li>
									<li><a href="<?php echo base_url().'index.php/cetaklabarugi' ?>">Laba rugi</a></li>
									<li><a href="<?php echo base_url().'index.php/cetakneraca' ?>">Neraca</a></li>
								</ul>
							</li>
                        </ul>
                    </li>
					<?php
						}			
					?>
                </ul>                
            </div>
            <div style="float:left;margin-left:10px;padding-top:5px;"><strong><?php echo $sitemap; ?></strong></div>
			
			<?php
					$userid=$this->session->userdata('wahanalogname');
					if($userid){						
			?>
			
            <div style="float:right" id="loggeduser"> Welcome, <?php echo $userid; ?> :: <a href='<?php echo base_url()."index.php/home/dologout"; ?>'>Logout</a></div>
			<?php
					}
			?>
            <div id="curdate"></div>
            <div class="clear"></div>
        </div>