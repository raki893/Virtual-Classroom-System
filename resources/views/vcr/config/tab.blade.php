<?php

$tabs = array(
		'' 		        => ''. Lang::get('core.tab_siteinfo'),
		'email'			=> ' '. Lang::get('core.tab_email'),
		'security'		=> ' '. Lang::get('core.tab_loginsecurity') ,
		'translation'	=>' '.Lang::get('core.tab_translation'),
		'log'			=>' '. Lang::get('core.m_clearcache')
	);

?>

<ul class="nav nav-tabs m-b" >
@foreach($tabs as $key=>$val)
	<li  @if($key == $active) class="active" @endif><a href="{{ URL::to('vcr/config/'.$key)}}"> {!! $val !!}  </a></li>
@endforeach

</ul>