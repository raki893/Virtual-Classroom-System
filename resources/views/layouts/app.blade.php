<?php $vcrconfig  = config('vcr');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $vcrconfig['cnf_appname'] }} </title>
  <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon"> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('adminlte')}}/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vcr/css/font-awesome/css/font-awesome.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte')}}/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('vcr/css/vcr5-lte.css')}}">
  
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminlte')}}/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('adminlte')}}/plugins/morris/morris.css">
  <!-- Date Picker -->
  <link href="{{ asset('vcr/js/plugins/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
  <link href="{{ asset('vcr/js/plugins/datepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
  <link href="{{ asset('vcr/js/plugins/fancybox/jquery.fancybox.css') }}" rel="stylesheet">

  <!-- bootstrap wysihtml5 - text editor -->
  <link href="{{ asset('vcr/js/plugins/toastr/toastr.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('adminlte')}}/plugins/iCheck/all.css">
  <link href="{{ asset('vcr/js/plugins/select2/select2.css')}}" rel="stylesheet">
  <link href="{{ asset('vcr/js/plugins/bootstrap.summernote/summernote.css')}}" rel="stylesheet">
  <link href="{{ asset('vcr/css/vcr5.css')}}" rel="stylesheet">
  <link href="{{ asset('vcr/css/icons.min.css')}}" rel="stylesheet">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('adminlte')}}/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('adminlte')}}/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vcr/js/moment.min.js') }}"></script>
<!-- datepicker -->
<script type="text/javascript" src="{{ asset('vcr/js/plugins/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte')}}/dist/js/app.min.js"></script>
<script src="{{ asset('adminlte')}}/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/jquery.cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/toastr/toastr.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/parsley.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/jquery.jCombo.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/bootstrap.summernote/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/simpleclone.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/fancybox/jquery.fancybox.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/vcr.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/prettify.js') }}"></script>

</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
@include('layouts/top')

@include('layouts/left')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="pageLoading"></div>

          @if(Auth::user()->group_id == 1  )
           <div id="topbar-dropmenu"  class="topbar-menu-open" style="display: none;">
                <div class="topbar-menu row">
                    <div class="col-xs-4 col-sm-2">
                        <a class="metro-tile bg-success animated animated-short fadeInDown" href="{{ url('vcr/config')}}" style="opacity: 1;">
                            <span class="metro-icon glyphicon glyphicon-info-sign"></span>
                            <p class="metro-title"> {{ Lang::get('core.m_setting') }} </p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a class="metro-tile bg-info animated animated-short fadeInDown" href="{{ url('vcr/menu')}}" style="opacity: 1;">
                            <span class="metro-icon glyphicon glyphicon-list"></span>
                            <p class="metro-title"> {{ Lang::get('core.m_menu') }} </p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a class="metro-tile bg-alert animated animated-short fadeInDown" href="{{ url('vcr/module')}}" style="opacity: 1;">
                            <span class="metro-icon glyphicon glyphicon-cog"></span>
                            <p class="metro-title"> {{ Lang::get('core.m_codebuilder') }} </p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a class="metro-tile bg-primary animated animated-short fadeInDown" href="{{ url('vcr/tables')}}" style="opacity: 1;">
                            <span class="metro-icon fa fa-database"></span>
                            <p class="metro-title"> {{ Lang::get('core.m_database') }}  </p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a class="metro-tile bg-warning animated animated-short fadeInDown" href="{{ url('core/forms')}}" style="opacity: 1;">
                            <span class="metro-icon glyphicon glyphicon-list-alt"></span>
                            <p class="metro-title">{{ Lang::get('core.m_formbuilder') }}  </p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a class="metro-tile bg-system animated animated-short fadeInDown" href="{{ url('vcr/rac')}}" style="opacity: 1;">
                            <span class="metro-icon glyphicon glyphicon-random"></span>
                            <p class="metro-title">  RestAPI Generator </p>
                        </a>
                    </div>
                </div>
            </div>
            @endif

    @yield('content') 

 </div>


 <div class="control-sidebar-bg"></div>
 


 
<div class="modal fade" id="vcr-modal" tabindex="-1" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header bg-default">
    
    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Modal title</h4>
  </div>
  <div class="modal-body" id="vcr-modal-content">

  </div>

  </div>
</div>
</div>


  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Virtual Class Room System Version 1.0
    </div>
    {{ Lang::get('core.copyright') }} &copy; 2016-{{ date('Y')}} {{ $vcrconfig['cnf_comname']  }}. All rights
    reserved.
  </footer>

   <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

{{ Sitehelpers::showNotification() }} 

<script type="text/javascript">
jQuery(document).ready(function ($) {
  
  setInterval(function(){ 
    var noteurl = $('.notif-value').attr('code'); 
    $.get('{{ url("notification/load") }}',function(data){
      $('.notif-alert').html(data.total);
      var html = '';
      $.each( data.note, function( key, val ) {
        html += '<li><a href="'+val.url+'"> <div> <i class="'+val.icon+' fa-fw"></i> '+ val.title+'  <span class="pull-right text-muted small">'+val.date+'</span></div></li>';       
      });
      $('.notification-menu').html(html);
    });
  }, 600000); 
    
}); 
;  
  
</script>
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
</body>
</html>

