@if(strpos($item->pic_url, '.gif') > 0)
	<div class="animated-gif">
		<img class="animation" alt="..." src="{{ Voyager::image($item->pic_url) }}" data-animation="{{ Voyager::image( str_replace('.gif', '-animation.gif', $item->pic_url) ) }}" data-original="{{ Voyager::image( $item->pic_url ) }}" style="width:100%;" data-state="0" />
		<img style="display:none" class="animation-play" src="{{ Voyager::image( str_replace('.gif', '-animation.gif', $item->pic_url ) ) }}" />
		<p class="gif-play"><i class="fa fa-play-circle-o"></i></p>
	</div>
@else
	<a href="{{ url($item->slug) }}" alt="{{ $item->title }}"><img class="single-media" alt="..." src="{{ Voyager::image($item->pic_url) }}" /></a>
@endif