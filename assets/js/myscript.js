function barAnimation(){
  jQuery(".hide-con").hide();
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
}

bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
    $('#konfirmasi').html('<div class="alert alert-error" style="position:absolute; width:92%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}
bootstrap_alert.success = function(message) {
    $('#konfirmasi').html('<div class="alert alert-success" style="position:absolute; width:92%"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}
bootstrap_alert.info = function(message) {
    $('#konfirmasi').html('<div class="alert alert-info" style="position:absolute; width:92%;"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
    $(".alert").delay(1500).addClass("in").fadeOut(5000);
}

function validation(){
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

function key(){
 $('button[type="submit"]').attr('disabled','disabled');
 $('input[type="text"]').keyup(function() {
    if($(this).val() != '') {
       $('button[type="submit"]').removeAttr('disabled');
    }
    else
    {
        $('button[type="submit"]').attr('disabled','disabled');
    }
 });
 $("#al").keyup(function() {
    if($(this).val() != '') {
       $('button[type="submit"]').removeAttr('disabled');
    }
    else
    {
      $('button[type="submit"]').attr('disabled','disabled');
    }
 });
}

function key_tr(){
$('button[type="submit"]').attr('disabled','disabled');
$('#add').attr('disabled','disabled');
 $('input[type="text"]').keyup(function() {
    if($(this).val() != '') {
       $('button[type="submit"]').removeAttr('disabled');
       $('#add').removeAttr('disabled');
    }
    else
    {
        $('button[type="submit"]').attr('disabled','disabled');
        $('#add').attr('disabled','disabled');
    }
 });
}

function disableAlpha($id){
    var foo = document.getElementById($id);
    foo.addEventListener('input', function (prev) {
    return function (evt) {
        if (!/^[0-9\.\+\ ]*$/.test(this.value)) {
          this.value = prev;
        }
        else {
          prev = this.value;
        }
    };
    }(foo.value), false);
};

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

function setSelectedIndex(s, valsearch)
{
// Loop through all the items in drop down list
for (i = 0; i< s.options.length; i++)
{ 
    if (s.options[i].value == valsearch)
    {
        // Item is found. Set its property and exit
        s.options[i].selected = true;
        break;
    }
}
return;
}