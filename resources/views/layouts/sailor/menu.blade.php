<?php  $menus = SiteHelpers::menus('top') ;?>
<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}">

               <img src="{{ asset('vcr/images/'.$vcrconfig['cnf_logo'])}}" alt="{{ $vcrconfig['cnf_appname'] }}"    />
               </a>
        </div>


        <div class="navbar-collapse collapse ">



	
		<ul class="nav navbar-nav">

			 <li><a href="{{ url('') }}"> Home </a></li>   
			@foreach ($menus as $menu)
		      @if($menu['module'] =='separator')
		        <li class="divider"></li>        
		      @else
				<li><!-- HOME -->
				 	<a 
					@if($menu['menu_type'] =='external')
						href="{{ URL::to($menu['url'])}}" 
					@else
						href="{{ URL::to($menu['module'])}}" 
					@endif
				 
					 @if(count($menu['childs']) > 0 ) class="dropdown-toggle" data-toggle="dropdown" @endif>
				 		<i class="{{$menu['menu_icons']}}"></i> 
						
						@if($vcrconfig['cnf_multilang'] ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]) && $menu['menu_lang']['title'][Session::get('lang')]!='')
							{{ $menu['menu_lang']['title'][Session::get('lang')] }}
						@else
							{{$menu['menu_name']}}
						@endif	
					
						
						@if(count($menu['childs']) > 0 )
						 <i class="fa fa-angle-down"></i>
						@endif  
					</a> 

					@if(count($menu['childs']) > 0)
						 <ul class="dropdown-menu dropdown-menu-right">
							@foreach ($menu['childs'] as $menu2)
							 	@if($menu2['module'] =='separator')
						        	<li class="divider"> </li>        
						      	@else
									 <li class=" 
									 @if(count($menu2['childs']) > 0) dropdown-submenu @endif
									 @if(Request::is($menu2['module'])) active @endif">
									 	<a 
											@if($menu2['menu_type'] =='external')
												href="{{ URL::to($menu2['url'])}}" 
											@else
												href="{{ URL::to($menu2['module'])}}" 
											@endif
														
										>
											<i class="{{$menu2['menu_icons']}}"></i> 
												@if($vcrconfig['cnf_multilang'] ==1 && isset($menu2['menu_lang']['title'][Session::get('lang')]))
													{{ $menu2['menu_lang']['title'][Session::get('lang')] }}
												@else
													{{$menu2['menu_name']}}
												@endif
											
										</a> 
										@if(count($menu2['childs']) > 0)
										<ul class="dropdown-menu dropdown-menu-right">
											@foreach($menu2['childs'] as $menu3)
												<li @if(Request::is($menu3['module'])) class="active" @endif>
													<a 
														@if($menu3['menu_type'] =='external')
															href="{{ URL::to($menu3['url'])}}" 
														@else
															href="{{ URL::to($menu3['module'])}}" 
														@endif										
													
													>
														<span>
														@if($vcrconfig['cnf_multilang'] ==1 && isset($menu3['menu_lang']['title'][Session::get('lang')]))
															{{ $menu3['menu_lang']['title'][Session::get('lang')] }}
														@else
															{{$menu3['menu_name']}}
														@endif
														
														</span>  
													</a>
												</li>	
											@endforeach
										</ul>
										@endif							
										
										</li>	
									@endif							
							@endforeach
						</ul>
					@endif

				</li>
				@endif	
			@endforeach	
          @if(Auth::check())
            
            <li>
              <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#">   {{ Lang::get('core.m_myaccount') }} <i class="fa fa-angle-down"></i> </a>
              <ul class="dropdown-menu ">
                <li><a tabindex="-1" href="{{ url('dashboard') }}"> Dashboard</a></li>
                <li><a tabindex="-1" href="{{ url('user/profile?view=frontend') }}"> {{ Lang::get('core.m_profile') }}</a></li>
                <li><a tabindex="-1" href="{{ url('user/logout') }}"> {{ Lang::get('core.m_logout') }}</a></li>
              </ul>
            </li>
            @else
            <li>
              <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"> {{ Lang::get('core.m_myaccount') }}</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="{{ url('user/profile?view=frontend') }}"> {{ Lang::get('core.signin') }} </a></li>
                <li><a tabindex="-1" href="{{ url('user/register') }}"> {{ Lang::get('core.signup') }}</a></li>
              </ul>
            </li>
            @endif											
		</ul>


      </div>
    </div>
</div>


		

	
