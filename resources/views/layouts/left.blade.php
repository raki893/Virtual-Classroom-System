  <?php $sidebar = SiteHelpers::menus('sidebar') ;?>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
   


  <ul class="sidebar-menu"> 
    @foreach ($sidebar as $menu)
       
      @if($menu['module'] =='separator')
        <li class="header">
              @if($vcrconfig['cnf_multilang'] ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
                {{ $menu['menu_lang']['title'][Session::get('lang')] }}
              @else
                {{$menu['menu_name']}}
              @endif


         </li>        
      @else
          <li class="treeview @if(Request::segment(1) == $menu['module']) active @endif">
          <a 
            @if($menu['menu_type'] =='external')
              href="{{ $menu['url'] }}" 
            @else
              href="{{ URL::to($menu['module'])}}" 
            @endif
          >
            <i class="{{$menu['menu_icons']}}"></i> 
            <span>
              @if($vcrconfig['cnf_multilang'] ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
                {{ $menu['menu_lang']['title'][Session::get('lang')] }}
              @else
                {{$menu['menu_name']}}
              @endif              
            </span>
            @if(count($menu['childs']) > 0 )
            <span class="pull-right-container">
              <i class="caret pull-right"></i>
            </span>
            @endif
          </a>
          <!--- LEVEL II -->
            @if(count($menu['childs']) > 0 )

              <ul class="treeview-menu">
               @foreach ($menu['childs'] as $menu2)
                <li @if(Request::segment(1) == $menu2['module']) class="active" @endif >
                  <a 
                    @if($menu2['menu_type'] =='external')
                      href="{{ $menu2['url']}}" 
                    @else
                      href="{{ url($menu2['module'])}}"  
                    @endif                  
                  >                
                  <i class="{{$menu2['menu_icons']}}"></i>
                  @if($vcrconfig['cnf_multilang'] ==1 && isset($menu2['menu_lang']['title'][Session::get('lang')]))
                    {{ $menu2['menu_lang']['title'][Session::get('lang')] }}
                  @else
                    {{$menu2['menu_name']}}
                  @endif
                   @if(count($menu2['childs']) > 0 )
                    <span class="pull-right-container">
                      <i class="caret pull-right"></i>
                    </span>
                   @endif 
                </a>
                  <!-- LEVEL III -->

                    @if(count($menu2['childs']) > 0)
                    <ul class="treeview-menu">
                       @foreach ($menu2['childs'] as $menu3)
                            <li  @if(Request::segment(1) == $menu3['module']) class="active" @endif>
                                <a 
                                  @if($menu3['menu_type'] =='external')
                                    href="{{ $menu3['url']}}" 
                                  @else
                                    href="{{ url($menu3['module'])}}"  
                                  @endif                  
                                >                
                                <i class="{{$menu3['menu_icons']}}"></i>
                                @if($vcrconfig['cnf_multilang'] ==1 && isset($menu3['menu_lang']['title'][Session::get('lang')]))
                                  {{ $menu3['menu_lang']['title'][Session::get('lang')] }}
                                @else
                                  {{$menu3['menu_name']}}
                                @endif
                              </a>

                           </li> 
                        @endforeach  

                    </ul>  
                     @endif 
                  <!-- END LEVEL III -->
                </li>
                @endforeach 
              </ul>
            @endif 
            <!-- END LEVEL II -->
          </li>
          @endif 
        @endforeach  
        @if(Auth::user()->group_id == 1 or Auth::user()->group_id == 2 )
        <li class="header">ADMINISTRATOR</li>
        <li class="treeview">
          <a href="javascript:void(0)"> <i class="fa fa-desktop"></i> 
            <span> Teacher's Area </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">

            <li @if(Request::segment(2) == 'users') class="active" @endif>
              <a href="{{ url('core/users')}}">
               <span> {{ Lang::get('core.m_users') }} & {{ Lang::get('core.m_groups') }}</span>                
              </a>  
             </li>       
            
            
            <li @if(Request::segment(2) == 'pages') class="active" @endif><a href="{{ url('core/pages')}}"><span>{{ Lang::get('core.m_pagecms')}}</span></a></li> 
            <li @if(Request::segment(2) == 'posts') class="active" @endif><a href="{{ url('core/posts')}}"><span>Post Management</span></a></li>   
          <!--   <li @if(Request::segment(2) == 'logs') class="active" @endif><a href="{{ url('core/logs')}}"><span>{{ Lang::get('core.m_logs') }} </span></a></li> -->
           </ul>

        </li>
        @endif
        @if(Auth::user()->group_id == 1  )
        <li class="treeview">
          <a href="javascript:void(0)"> <i class="fa fa-cog"></i> 
            <span> Superadmin Area </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
           <!--
            <li @if(Request::segment(2) == 'config') class="active" @endif>
              <a href="{{ url('vcr/config')}}">
                <span>  {{ Lang::get('core.m_setting') }} </span>                
              </a>  
            </li> -->
            
            <li @if(Request::segment(2) == 'menu') class="active" @endif>
              <a href="{{ url('vcr/menu')}}">
                <span>  {{ Lang::get('core.m_menu') }}</span>                
              </a>
            </li> 
                                
         <!--   <li @if(Request::segment(2) == 'module') class="active" @endif>
              <a href="{{ url('vcr/module')}}">
               <span> {{ Lang::get('core.m_codebuilder') }} </span>                
              </a>  
            </li>           
            <li @if(Request::segment(2) == 'tables') class="active" @endif>
              <a href="{{ url('vcr/tables')}}">
                <span>  {{ Lang::get('core.m_database') }}  </span>                
              </a>  
            </li>
            <li @if(Request::segment(2) == 'code') class="active" @endif>
              <a href="{{ url('vcr/code')}}">
                <span>  {{ Lang::get('core.m_sourceeditor') }}  </span>                
              </a>  
            </li>            
            <li @if(Request::segment(2) == 'forms') class="active" @endif>
              <a href="{{ url('core/forms')}}">
                <span> {{ Lang::get('core.m_formbuilder') }} </span>                
              </a>  
            </li>
            <li @if(Request::segment(2) == 'rac') class="active" @endif>
              <a href="{{ url('vcr/rac')}}">
                <span> RestAPI Generator </span>                
              </a>  
             </li>
            <li @if(Request::segment(3) == 'clearlog') class="active" @endif>
              <a href="{{ url('vcr/config/clearlog')}}" class="clearCache">
                <span> Clear Log & Caches  </span>                
              </a>  
             </li> -->
          </ul>
         </li>    
         
         @endif      
    </ul>   


        <!-- /.control-sidebar-menu -->
     
    </section>
    <!-- /.sidebar -->
  </aside>