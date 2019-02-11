@extends('theme::app')

@section('content')


<div id="wrap">

	@if(isset($search))
		<h1>Search Results for "{{ $search }}"</h1><br>
	@endif

	@if(isset($tag))
		<h1>Posts with Tag: "{{ $tag }}"</h1><br>
	@endif


	<content id="media">
	
		<?php foreach($posts as $item): ?>

			@include('theme::includes.post-item')

		<?php endforeach; ?>

	</content>

	<?php if(isset($search)): ?>
		<?php echo $posts->appends(['search' => $search])->links(); ?>
	<?php else: ?>
		<?php echo $posts->links(); ?>
	<?php endif; ?>

</div>

@stop