@extends('theme::app')

@section('content')

	<div class="container page">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{ $page->title }}</h1>
			<?php echo $page->body; ?>
		</div>

	</div>

@stop