
<ul class="nav nav-pills pull-left" style="margin-bottom:15px;">
	
	@if(isset($previous->id))
		<li class=""><a href="{{ $previous->slug }}" class="btn btn-info btn-prev">{{ Lang::get('lang.previous') }}</a></li>
	@endif
	
	@if(isset($next->id))
		<li class=""><a href="{{ $next->slug }}" class="btn btn-info btn-next">{{ Lang::get('lang.next') }}</a></li>
	@endif

</ul>

<ul style="margin-bottom:15px;" id="next_post">

	@foreach($post_next as $next_post)

		<li class='col-md-4'><a href="/{{ $next_post->slug }}" class="<?php if($next_post->id == $post->id): ?> active <?php endif; ?>"><span style='background-image:url("{{ Voyager::image($next_post->pic_url) }}");'></span></a></li>

	@endforeach

</ul>