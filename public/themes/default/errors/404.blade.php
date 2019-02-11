@extends('theme::app')

@section('content')

	<style>
		ul.trace, ul.trace li{
			list-style:none;
			padding:0px;
			text-align:left;
		}
		ul.trace{
			padding:10px;
			background:#f5f5f9;
			border-radius:2px;
			font-size:11px;
			font-family:Courier;
		}
		ul.trace li{
			margin-bottom:5px;
			border-bottom:1px solid #eee;
		}
		ul.trace li span{
			display:block;
		}
		h2{
			margin-bottom: 0px;
    		background: #ddd;
		}
	</style>

	<div class="container" style="text-align:center;">
		<h1>404 Not Found</h1>
		<img src="{{ theme_folder_url('/assets/img/error.png') }}">
		<p>The page you are looking for does not exist</p>

		@if(env('APP_DEBUG'))
			<h3>{{ trim($exception->getMessage(), '.') }} on line #{{ $exception->getLine() }}</h3>
			<h4>in file {{ $exception->getFile() }}</h4>
			<h2>Stack Trace</h2>
			<ul class="trace">
			@foreach($exception->getTrace() as $trace)
				<li>
					<span><strong>File: </strong>{{ @$trace['file'] }} on line {{ @$trace['line'] }}</span>
					<span><strong>Class: </strong>{{ @$trace['class'] }}, in function {{ @$trace['function'] }}</span>
				</li>
			@endforeach
			</ul>
		@endif
	</div>

@stop