<div class="row-fluid">
	<div class="span5">
		<!--**NOTIFICATION AREA**-->
		<div id="konfirmasi" class="sukses"></div>

		<!--//***MAIN FORM-->
		<div class="bar-fluid">
		    <p>Form Create Password <i id="icon" class='icon-chevron-down icon-white'></i></p>
		</div>
		<div id="konten" class="hide-con-fluid master-border">
		    <form id="formID">
		    <table>
		        <tr>
		            <td>User Name</td>
		            <td>
		                <input type='text' class="validate[required,maxSize[10], minSize[3]],custom[onlyLetterNumber]" 
		                maxlength="10" id='users' name='users' 
		                style="width: 170px; margin-left: 10px; margin-right: 20px;"/>
		            </td>
		       </tr>
		       <tr>
		            <td>Nama</td>
		            <td>
		                <input type='text' class="validate[required,maxSize[25], minSize[3]],custom[onlyLetterSp]" 
		                maxlength="25" id='namas' name='namas' onclick="disableNum('namas')" 
		                style="width: 170px; margin-left: 10px; margin-right: 20px;"/>
		            </td>
		       </tr>
		       <tr>
		            <td>Password</td>
		            <td>
						<input type='password' class="validate[required,minSize[3]]" 
		                maxlength="12" id='password' name='password'
		                style="width: 170px; margin-left: 10px; margin-right: 20px;"/>
		            </td>
		       </tr>
		       <tr>
		            <td>Level</td>
		            <td>
						<select id="lev" style="width: 50px; margin-left: 10px; margin-right: 20px;">
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						</select>
		            </td>
		       </tr>
		    </form>
		       <tr id="upload">
		       		<td colspan="3" style="text-align:center;">
		       			<?php echo $error; ?>
		       			<img src="<?php echo $img ?>" alt="" width="120px" id="profile"/>
		       			<?php echo form_open_multipart('admin/upload');?>
		       			<input type="hidden" id="users2" name="users2">
		       			<label>Max.300x300px</label>
		       			<input type="file" name="userfile"/>
		       			<input type="submit" name="submit" id="up" class="btn btn-small btn-info" value="Upload Image">
		       			</form>
		       		</td>
		       </tr>
		    </table>
		<div style="margin-top: 10px;"> 
		    <button id="save" mode="add" class="btn btn-primary">Save</button>
		    <button id="delete" class="btn" type="submit">Delete</button>
		    <button id="cancel" class="btn" type="submit">Cancel</button>
		</div>
		</div>
	</div>
	<div class="span4 offset3">
		<div id="list"></div>
	</div>	
</div>


<script type="text/javascript">
$(document).ready(function(){
	validation_engine();
    listUser();
    document.getElementById('up').style.visibility = 'hidden';
});

function listUser(){
    $.ajax({
    type:'POST',
    url: "<?php echo base_url();?>index.php/user/index",
    data :{},
    success:
    function(hh){
        $('#list').html(hh);
    }
    });
}
function validation_engine() {
    jQuery("#formID").validationEngine(
    {
        showOneMessage: true,
        ajaxFormValidation: true,
        ajaxFormValidationMethod: 'post',
        autoHidePrompt: true,
        autoHideDelay: 2500, 
        fadeDuration: 0.3
    });
}

function disableNum($id){
    var foo = document.getElementById($id);
    foo.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^[A-Za-z ]*$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(foo.value), false);
};

$("#cancel").click(function(){
	document.getElementById('profile').src="";
	document.getElementById('up').style.visibility = 'hidden';
	$('#formID').each(function(){
		this.reset();
	});
	$("#users").attr('disabled',false);
	$('#save').attr('mode','add');
});

//Save Click
$("#save").click(function(){
  
    var _mode = $('#save').attr("mode");
    
    var user = $('#users').val();
    var password = $('#password').val();
    var nama = $('#namas').val();
    var lev = $('#lev').val();
    
    if(_mode == "add") //add mode
    {
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/user/save/add",
            data :{user:user,password:password,nama:nama,lev:lev
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> User berhasil ditambahkan');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    listUser();
                    $('#save').attr('mode','add');
                }
                else{
                    bootstrap_alert.warning('<b>Gagal Menambahkan</b> Data sudah ada');
                }
            }
            });
        }     
    }
    
    //Edit mode
    else if(_mode == "edit")
    { 
        if($("#formID").validationEngine('validate'))
        {
            $.ajax({
            type:'POST',
            url: "<?php echo base_url();?>index.php/user/save/edit",
            data :{user:user,password:password,nama:nama,lev:lev
            },

            success:
            function(msg)
            {
                if(msg == "ok")
                {
                    bootstrap_alert.success('<b>Sukses</b> User berhasil Update');
                    $('#formID').each(function(){
                        this.reset();
                    });
                    listUser();
                    $('#save').attr('mode','add');
                    $("#users").attr('disabled',false);
                    document.getElementById('up').style.visibility = 'hidden';
                    document.getElementById('profile').src="";
                }
                else{
                    bootstrap_alert.warning('<b>Gagal Menambahkan</b>');
                }
            }
            });
        }   
    }
});

$("#delete").click(function(){
    var user = $('#users').val();

     $.ajax({
        type:'POST',
        url: "<?php echo base_url();?>index.php/user/delete",
        data :{user:user
        },

        success:
        function(msg)
        {
            if(msg == "ok")
            {
                bootstrap_alert.success('<b>Sukses</b> Data telah dihapus');
                $('#formID').each(function(){
                    this.reset();
                });
               listUser();
               $('#save').attr('mode','add');
               $("#users").attr('disabled',false);
               document.getElementById('up').style.visibility = 'hidden';
               document.getElementById('profile').src="";
            }
        }
        });
});

//ALERT
bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
    $('#konfirmasi').html('<div class="alert alert-error" style="position:absolute; width:52%; "><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(5000).addClass("in").fadeOut(3000);
}
bootstrap_alert.success = function(message) {
    $('#konfirmasi').html('<div class="alert alert-success" style="position:absolute; width:52%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}
bootstrap_alert.info = function(message) {
    $('#konfirmasi').html('<div class="alert alert-info" style="position:absolute; width:52%;"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
}
</script>