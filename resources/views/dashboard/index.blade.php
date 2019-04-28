@extends('layouts.app')


@section('content')
<style>
body{
    overflow-y: hidden !important;
}
</style>

<script type="text/javascript" src="{{ asset('vcr/js/plugins/chartjs/Chart.min.js') }}"></script>
    <section class="content-header">
      <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li  class="active"> {{ $pageTitle }} </li>
      </ol>
    </section>
<img style=" object-fit: cover; width: 100%;" src="{{ asset('uploads/images/dash.jpeg')}}" />

 
@stop