@extends('theme::app')

@section('content')

	<div id="wrap" class="page">
		<h1>{{ $page->title }}</h1>
		<?php echo $page->body; ?>
	</div>

@stop