 <header class="main-header navbar-fixed-top">
    <!-- Logo -->
    <a href="{{ url('dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        
        <img src="{{ asset('vcr/images/logo.png') }}" title="{{ $vcrconfig['cnf_appname'] }}" height="30" width="30" />
               
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
    
        @if(file_exists(public_path().'/vcr/images/'.$vcrconfig['cnf_logo']) && $vcrconfig['cnf_logo'] !='')
        <img src="{{ asset('vcr/images/'.$vcrconfig['cnf_logo'])}}" alt="{{ $vcrconfig['cnf_appname'] }}"  />
        @else
        <img src="{{ asset('vcr/images/logo.png')}}" alt="{{ $vcrconfig['cnf_appname'] }}"  />
        @endif 
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <a href="{{ url('')}}" target="_blank" class="sidebar-all hidden-xs"  title="Go To Website">
       <span ><i class="fa fa-globe"></i></span>
      </a>
      @if(Auth::user()->group_id == 1  )
     <!-- <a href="javascript:void(0)" class="sidebar-all hidden-xs"  onclick="$('#topbar-dropmenu').toggle();">
        <span ><i class="fa fa-desktop"></i></span>
      </a> -->
      @endif
      <a href="javascript:void(0)" class="sidebar-all hidden-xs"  onclick="requestFullScreen()">
        <span ><i class="fa fa-arrows-alt"></i> </span>

      </a>
     

        

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-wifi"></i>
              <span class="label label-warning notif-danger">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="notif-alert" style="font-weight: 600">0</span> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="notification-menu">
                  
                </ul>  
              <li class="footer"><a href="{{ url('notification')}}">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->

         @if($vcrconfig['cnf_multilang'] ==1)
        <li class="dropdown tasks-menu">
          <?php 
          $flag ='en';
          $langname = 'English'; 
          foreach(SiteHelpers::langOption() as $lang):
            if($lang['folder'] == session('lang') or $lang['folder'] == $vcrconfig['cnf_lang']) {
              $flag = $lang['folder'];
              $langname = $lang['name']; 
            }
            
          endforeach;?>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <img class="flag-lang" src="{{ asset('vcr/images/flags/'.$flag.'.png') }}" width="16" height="12" alt="lang" /> {{ strtoupper($flag) }}
            <span class="hidden-xs">
             <i class="fa caret"></i>
            </span>
          </a>

           <ul class="dropdown-menu dropdown-menu-right icons-right">
            <li class="header"> {{ Lang::get('core.m_sel_lang') }} </li>
            @foreach(SiteHelpers::langOption() as $lang)
              <li><a href="{{ URL::to('home/lang/'.$lang['folder'])}}"><img class="flag-lang" src="{{ asset('vcr/images/flags/'. $lang['folder'].'.png')}}" width="16" height="11" alt="lang"  /> {{  $lang['name'] }}</a></li>
            @endforeach 
          </ul>

        </li> 
        @endif

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {!! SiteHelpers::avatar( 19 ) !!}
                <span class="hidden-xs">{{ Session::get('fid')}}
                  <i class="fa caret"></i>
                </span>              
            </a>

            <ul class="dropdown-menu">
              <li class="header">
                
                <b> {{ Lang::get('core.lastlogin') }} : </b> {{ date("H:i ,M/d/y", strtotime(Session::get('ll'))) }}
              </li>
              <li>
                  <li><a href="{{ url('user/profile')}}"><i class="fa fa-user"></i> My Profile  </a></li>
                  @if(session('gid') =='1')
                  <li><a href="{{ url('core/elfinder')}}"><i class="fa fa-folder"></i> My Folder & Files   </a></li>
                  @endif
                  <li><a href="{{ url('user/logout')}}"><i class="fa fa-sign-out"></i> Logout  </a></li>
              </li>
                <!-- search form -->
                
                 <?php
                 $templates = array(

                    'skin-blue'        => 'Blue',
                    'skin-black'       => 'Black',
                    'skin-purple'      => 'Purple',
                    'skin-green'       => 'Green',
                    'skin-red'         => 'Red',
                    'skin-yellow'      => 'Yellow',
                    'skin-blue-light'   => 'Blue Light',
                    'skin-black-light'  => 'Black Light',
                    'skin-purple-light' => 'Purple Light',
                    'skin-green-light'  => 'Green Light',
                    'skin-red-light'    => 'Red Light',
                    'skin-yellow-light' => 'Yellow Light',


                  );
                 ?>
              
                 
                     
            </ul>

          </li>


        </ul>
      </div>
    </nav>
  </header>