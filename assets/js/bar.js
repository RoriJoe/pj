$(document).ready(function(){
	jQuery(".hide-con").show();
	var i = document.getElementById('konten');
	jQuery(".bar").click(function()
	{
	    jQuery(this).next(".hide-con").slideToggle(500, function(){
	    // Animation complete.
	    if(i.style.display=="none"){
	        document.getElementById('icon').className='icon-chevron-down icon-white';
	    }else{
	        document.getElementById('icon').className='icon-chevron-up icon-white';
	        }
	    });
	});
});