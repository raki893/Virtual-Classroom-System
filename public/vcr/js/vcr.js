/* vcr builder 
	copyright 2014 . vcr builder com 
*/

jQuery(document).ready(function($){
	
	
	if($.cookie("body-class") =='sidebar-collapse'){
		$("body").addClass("sidebar-collapse");
		
	} 

    $('.sidebar-toggle').click(function () {
      	var w = $("body");
		if( w.hasClass('sidebar-collapse'))
		{
			$.cookie("body-class",'', {expires: 365, path: '/'});
		} else {
			 $.cookie("body-class",'sidebar-collapse', {expires: 365, path: '/'});	
		}	
			
    })

	$('.sidebar-menu li ul li.active').parents('li').addClass('active');
     $('.clearCache').click(function(){
          $('.pageLoading').show();
          var url = $(this).attr('href');
          $.get( url  , function( data ) {
             $('.pageLoading').hide();
             notyMessage(data.message); 
                 
          });
          return false;
      }); 
   
	$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})
	$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss',autoClose:true}); 
	
		$('.tips').tooltip();	
	 	$('.editor').summernote();
	    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      checkboxClass: 'icheckbox_flat-green',
	      radioClass: 'iradio_flat-green'
	    });

    //Red color scheme for iCheck
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	      checkboxClass: 'icheckbox_minimal-red',
	      radioClass: 'iradio_minimal-red'
	    });    	


	/* Tooltip */
	$('.previewImage').fancybox();	
	$(".select2").select2({ width:"100%"});	

	$('.panel-trigger').click(function(e){
		e.preventDefault();
		$(this).toggleClass('active');
	});

	$('.popup').click(function (e) {
		e.stopPropagation();
	});	
     window.prettyPrint && prettyPrint();

	$(".checkall").click(function() {
		var cblist = $(".ids");
		if($(this).is(":checked"))
		{				
			cblist.prop("checked", !cblist.is(":checked"));
		} else {	
			cblist.removeAttr("checked");
		}	
	});
	
	// Upload Image Preview 
	$(".inputfile").change(function () { uploadPreview(this); });



	$('.removeCurrentFiles').on('click',function(){
		var removeUrl = $(this).attr('href');
		$.get(removeUrl,function(response){
			if(response.status == 'success')
			{
				
			}
		});
		$(this).parent('div').empty();	
		return false;
	});	

	$('.dropdown, .btn-group').on('show.bs.dropdown', function(e){
		$(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100);
	});
	$('.dropdown, .btn-group').on('hide.bs.dropdown', function(e){
		$(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100);
	});	
		    	
})

function addMoreFiles(id){

   $("."+id+"Upl").append('<input type="file" name="'+id+'[]" />')
}

function vcrConfirmDelete( url )
{
	if(confirm('Are u sure deleting this record ? '))
	{
		window.location.href = url;	
	}
	return false;
}
function vcrDelete(  )
{	
	var total = $('input[class="ids"]:checkbox:checked').length;
	if(confirm('are u sure removing selected rows ?'))
	{
			$('#vcrTable').submit();// do the rest here	
	}	
}	

var newwindow;
function ajaxPopupStatic(url ,w , h)
{
	var w = (w == '' ? w : 800 );	
	var h = (h == '' ? wh: 600 );	
	newwindow=window.open(url,'name','height='+w+',width='+h+',resizable=yes,toolbar=no,scrollbars=yes,location=no');
	if (window.focus) {newwindow.focus()}
}

function vcrModal( url , title)
{
	$('#vcr-modal-content').html(' ....Loading content , please wait ...');
	$('.modal-title').html(title);
	$('#vcr-modal-content').load(url,function(){
	});
	$('#vcr-modal').modal('show');	
}

function notyMessage(message)
{

	toastr.success("success", message);
	toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "positionClass": "toast-bottom-right",
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"

	}	
	
}
function notyMessageError(message)
{
	
	toastr.error("error", message);
	toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "positionClass": "toast-bottom-right",
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"

	}	
	
}

function requestFullScreen() {

  var el = document.body;

  // Supports most browsers and their versions.
  var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen 
  || el.mozRequestFullScreen || el.msRequestFullScreen;

  if (requestMethod) {

    // Native full screen.
    requestMethod.call(el);

  } else if (typeof window.ActiveXObject !== "undefined") {

    // Older IE.
    var wscript = new ActiveXObject("WScript.Shell");

    if (wscript !== null) {
      wscript.SendKeys("{F11}");
    }
  }
}

;(function ($, window, document, undefined) {

    var pluginName = "sximMenu",
        defaults = {
            toggle: true
        };

    function Plugin(element, options) {
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {
        init: function () {

            var $this = $(this.element),
                $toggle = this.settings.toggle;

            $this.find('li.active').has('ul').children('ul').addClass('collapse in');
            $this.find('li').not('.active').has('ul').children('ul').addClass('collapse');

            $this.find('li').has('ul').children('a').on('click', function (e) {
                e.preventDefault();

                $(this).parent('li').toggleClass('active').children('ul').collapse('toggle');

                if ($toggle) {
                    $(this).parent('li').siblings().removeClass('active').children('ul.in').collapse('hide');
                }
            });
        }
    };

    $.fn[ pluginName ] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
    };

})(jQuery, window, document);

function uploadPreview(input ) {
		//alert(input.files[0].size +' : '+ input.files[0].name +' : '+ input.files[0].type);

		var id = $(input).attr('id'); 
		target = '.'+id+'_preview';
		var sizeInMB = (input.files[0].size / 1024).toFixed(2);

		var Type = input.files[0].type;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(target).html('<div class="upload-box-img-preview"><img class="upload-image-preview" src="'+e.target.result+'" alt="your image" width="150" /><br /> <b> Size: </b> '+ sizeInMB+' Kb <br /> <b>  Type: </b> '+ Type+'</div>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
