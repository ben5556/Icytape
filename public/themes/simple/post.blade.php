@extends('theme::app')

@section('content')

	<div id="wrap" class="single">

		<div class="height-spacer"></div>

		@include('theme::includes.post-item')

		@include('theme::includes.tags-and-source')

		@include('theme::includes.facebook-comments')

	</div>

		@include('theme::includes.previous-next-buttons')

@stop