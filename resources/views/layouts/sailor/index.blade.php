<?php $vcrconfig  = config('vcr');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> {{ $pageTitle}} | {{ $vcrconfig['cnf_appname'] }} </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Bootstrap 3 template for corporate business" />
<link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
<!-- css -->
<link href="{{ asset('frontend/sailor/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('frontend/sailor/plugins/flexslider/flexslider.css') }}" rel="stylesheet" media="screen" /> 
<link href="{{ asset('frontend/sailor/css/cubeportfolio.min.css') }}" rel="stylesheet" />
<link href="{{ asset('frontend/sailor/css/style.css') }}" rel="stylesheet" />

<!-- Theme skin -->
<link id="t-colors" href="{{ asset('frontend/sailor/skins/green.css') }}" rel="stylesheet" />


<!-- =======================================================
    Theme Name: Sailor
    Theme URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
======================================================= -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontend/sailor/') }}/js/jquery.min.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/modernizr.custom.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/jquery.easing.1.3.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('frontend/sailor/') }}/plugins/flexslider/jquery.flexslider-min.js"></script> 
<script src="{{ asset('frontend/sailor/') }}/plugins/flexslider/flexslider.config.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/jquery.appear.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/stellar.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/classie.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/uisearch.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/jquery.cubeportfolio.min.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/google-code-prettify/prettify.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/animate.js"></script>
<script src="{{ asset('frontend/sailor/') }}/js/custom.js"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/parsley.js') }}"></script>
<script type="text/javascript" src="{{ asset('vcr/js/plugins/jquery.jCombo.min.js') }}"></script>
</head>
<body>

<div id="wrapper">
  <!-- start header -->
  <header>
      <div class="top">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
      
            </div>
            <div class="col-md-6">
            <div id="sb-search" class="sb-search">
              <form>
                <input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
                <input class="sb-search-submit" type="submit" value="">
                <span class="sb-icon-search" title="Click to start searching"></span>
              </form>
            </div>


            </div>
          </div>
        </div>
      </div>  
      
         @include('layouts/sailor/menu')
  </header>
  <!-- end header -->

  <!-- Start Content Here -->
  <section id="main-content" style="min-height: 300px;">

      @include($pages)

  </section>
  <!-- End Content Here -->



  


  <footer style="padding:0 !important;">

  <div id="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="copyright">
            <p>&copy; <?php echo $vcrconfig['cnf_comname'];?> - All Right Reserved</p>
                        <div class="credits">

                        </div>
          </div>
        </div>
        <div class="col-lg-6">
          
        </div>
      </div>
    </div>
  </div>
  </footer>

</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>






</body>
</html>
