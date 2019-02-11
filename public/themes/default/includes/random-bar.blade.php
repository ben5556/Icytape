<style type="text/css">
.gallery-sub-header{
	top:0px;
}
.main_home_container{
	padding-top:0px;
}
</style>

<?php 
	$random = App\Models\Post::where('active', '=', 1)->orderBy(DB::raw('RAND()'))->take(18)->get();
?>

<div id="random-bar">
	<div id="random-left"><i class="fa fa-angle-left"></i></div>
	<div id="random-right"><i class="fa fa-angle-right"></i></div>
	<div class="container random-container">
		<div id="random-slider">
			<?php foreach($random as $random_post): ?>
					<div class="random-item" >
						<a class="random-img" href="{{ url($random_post->slug) }}" style="background-image:url({{ Voyager::image( $random_post->pic_url ) }}); display:block; min-height:100px; background-size:cover; background-position-y:center"></a>
					</div>

			<?php endforeach; ?>
		</div>
	</div>
</div>