@extends('theme::app')

@section('content')

<div id="main_container"@if(theme('random_bar')) class="random_bar"@endif>

		<?php if(isset($search)): ?>
			<h4 class="container search-text"><?= Lang::get('lang.search_results_for') ?>: <?= $search ?></h4>
			<style type="text/css">.main_home_container{ padding-top:0px; }</style>
		<?php endif; ?>

		<?php if(isset($title)): ?>
			<h1 class="title">{{ $title }}</h1>
			<style type="text/css">body{padding-top:25px;}h1.title{text-align: center; font-weight: bold; font-size: 15px; padding: 15px; color: #555; background: #fcfcff; border-bottom: 1px solid #f1f1f1; }</style>
		<?php endif; ?>

		<?php if(isset($tag) && !isset($single)): ?>
			<h4 class="container search-text">Tagged with: <?= $tag ?></h4>
			<style type="text/css">.main_home_container{ padding-top:0px; }</style>
		<?php endif; ?>

		<div class="container main_home_container main_home">

			@if(!$sidebar && theme('sidebar_settings', 1))
				<div class="col-md-12 col-lg-12">
					@include('theme::includes.sidebar_settings')
				</div>
			@endif
		
			<div class="@if(!$sidebar){{ 'col-md-12 col-lg-12' }}@else{{ 'col-md-8 col-lg-8' }}@endif" style="display:block; clear:both; margin:0px auto; padding:0px; padding-bottom:70px;">
				
				@include('theme::includes.loop')
					
			</div>

			@if($sidebar)

				@include('theme::includes.sidebar')

			@endif

		</div>

</div>

@stop

@section('javascript')

@if($post_display == 'grid_large' || $post_display == 'grid')

	<?php if($post_display == 'grid'){ $column = 'col-sm-4'; } else { $column = 'col-sm-6'; } ?>

	<script>

		$(document).ready(function(){

			var $container = $('#posts');
			// layout Masonry again after all images have loaded
			$container.imagesLoaded( function() {

			  $container.masonry({
				  "columnWidth": "." + "<?= $column ?>",
				  itemSelector: '.item',
				  gutter: 0,
				});
			  $('.item').css('opacity', '1.0');
			});
			
		});

	</script>

@endif

@stop